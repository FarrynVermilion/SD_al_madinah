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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


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
        } else if (!Hash::check($request->password, $user->password)) {
            return response(['payback' => 'Incorrect Credentials']);
        }

        if (count(DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()) > 0) {
            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
        }


        $kk=Siswa::where('id_account', $user->id)->get()[0]->no_kk;
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
        } else if (!Hash::check($request->password, $user->password)) {
            return response(['payback' => 'Incorrect Credentials']);
        }

        if (count(DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()) > 0) {
            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
        }

        $kk=Siswa::where('id_account', $user->id)->get()[0]->no_kk;
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
                    $payloads->decryption_key,
                    true
                )
            )
        );
        $response = [
            'token'=>$token,
            // 'header'=>$headers,
            // 'payload'=>$payloads,
            // 'signature'=>$signraw,
            'decryption_key'=>base64_encode($decryption_key),
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

        $getToken = explode('.', $request->token);
        $header = json_decode(base64_decode($getToken[0]));

        if($header->typ == "JWT"){
            $payload = json_decode(base64_decode($getToken[1]));
            $signraw = $getToken[2];
            $hashed = DB::table('personal_access_tokens')->where('tokenable_id', $payload->user->id)->get()[0]->token;
            if($hashed == null){
                return response()->json([
                    'message' => 'unauthorized'
                ]);
            }
            $valid = hash_equals($hashed, hash('sha256', $signraw));
            $tempered = hash_equals(
                $signraw,
                base64_encode(
                    hash_hmac(
                        'sha256',
                        json_encode($header) . "." . json_encode($payload),
                        $payload->decryption_key,
                        true
                    )
                )
            );
            if($valid && $tempered){
                DB::table('personal_access_tokens')->where('tokenable_id', $payload->user->id)->delete();
                return response()->json([
                    'message' => 'logout success'
                ]);
            }else{
                return response()->json([
                    'message' => 'unauthorized'
                ]);
            }
        }
        if($header->typ == "SANCTUM"){
            $sanctum = explode("|", $getToken[1]);
            $id = $sanctum[0];
            $token = $sanctum[1];
            $hashed = DB::table('personal_access_tokens')->where('id', $id)->get()[0]->token;

            if(hash_equals($hashed, hash('sha256', $token))){
                DB::table('personal_access_tokens')->where('id', $id)->delete();
            }else{
                return response()->json([
                    'message' => 'unauthorized'
                ]);
            }

            return response()->json([
                'message' => 'logout success'
            ]);
        }
        return response()->json([
            'message' => 'unauthorized unknown token type',
        ]);
    }
    public function transaction(Request $request){
        $request->validate([
            'token' => 'required'
        ],[
            'token.required' => 'Token is required',
        ]);
        $getToken = explode('.', $request->token);
        $header = json_decode(base64_decode($getToken[0]));
        if ($header->typ == "JWT") {
            $payload = json_decode(base64_decode($getToken[1]));
            $signraw = $getToken[2];
            $hashed = DB::table('personal_access_tokens')->where('tokenable_id', $payload->user->id)->get()[0]->token;
            if($hashed == null){
                return response()->json([
                    'message' => 'unauthorized'
                ]);
            }
            $valid = hash_equals($hashed, hash('sha256', $signraw));
            $tempered = hash_equals(
                $signraw,
                base64_encode(
                    hash_hmac(
                        'sha256',
                        json_encode($header) . "." . json_encode($payload),
                        $payload->decryption_key,
                        true
                    )
                )
            );
            if($valid && $tempered){
                if (User::where('id', $payload->user->id)->get()[0]->role != 'Siswa') {
                    return response()->json([
                        'message' => 'unauthorized'
                    ]);
                }
                $transction = Transaksi_SPP::withTrashed()
                ->join('spp_siswa', 'spp_siswa.id_spp_siswa', '=', 'transaksi_spp.id_spp')
                ->join('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
                ->join('users', 'users.id', '=', 'database_biodata_siswa.id')
                ->where('database_biodata_siswa.id_account',$payload->user->id)
                ->select(
                    'transaksi_spp.*',
                    'database_biodata_siswa.nama_lengkap',
                    'database_biodata_siswa.id_account'
                )->get();
                return response()->json($transction);
            }else{
                return response()->json([
                    'message' => 'unauthorized'
                ]);
            }
        }
        if ($header->typ == "SANCTUM") {
            $sanctum = explode('|', $getToken[1]);
            $id = $sanctum[0];
            $token = $sanctum[1];
            //kalo jwt unvlock ini
            $record = DB::table('personal_access_tokens')->where('id', $id)->get()[0];
            if(hash_equals($record->token, hash('sha256', $token))){
                if (User::where('id', $record->tokenable_id)->get()[0]->role != 'Siswa') {
                    return response()->json([
                        'message' => 'unauthorized'
                    ]);
                }
                $transction = Transaksi_SPP::withTrashed()
                ->join('spp_siswa', 'spp_siswa.id_spp_siswa', '=', 'transaksi_spp.id_spp')
                ->join('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
                ->join('users', 'users.id', '=', 'database_biodata_siswa.id')
                ->where('database_biodata_siswa.id_account',$record->tokenable_id)
                ->select(
                    'transaksi_spp.*',
                    'database_biodata_siswa.nama_lengkap',
                    'database_biodata_siswa.id_account'
                )->get();

                return response()->json([
                    'message' => 'tansaction request success',
                    'data' => $transction,
                ]);
            }
        }

        return response()->json([
            'message' => 'unauthorized',
        ]);
    }
}
