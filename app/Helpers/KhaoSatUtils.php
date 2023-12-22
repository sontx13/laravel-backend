<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class KhaoSatUtils
{
    public static function checkOTPRecently($mobile_no)
    {
        $result = true;

        $query = "SELECT otp FROM smsotps WHERE mobile_no = ? AND is_valid = 0 AND TIMESTAMPDIFF(second, created_at, NOW()) <= 30";
        $data = DB::select($query, [$mobile_no]);

        if (sizeof($data) > 0){
            $result = false;
        }

        return $result;
    }

    public static function checkValidRecently($mobile_no, $otp)
    {
        $isValidOtp = DB::table('smsotps')->where('mobile_no', '=', $mobile_no)
            ->where('otp', '=', $otp)
            ->whereTime('expires_at', '>=', Carbon::now()->subMinutes((int)env('SMS_OTP_TIME_EXPRISED_EXPAND')))
            ->get('id')
            ->toJson();

        $array = json_decode($isValidOtp);

        if (sizeof($array) == 0){
            return false;
        }else{
            return true;
        }
    }

    public static function checkValidOTP($mobile_no, $otp)
    {
        $result = false;

        $query = "SELECT otp FROM smsotps WHERE mobile_no = ? AND is_valid = 0 AND expires_at >= NOW() ORDER BY id DESC LIMIT 1";
        $data = DB::select($query, [$mobile_no]);

        if (sizeof($data) == 1){
            if ($data[0]->otp == $otp){
                DB::table('smsotps')->where('mobile_no', $mobile_no)->update(['is_valid' => 1]);
                $result = true;
            }
        }

        return $result;
    }
}
