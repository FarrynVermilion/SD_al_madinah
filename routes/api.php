<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', function (Request $request) {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    });
});
Route::post('/token/request', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
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

    $tokenGen = $user->createToken('access_token')->plainTextToken;
    $token = explode('|', $tokenGen)[1];
    $hashed = DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()[0]->token;
    $correct = hash_equals($hashed, hash('sha256', $token));

    $response = [
        'user'  => $user,
        'token' => $tokenGen,
        'valid' => $correct,
        'DB' => DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()
    ];

    return $response;
});

