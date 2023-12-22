<?php
namespace App\Constant;

class ApiConstant {

	const MESSAGE_SEND_OTP = 'Ma OTP la %s het han sau %s phut';

	const CODE_SUCCESS = '0';
	const MESSAGE_SUCCESS = 'Thành công.';

	const CODE_SDT_DA_TONTAI = '2';
	const MESSAGE_SDT_DA_TONTAI = 'Số điện thoại đã tồn tại.';

	const CODE_SDT_KHONG_TONTAI = '-1';
	const MESSAGE_CODE_SDT_KHONG_TONTAI = 'Số điện thoại không tồn tại.';

	const CODE_AUTH_FAILED = '1';
	const MESSAGE_CODE_AUTH_FAILED = 'Xác thực không thành công.';

	const CODE_API_KEY_AUTH_FAILED = '3';
	const MESSAGE_CODE_API_KEY_AUTH_FAILED = 'api_key và api_password không đúng.';

	const CODE_OTP_KHONG_HOP_LE = '4';
	const MESSAGE_OTP_KHONG_HOP_LE = 'OTP không hợp lệ.';

	const CODE_TOKEN_KHONG_HOP_LE = '9';
	const MESSAGE_TOKEN_KHONG_HOP_LE = 'Token không hợp lệ.';

	const CODE_REQUEST_KHONG_HOP_LE = '422';
	const MESSAGE_REQUEST_KHONG_HOP_LE = 'Request không hợp lệ.';

	const CODE_API_EXCEPTION = '99';
}

