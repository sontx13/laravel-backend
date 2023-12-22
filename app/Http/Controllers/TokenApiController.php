<?php

namespace App\Http\Controllers;

use App\Models\UserDeviceToken;
use http\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TokenApiController extends Controller
{
    public $successStatus = Response::HTTP_OK;

    public function AddToken(Request $request)
    {
        $currentUser = Auth::user();
        $token = $request->token;
        $platform = $request->platform;
        $os = $request->os;
        $payload = $request->payload;
        if ($token == null || $token == "") {
            return response()->json([
                'error_code' => 1,
                'message' => "Token không được để trống"
            ], Response::HTTP_OK);
        }
        $usertoken = UserDeviceToken::where('user_id', $currentUser->id)
                                    ->where('token', $token)
                                    ->first();
        if ($usertoken != null) {
            return response()->json([
                'error_code' => 1,
                'message' => "Token này đã được thêm"
            ], Response::HTTP_OK);
        }
        DB::beginTransaction();
        try {
            DB::table('user_device_token')
            ->insert([
                'id' => 0,
                'user_id' => $currentUser->id,
                'token' => $token,
                'platform' => $platform,
                'os' => $os,
                'payload' => $payload,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'created_by' => $currentUser->id,
                'updated_by' => null
            ]);
            DB::commit();
            return response()->json([
                'error_code' => 0,
                'message' =>  'Thêm thành công',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error_code' => 1,
                'message' => $e->getMessage(),
            ], Response::HTTP_OK);
        }
    }
}
