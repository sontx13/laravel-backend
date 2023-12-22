<?php

namespace App\Http\Controllers\Voyager;

use App\Helpers\FileHelper;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends VoyagerBaseController
{
    public function UploadFileDinhKem(Request $request)
    {
        if (!isset($_FILES)) {
            return response()->json([
                'error_code' => '1',
                'message' => 'Danh sách file trống'
            ], 200);
        }
        $files = $request->file();
        foreach ($files as $file) {
            try {
                $vbFilePathAb = '/kehoachcongkhai/';
                $vbFilePath = public_path() . $vbFilePathAb;
                $name = md5(rand(0, 999999)) . '.' . $file->getClientOriginalExtension();
                $file->move($vbFilePath, $name);
                $pathReturn = $vbFilePathAb . $name;
                return response()->json([
                    'error_code' => '0',
                    'message' => 'Lưu file thành công',
                    'file_path' => $pathReturn
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'error_code' => '1',
                    'ex' => $e->getMessage()
                ], 200);
            }
        }
    }
}
