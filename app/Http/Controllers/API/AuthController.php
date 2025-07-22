<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Transaksi_SPP;
use App\Models\verifikasi_SPP;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Mpdf\Tag\Tr;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function request_sanctum_token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ],[
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'device_name.required' => 'Device name is required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response(['payback' => 'Account not found']);
        } else if (!Hash::check($request->password, (string) $user->password)) {
            return response(['payback' => 'Incorrect Credentials']);
        }

        if (count(DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()) > 0) {
            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
        }


        $kk=Siswa::where('id_account', $user->id)->get()[0]->NO_KK;
        $nama=Siswa::where('id_account', $user->id)->get()[0]->nama_lengkap;
        $decryption_key = $kk . $nama;

        if(strlen($decryption_key) > 32){
            $decryption_key = substr($decryption_key, 0, 32);
        }
        if(strlen($decryption_key) < 32){
            $decryption_key = str_pad($decryption_key, 32, 0);
        }

        $tokenGen = $user->createToken('access_token')->plainTextToken;

        $token = explode('|', $tokenGen)[1];
        $hashed = DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()[0]->token;

        $response = [
            'token' => base64_encode(json_encode(["typ" => "SANCTUM"])) . '.' .$tokenGen,
            'decryption_key' => base64_encode($decryption_key),
            // 'dec'=>$decryption_key,
            'valid' => hash_equals($hashed, hash('sha256', $token)),
        ];

        return response($response);
    }
    public function request_jwt_token(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ],[
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'device_name.required' => 'Device name is required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response(['payback' => 'Account not found']);
        } else if (!Hash::check($request->password, (string) $user->password)) {
            return response(['payback' => 'Incorrect Credentials']);
        }

        if (count(DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()) > 0) {
            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
        }

        $kk=Siswa::where('id_account', $user->id)->get()[0]->NO_KK;
        $nama=Siswa::where('id_account', $user->id)->get()[0]->nama_lengkap;
        $decryption_key = $kk . $nama;
        if(strlen($decryption_key) > 32){
            $decryption_key = substr($decryption_key, 0, 32);
        }
        if(strlen($decryption_key) < 32){
            $decryption_key = str_pad($decryption_key, 32, 0);
        }

        $header = [
            "alg" => "HS256",
            "typ" => "JWT"
        ];
        $payload = [
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "role" => $user->role
            ],
            "iss" => time()
        ];
        $signature = base64_encode(
                hash_hmac(
                    'sha256',
                    json_encode($header) . "." . json_encode($payload),
                    $decryption_key,
                    true
                )
            );


        $tokenGen = $user->createToken('access_token')->plainTextToken;
        DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->update([
            'token' => hash('sha256', $signature)
        ]);

        $token = base64_encode(json_encode($header)) . "." . base64_encode(json_encode($payload)) . "." . $signature;

        $hashed = DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()[0]->token;

        $tokenget = explode('.', $token);
        $headers = json_decode(base64_decode($tokenget[0]));
        $payloads = json_decode(base64_decode($tokenget[1]));
        $signraw = $tokenget[2];


        $tempered = hash_equals(
            $signraw,
            base64_encode(
                hash_hmac(
                    'sha256',
                    json_encode($headers) . "." . json_encode($payloads),
                    $decryption_key,
                    true
                )
            )
        );
        $response = [
            'token'=>$token,
            // 'header'=>$headers,
            'payload'=>$payloads,
            // 'signature'=>$signraw,
            'decryption_key'=>base64_encode($decryption_key),
            // 'dec'=>$decryption_key,
            'valid'=>hash_equals($hashed, hash('sha256', $signraw)),
            'tempered'=>!$tempered
        ];
        return response()->json($response);
    }


    public function logout(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ],[
            'token.required' => 'Token is required',
        ]);
        $access_token_user_id = json_decode($this->verify_token($request->token));
        if($access_token_user_id->message != "success"){
            return response()->json(['message' => $access_token_user_id->message]);
        }
        DB::table('personal_access_tokens')->where('tokenable_id', $access_token_user_id->id)->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }
    public function transaction(Request $request){
        $request->validate([
            'token' => 'required'
        ],[
            'token.required' => 'Token is required',
        ]);
        $access_token_user_id = json_decode($this->verify_token($request->token));
        if($access_token_user_id->message != "success"){
            return response()->json(['message' => $access_token_user_id->message]);
        }
        $transction = Transaksi_SPP::withTrashed()
            ->leftJoin('spp_siswa', 'spp_siswa.id_spp_siswa', '=', 'transaksi_spp.id_spp')
            ->leftJoin('database_biodata_siswa', 'spp_siswa.id_siswa', '=', 'spp_siswa.id_siswa')
            ->leftJoin('users', 'database_biodata_siswa.id', '=', 'users.id')
            ->leftJoin('verifikasi_spp','transaksi_spp.id_transaksi','=','verifikasi_spp.id_transaksi')
            ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
            ->whereNotNull("NIS.id_NIS")
            ->where('database_biodata_siswa.id_account',$access_token_user_id->id)
            ->select(
                'transaksi_spp.*',
                'database_biodata_siswa.nama_lengkap',
                'database_biodata_siswa.id_account',
                'verifikasi_spp.status_verifikasi as status_verifikasi',
                'verifikasi_spp.id_verifikasi as id_verifikasi',
                'database_biodata_siswa.nisn',
                'NIS.id_NIS'
            )
            ->orderBy('transaksi_spp.tahun_ajaran', 'desc')
            ->orderBy('transaksi_spp.semester', 'desc')
            ->get();

        return response()->json([
            'message' => 'tansaction request success',
            'data' => $transction,
        ]);
    }
    public function verifikasi_SPP(Request $request){
        $request->validate([
            'token' => 'required',
            'id_verifikasi' => ['required','exists:verifikasi_spp,id_verifikasi'],
        ],[
            'token.required' => 'Token is required',
        ]);

        $access_token_user_id = json_decode($this->verify_token($request->token));
        if($access_token_user_id->message != "success"){
            return response()->json(['message' => $access_token_user_id->message]);
        }
        $verifikasi = verifikasi_SPP::where('id_verifikasi', $request->id_verifikasi)->first();
        $verifikasi->status_verifikasi = 1;
        $verifikasi->save();
        return response()->json([
            'message' => 'verifikasi request success',
            'data' => $verifikasi,
        ]);
    }
    public function upload_bukti_pembayaran(Request $request){
        $request->validate([
            'token' => 'required',
            'id_transaksi' => ['required','exists:transaksi_spp,id_transaksi'],
            'bukti_pembayaran' => ['required', 'mimetypes:application/pdf,image/jpg,image/jpeg,image/png','file', 'max:2048'],
        ],[
            'token.required' => 'Token diwajibkan diisi',
            'bukti_pembayaran.required' => 'Bukti pembayaran diwajibkan diisi',
            'bukti_pembayaran.file' => 'Bukti pembayaran diwajibkan berupa file',
            'bukti_pembayaran.mimetypes' => 'Bukti pembayaran bukan format pdf,jpg,jpeg,png',
        ]);
        $access_token_user_id = json_decode($this->verify_token($request->token));
        if($access_token_user_id->message != "success"){
            return response()->json(['message' => $access_token_user_id->message]);
        }
        $transksi = Transaksi_SPP::where('id_transaksi', $request->id_transaksi)
            ->leftJoin( 'spp_siswa','transaksi_spp.id_spp', '=', 'spp_siswa.id_spp_siswa' )
            ->leftJoin('database_biodata_siswa', 'spp_siswa.id_siswa', '=', 'database_biodata_siswa.id')
            ->first();
        if($transksi->id_account != $access_token_user_id->id){
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk upload bukti pembayaran transaksi ini'
            ]);
        }
        // //kalo mau berkali kali upload bukti pembayaran
        // if($transksi->bukti_pembayaran != null){
        //     return response()->json([
        //         'message' => 'Bukti pembayaran sudah diupload'
        //     ]);
        // }

        $fileNameToStore = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $filename = "bukti_pembayaran_".$request->id_transaksi;
            $fileExtension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension;
            FacadesStorage::putFileAs('bukti_pembayaran',$request->file('bukti_pembayaran'),$fileNameToStore);
        }
        $transaksi = DB::table('transaksi_spp')
        ->where('id_transaksi', $request->id_transaksi)
        ->update(['bukti_pembayaran' => $fileNameToStore]);
        return response()->json([
            'message' => 'Bukti pembayaran upload success',
            'user'=> $access_token_user_id->id
        ]);
    }
    public function download_struk(Request $request){
        $request->validate([
            'token' => 'required',
            'id_transaksi' => ['required','exists:transaksi_spp,id_transaksi'],
        ]);
        $access_token_user_id = json_decode($this->verify_token($request->token));
        if($access_token_user_id->message != "success"){
            return response()->json(['message' => $access_token_user_id->message]);
        }

        if(Transaksi_SPP::withTrashed()->where('id_transaksi', $request->id_transaksi)
            ->leftJoin( 'spp_siswa','transaksi_spp.id_spp', '=', 'spp_siswa.id_spp_siswa' )
            ->leftJoin('database_biodata_siswa', 'spp_siswa.id_siswa', '=', 'database_biodata_siswa.id')
            ->first()->id_account != $access_token_user_id->id){
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk upload bukti pembayaran transaksi ini'
            ]);
        }
        return FacadesStorage::download("struk/struk_".$request->id_transaksi.".pdf");
    }
    public function verify_token(String $token){
        $getToken = explode('.', $token);
        $header = json_decode(base64_decode($getToken[0]));
        if ($header->typ == "JWT") {
            $payload = json_decode(base64_decode($getToken[1]));
            $signraw = $getToken[2];
            if(DB::table('personal_access_tokens')->where('tokenable_id', $payload->user->id)->exists() == false){
                return json_encode([
                    'message' => 'token not found in DB'
                ]);
            }
            $hashed = DB::table('personal_access_tokens')->where('tokenable_id', $payload->user->id)->get()[0]->token;
            $valid = hash_equals($hashed, hash('sha256', $signraw));

            $kk=Siswa::where('id_account', $payload->user->id)->get()[0]->NO_KK;
            $nama=Siswa::where('id_account', $payload->user->id)->get()[0]->nama_lengkap;
            $decryption_key = $kk.$nama;
            if(strlen($decryption_key) > 32){
                $decryption_key = substr($decryption_key, 0, 32);
            }
            if(strlen($decryption_key) < 32){
                $decryption_key = str_pad($decryption_key, 32, 0);
            }

            $tempered = hash_equals(
                $signraw,
                base64_encode(
                    hash_hmac(
                        'sha256',
                        json_encode($header) . "." . json_encode($payload),
                        $decryption_key,
                        true
                    )
                )
            );
            if($valid && $tempered){
                if (User::where('id', $payload->user->id)->get()[0]->role != 'Siswa') {
                    return json_encode([
                        'message' => 'unauthorized user role'
                    ]);
                }
                return json_encode([
                    "message"=>"success",
                    "id"=>$payload->user->id
                ]);
            }
            return json_encode([
                'message' => 'invalid token'
            ]);
        }
        if ($header->typ == "SANCTUM") {
            $sanctum = explode('|', $getToken[1]);
            $id = $sanctum[0];
            $token = $sanctum[1];
            $record = DB::table('personal_access_tokens')->where('id', $id)->get()[0];
            if(hash_equals($record->token, hash('sha256', $token))){
                if (User::where('id', $record->tokenable_id)->get()[0]->role != 'Siswa') {
                    return json_encode([
                        'message' => 'unauthorized user role'
                    ]);
                }
                return json_encode([
                    "message"=>"success",
                    "id"=>$record->tokenable_id
                ]);
            }
            return json_encode([
                'message' => 'invalid token'
            ]);
        }
    }

    public function verify_requested_token(Request $request){
        $token = $request->token;
        $getToken = explode('.', $token);
        $header = json_decode(base64_decode($getToken[0]));
        if ($header->typ == "JWT") {
            $payload = json_decode(base64_decode($getToken[1]));
            $signraw = $getToken[2];
            if(DB::table('personal_access_tokens')->where('tokenable_id', $payload->user->id)->exists() == false){
                return json_encode([
                    'message' => 'token not found in DB'
                ]);
            }
            $hashed = DB::table('personal_access_tokens')->where('tokenable_id', $payload->user->id)->get()[0]->token;
            $valid = hash_equals($hashed, hash('sha256', $signraw));

            $kk=Siswa::where('id_account', $payload->user->id)->get()[0]->NO_KK;
            $nama=Siswa::where('id_account', $payload->user->id)->get()[0]->nama_lengkap;
            $decryption_key = $kk.$nama;
            if(strlen($decryption_key) > 32){
                $decryption_key = substr($decryption_key, 0, 32);
            }
            if(strlen($decryption_key) < 32){
                $decryption_key = str_pad($decryption_key, 32, 0);
            }

            $tempered = hash_equals(
                $signraw,
                base64_encode(
                    hash_hmac(
                        'sha256',
                        json_encode($header) . "." . json_encode($payload),
                        $decryption_key,
                        true
                    )
                )
            );
            if($valid && $tempered){
                if (User::where('id', $payload->user->id)->get()[0]->role != 'Siswa') {
                    return json_encode([
                        'message' => 'unauthorized user role'
                    ]);
                }
                return json_encode([
                    "message"=>"success",
                    "id"=>$payload->user->id
                ]);
            }
            return json_encode([
                'message' => 'invalid token'
            ]);
        }
        if ($header->typ == "SANCTUM") {
            $sanctum = explode('|', $getToken[1]);
            $id = $sanctum[0];
            $token = $sanctum[1];
            $record = DB::table('personal_access_tokens')->where('id', $id)->get()[0];
            if(hash_equals($record->token, hash('sha256', $token))){
                if (User::where('id', $record->tokenable_id)->get()[0]->role != 'Siswa') {
                    return json_encode([
                        'message' => 'unauthorized user role'
                    ]);
                }
                return json_encode([
                    "message"=>"success",
                    "id"=>$record->tokenable_id
                ]);
            }
            return json_encode([
                'message' => 'invalid token'
            ]);
        }
    }

}
