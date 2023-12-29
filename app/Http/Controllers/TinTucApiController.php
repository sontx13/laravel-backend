<?php

namespace App\Http\Controllers;

use App\Models\UserDeviceToken;
use http\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Models\Post;

class TinTucApiController extends Controller
{
    public $successStatus = Response::HTTP_OK;

    public function GetDsTinTucs(Request $request)
    {
        $pagesize = $request->pagesize ?? 10;
        $pagenumber = $request->pagenumber ?? 1;
        $dsPosts = $this->GetTinTucs($pagenumber, $pagesize);
        return response()->json([
            'error_code' => 0,
            'message' => "Thành công",
            'data' => $dsPosts
        ], Response::HTTP_OK);
    }

    private function GetTinTucs($page, $pagesize)
    {
        $query =
            "SELECT
            p.*,
            IFNULL(c.name, 'Dân vận') as category_name
        FROM posts p
        LEFT JOIN categories c
            ON p.category_id = c.id
        WHERE
            p.published_at IS NOT NULL
            ORDER BY p.published_at DESC
            LIMIT ?,?;";
        return DB::select($query, [($page - 1) * $pagesize, $pagesize]);
    }

    public function GetDsTinTucsByCategory(Request $request)
    {
        $pagesize = $request->pagesize ?? 10;
        $pagenumber = $request->pagenumber ?? 1;

        $query = "SELECT
                    c.id cat_id,
                    c.name cat_name,
                    c.is_show_image,
                    p.*
                FROM
                    posts p
                    LEFT JOIN categories c ON p.category_id = c.id
                WHERE
                    p.status = 'PUBLISHED'
                    AND p.category_id = ?
                ORDER BY
                    p.published_at DESC
                    LIMIT ?,?";
        $data = DB::select($query, [$request->category_id, ($pagenumber - 1) * $pagesize, $pagesize]);

        return response()->json([
            'error_code' => 0,
            'message' => "Thành công",
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function GetCategories(Request $request)
    {
        $query = "SELECT * FROM categories";
        $data = DB::select($query);

        return response()->json([
            'error_code' => 0,
            'message' => "Thành công",
            'data' => $data
        ], Response::HTTP_OK);
    }
}
