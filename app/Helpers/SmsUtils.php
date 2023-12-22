<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Constant\ApiConstant;

class SmsUtils
{
    public static function sendSMSOTP($mobile_no, $userip)
    {
		// generate OTP
        $otp = rand(1000,9999);
        $timeExprised = 3;
        $message = sprintf(ApiConstant::MESSAGE_SEND_OTP, $otp, $timeExprised);

        self::sendSMSVNPT($mobile_no, $otp);

		DB::table('smsotps')->insert([
            'mobile_no' => $mobile_no,
            'otp' => $otp,
            'expires_at' =>  Carbon::now()->addMinutes($timeExprised),
            'user_ip' => $userip,
            'created_at' =>  Carbon::now()
        ]);
    }

	public static function sendSMSVNPT($somay, $noidung)
    {
        $result = true;
        try
        {
            $noidung = sprintf('QCDC: OTP cua ban la %s', $noidung);

            $method = 'http://tempuri.org/GoiSMSVNPT';

            $body = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
                    <Body>
                        <GoiSMSVNPT xmlns="http://tempuri.org/">
                            <soMay>%s</soMay>
                            <noiDung>%s</noiDung>
                            <user>%s</user>
                            <pass>%s</pass>
                        </GoiSMSVNPT>
                    </Body>
                </Envelope>';
            $body = sprintf($body, $somay, $noidung, 'bgg_ws' , 'bgg_ws!2016');

            $url = 'http://10.21.30.152:8088/webservice.asmx';

            $client = new \GuzzleHttp\Client();

            $response = $client->post($url, ['body' => $body, 'headers' => ['content-type' => 'text/xml;charset=UTF-8', 'Accept' => 'text/xml', 'SOAPAction' => $method]]);
        }
        catch(Exception $e)
        {
            $result = false;
        }
		return $result;
    }

    public static function sendSMSUBND($somay, $otp)
    {
        $result = true;
        try
        {
            $somay = '84' . substr($somay, 1, 9);
            $method = 'http://tempuri.org/SentSMSUBND';

            $body = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
                    <Body>
                        <SentSMSUBND xmlns="http://tempuri.org/">
                            <userName>%s</userName>
                            <pass>%s</pass>
                            <donVi>%s</donVi>
                            <labelid>%s</labelid>
                            <templateid>%s</templateid>
                            <somay>%s</somay>
                            <username>%s</username>
                            <contractid>%s</contractid>
                            <param>
                                <string>%s</string>
                            </param>
                            <noiDung>%s</noiDung>
                        </SentSMSUBND>
                    </Body>
                </Envelope>';
            $body = sprintf($body, env('SMS_VNPT_USERNAME') , env('SMS_VNPT_PASS'), 7, env('SMS_VNPT_LABEL_ID'), env('SMS_VNPT_TEMPLATE_ID'), $somay, "BGG_CS", "427", $otp, "");

            $url = env('SMS_VNPT_SERVICE_URL');

            $client = new \GuzzleHttp\Client();

            $response = $client->post($url, ['body' => $body, 'headers' => ['content-type' => 'text/xml;charset=UTF-8', 'Accept' => 'text/xml', 'SOAPAction' => $method]]);
        }
        catch(Exception $e)
        {
            $result = false;
        }
		return $result;
    }

    public static function sendESMS($somay, $otp)
    {
        $result = true;

        try
        {
            $url = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=%s&Content=Ma OTP cua ban la %s&ApiKey=7A349DCC665CB89E20E4EB0D672FD8&SecretKey=A3DE6A773562B83E364CF847DDEF9E&Brandname=Verify&SmsType=2';

            $url = sprintf($url, $somay, $otp);

            $client = new \GuzzleHttp\Client();

            $response = $client->get($url);
        }
        catch(Exception $e)
        {
            $result = false;
        }

		return $result;
    }
}
