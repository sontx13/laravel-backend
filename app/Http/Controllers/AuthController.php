<?php

namespace App\Http\Controllers;

use App\Enums\LoaiNguoiDungEnum;
use App\Enums\TrangThaiHoatDongEnum;
use App\Helpers\KhaoSatUtils;
use App\Helpers\SmsUtils;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client as OClient;
use TCG\Voyager\Models\Role;

class AuthController extends Controller
{

    public $successStatus = Response::HTTP_OK;

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {

        $accept = $request->header('Accept');


        if ($accept == null || $accept != 'application/json') {
            return response()->json([
                'error_code' => 1,
                'message' => "HTTP_NOT_ACCEPTABLE"
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string'
            ]);

            if (!Auth::attempt(['username' => $request->username, 'password' => $request->password]))
                return response()->json([
                    'error_code' => 1,
                    'message' => "Thông tin đăng nhập không chính xác"
                ], Response::HTTP_OK);

            if (Auth::user()->status == TrangThaiHoatDongEnum::ChuaKichHoat) {
                return response()->json([
                    'error_code' => 1,
                    'message' => "Tài khoản người dùng chưa kích hoạt"
                ], Response::HTTP_OK);
            }
            if (Auth::user()->status == TrangThaiHoatDongEnum::DaKhoa) {
                return response()->json([
                    'error_code' => 1,
                    'message' => "Tài khoản người dùng đã bị khóa"
                ], Response::HTTP_OK);
            }

            $oClient = OClient::where('password_client', 1)->first();

             return response()->json([
                'error_code' => 0,
                'message' => 'Thành công',
                'data' => [
                    'oClient' => $oClient,
                    'email' => \auth()->user()->email
                ]
            ], Response::HTTP_OK);

            $token = $this->getTokenAndRefreshTokenByPassword($oClient, \auth()->user()->email, $request->password);

            $roles = $this->GetRoles(Auth::id());

            return response()->json([
                'error_code' => 0,
                'message' => 'Thành công',
                'data' => [
                    'token' => $token,
                    'roles' => $roles
                ]
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            response()->json([
                'error_code' => 1,
                'message' => $e->getMessage(),
            ], Response::HTTP_OK);
        }
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response()->json([
            'error_code' => 0,
            'message' => "Thành công",
        ], Response::HTTP_OK);
    }

    /* Lấy token mới từ refresh_token */
    public function getTokenAndRefreshTokenByRefreshToken(Request $request)
    {
        $oClient = OClient::where('password_client', 1)->first();

        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'scope' => ''
        ];
        $request = Request::create('/oauth/token', 'POST', $data);
        $result = json_decode(app()->handle($request)->getContent());

        return response()->json([
            'error_code' => 0,
            'message' => "Thành công",
            'data' => $result
        ], Response::HTTP_OK);

    }

    /* Lấy token mới từ password */
    public function getTokenAndRefreshTokenByPassword(OClient $oClient, $email, $password)
    {
        $oClient = OClient::where('password_client', 1)->first();
        $data = [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $email,
            'password' => $password,
            'scope' => ''
        ];
        $request = Request::create('/oauth/token', 'POST', $data);
        return json_decode(app()->handle($request)->getContent());
    }

    private function GetRoles($userid)
    {
        $query =
            "SELECT
            DISTINCT
	        b.name
        FROM
            (SELECT
	            ra.name
            FROM app_qcdc.users u
            LEFT JOIN app_qcdc.roles ra
	            ON u.role_id = ra.id
            WHERE
	            u.id = ?
            UNION
            SELECT
	            rb.name
            FROM  app_qcdc.user_roles ur
            LEFT JOIN app_qcdc.roles rb
	            ON ur.role_id = rb.id
            WHERE
	            ur.user_id = ?) b;
            ";
        return DB::select($query, [$userid, $userid]);
    }

    public function getInfors(Request $request)
    {
        $currentUser = Auth::user();
        $currentUser->avatar = env('APP_URL') . "/storage/users/default.png";;
        $roles = $this->GetRoles($currentUser->id);

        $query = "SELECT
                    u.*,
                    DATE_FORMAT(u.nam_sinh,'%d/%m/%Y') as nam_sinh
                    FROM users u WHERE u.id = ?";

        $user = DB::select($query, [$currentUser->id])[0];

        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => [
                'user' => $user,
                'roles' => $roles
            ]
        ], Response::HTTP_OK);

    }


    public function register(Request $request)
    {
        $validator = $this->validatorRegister($request);

        if (!$validator->passes()) {
            return response()->json([
                'message' => implode(', ', $validator->errors()->all()),
                'error_code' => 1
            ]);
        }
        $phone = $request->phone;
        $name = $request->name;
        $password = $request->password;
        $address = $request->address;

        if (!KhaoSatUtils::checkValidOTP($phone, $request->otp)) {
            return response()->json([
                'error_code' => 1,
                'message' => "OTP không hợp lệ"
            ]);
        }

        try {
            $roleCongDan = Role::where('name', 'congdan')->first();

            $user = new User();
            $user->role_id = $roleCongDan->id;
            $user->name = $name;
            $user->email = $phone;
            $user->password = Hash::make($password);
            //$user->settings = '{"locale":"vi"}';
            $user->username = $phone;
            $user->status = TrangThaiHoatDongEnum::DaKichHoat;
            $user->is_admin = 0;
            $user->donvi_id = 0;
            $user->dia_chi = $address;
            $user->is_canbo = LoaiNguoiDungEnum::CongDan;
            $user->donvi_id = 1;
            $user->save();

            return response()->json([
                'error_code' => 0,
                'message' => 'Tạo tài khoản thành công'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Lưu không thành công',
                'data' => $e->getMessage()
            ], 200);
        }
    }

    public function validOTP(Request $request)
    {
        $phone = $request->phone;
        $otp = $request->otp;
        if ($phone == null) {
            return response()->json([
                'error_code' => 1,
                'message' => "Số điện thoại không được để trống"
            ], Response::HTTP_OK);
        }
        if ($otp == null) {
            return response()->json([
                'error_code' => 1,
                'message' => "OTP không được để trống"
            ], Response::HTTP_OK);
        }
        if (KhaoSatUtils::checkValidOTP($phone, $otp)) {
            DB::table('users')
                ->where('username', $phone)
                ->update(['status' => TrangThaiHoatDongEnum::DaKichHoat]);
            return response()->json([
                'error_code' => 0,
                'message' => "Xác thực OTP thành công"
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'error_code' => 1,
                'message' => "OTP không chính xác"
            ], Response::HTTP_OK);
        }
    }

    public function guestLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sodienthoai' => 'required|regex:/[0-9]{10}/|digits:10',
            'hoten' => 'string|required',
        ], [
            'sodienthoai.required' => 'Vui lòng nhập số điện thoại',
            'sodienthoai.regex' => 'Số điện thoại không đúng',/**/
            'sodienthoai.digits' => 'Số điện thoại không đúng',
            'hoten.required' => 'Vui lòng nhập họ tên',
            'hoten.string' => 'Vui lòng nhập họ tên',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'error_code' => 1
            ]);
        }

        if (!Auth::attempt(['username' => 'guest', 'password' => 'Vnptbg12!']))
            return response()->json([
                'error_code' => 1,
                'message' => "Thông tin đăng nhập không chính xác"
            ], Response::HTTP_OK);

        $oClient = OClient::where('password_client', 1)->first();

        $token = $this->getTokenAndRefreshTokenByPassword($oClient, 'guest', 'Vnptbg12!');

        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => [
                'token' => $token
            ]
        ], Response::HTTP_OK);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'string|required',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'error_code' => 1
            ]);
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json([
                'message' => 'Mật khẩu hiện tại không đúng',
                'error_code' => 1
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Thay đổi mật khẩu thành công!',
            'error_code' => 0
        ]);
    }

    public function updateUserInfo(Request $request)
    {
        $user = Auth::user();

        if ($request->filled('ho_ten')) {
            $user->name = $request->ho_ten;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('so_dinh_danh')) {
            $user->so_dinh_danh = $request->so_dinh_danh;
        }
        if ($request->filled('nam_sinh')) {
            $user->nam_sinh = Carbon::createFromFormat('d/m/Y', $request->nam_sinh);
        }
        if ($request->filled('dia_chi')) {
            $user->dia_chi = $request->dia_chi;
        }
        if ($request->filled('gioi_tinh')) {
            $user->gioi_tinh = $request->gioi_tinh;
        }

        $user->save();

        return response()->json([
            'message' => 'Thay đổi thông tin thành công!',
            'error_code' => 0
        ]);
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/[0-9]{10}/|digits:10'
        ]);

        if (KhaoSatUtils::checkOTPRecently($request->phone)) {
            SmsUtils::sendSMSOTP($request->phone, $request->header('x-real-ip'));
        } else {
            return response()->json([
                'message' => 'Thao tác quá nhanh. Vui lòng thử lại sau 30s',
                'error_code' => 1
            ]);
        }
        return response()->json([
            'error_code' => 0,
            'message' => 'Gửi OTP thành công'
        ], 200);
    }

    public function validateRegister(Request $request)
    {
        $validator = $this->validatorRegister($request);

        if (!$validator->passes()) {
            return response()->json([
                'message' => implode(', ', $validator->errors()->all()),
                'error_code' => 1
            ]);
        }

        return response()->json([
            'error_code' => 0,
            'message' => "Dữ liệu hợp lệ"
        ], Response::HTTP_OK);
    }

    private function validatorRegister(Request $request)
    {
        return Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{10}/|digits:10|unique:users,username',
            'name' => 'required|string',
            'password' => 'required|string'
        ], [
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không đúng',
            'phone.digits' => 'Số điện thoại không đúng',
            'phone.unique' => 'Số điện thoại này đã được sử dụng, vui lòng sử dụng số điện thoại khác',
            'name.required' => 'Vui lòng nhập họ tên',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);
    }
}
