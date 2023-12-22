<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DmMucCk;
use App\Models\DmNhomCk;
use App\Models\DonVi;
use App\Models\KetquaThuchienCongkhai;
use App\Models\Posts;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\KetquaThuchienCongkhaiNew;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataUpdated;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Intervention\Image\Facades\Image;
use ZipArchive;

class KetQuaThucHienCongKhaiNewController extends VoyagerBaseController
{
    public function generateQRCode()
    {
        set_time_limit(3000000);
        // $data = [];
        // $data[1] = [
        //     'id' => 1,
        //     'name' => 'lấy ý kiến của cán bộ, công chức về nội dung thực hiện QCDC tại cơ quan cấp xã',
        // ];
        // $data[2] = [
        //     'id' => 2,
        //     'name' => 'lấy ý kiến của người dân đối với chủ tịch UBND cấp xã',
        // ];
        // $data[3] = [
        //     'id' => 3,
        //     'name' => 'lấy ý kiến của người dân về kết quả thực hiện QCDC ở cấp xã',
        // ];
        // $data[4] = [
        //     'id' => 4,
        //     'name' => 'lấy ý kiến của người dân, tổ chức về thực hiện thủ tục hành chính',
        // ];
        // $data[5] = [
        //     'id' => 5,
        //     'name' => 'lấy ý kiến của người dân đối với công chức làm việc tại bộ phận một cửa',
        // ];
        // $data[6] = [
        //     'id' => 6,
        //     'name' => 'lấy ý kiến của người dân về nội dung văn minh, văn hóa công sở của UBND cấp xã',
        // ];
        // $data[7] = [
        //     'id' => 7,
        //     'name' => 'mức độ hài lòng của người dân đối với chính quyền thân thiện',
        // ];

        // for ($z = 1; $z <= 7; $z++) {
        //     $id_pks = $data[$z]['id'];
        //     $ten_pks = $data[$z]['name'];
        //     for ($j = 2; $j < 12; $j++) {
        //         $lsDV = DonVi::where('id_donvi_cha', $j)->get();
        //         $ten_dv_cha = DonVi::find($j);
        //         $phpWord = new PhpWord();
        //         $section = $phpWord->addSection();
        //         $textTitle = $section->addTextRun([
        //             'alignment' => 'center',
        //         ]);
        //         $textTitle->addText("QRCode {$ten_pks} {$ten_dv_cha->ten_donvi}", [
        //             'name' => 'Times New Roman',
        //             'size' => 16,
        //             'bold' => true,
        //         ]);
        //         if ($z == 5) {
        //             $url = "https://qcdc.bacgiang.gov.vn/khaosat/index.jsp?id={$j}&type={$id_pks}";
        //             $qrCode = QrCode::format('png')->size(400)->generate($url);
        //             $image = Image::make($qrCode);
        //             $image->encode('jpg', 100);
        //             $imagePath = storage_path("app\public\qr_code_temp_{$j}_type{$id_pks}.jpg");
        //             $image->save($imagePath);
        //             $section->addImage($imagePath, [
        //                 'width' => 400,
        //                 'height' => 400,
        //                 'alignment' => 'center',
        //             ]);
        //         }
        //         for ($i = 0; $i < $lsDV->count(); $i++) {
        //             $id = $lsDV[$i]->id;
        //             $name = $lsDV[$i]->ten_donvi;
        //             $url = "https://qcdc.bacgiang.gov.vn/khaosat/index.jsp?id={$id}&type={$id_pks}";
        //             $qrCode = QrCode::format('png')->size(400)->generate($url);
        //             $image = Image::make($qrCode);
        //             $image->encode('jpg', 100);
        //             $imagePath = storage_path("app\public\qr_code_temp_{$id}_type{$id_pks}.jpg");
        //             $image->save($imagePath);
        //             $textRun = $section->addTextRun([
        //                 'alignment' => 'center',
        //             ]);
        //             $textRun->addText("Khảo sát {$ten_pks} tại ", [
        //                 'name' => 'Times New Roman',
        //                 'size' => 16,
        //             ]);
        //             $textRun->addText("{$name} - {$ten_dv_cha->ten_donvi}", [
        //                 'name' => 'Times New Roman',
        //                 'size' => 16,
        //                 'bold' => true,
        //             ]);
        //             $section->addImage($imagePath, [
        //                 'width' => 400,
        //                 'height' => 400,
        //                 'alignment' => 'center',
        //             ]);
        //             $section->addPageBreak();
        //             $fileName = "PKS{$id_pks} - {$ten_pks} - {$ten_dv_cha->ten_donvi}.docx";
        //             $filePath = storage_path($fileName);
        //             $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        //             $objWriter->save($filePath);
        //         }
        //     }
        // }


        // $zipPath = storage_path('app/public/multiple_files.zip');
        // $zip = new ZipArchive();
        // if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        //     $docxDirectory = storage_path('');
        //     $docxFiles = glob($docxDirectory . '/*.docx');
        //     foreach ($docxFiles as $docxFile) {
        //         // Lấy tên tệp tin
        //         $fileName = pathinfo($docxFile, PATHINFO_BASENAME);
        //         $zip->addFile($docxFile, $fileName);
        //     }
        //     $zip->close();
        // }
        // $headers = [
        //     'Content-Type' => 'application/zip',
        // ];
        // return response()->download($zipPath, 'multiple_files.zip', $headers)->deleteFileAfterSend(true);

        $url = "https://qcdc.bacgiang.gov.vn/khaosat/index.jsp?id=12&type=5";
        $qrCode = QrCode::format('png')->size(400)->generate($url);
        $image = Image::make($qrCode);
        $image->encode('jpg', 100);
        $imagePath = storage_path("app\public\qr_code_temp_12_type5.jpg");
        $image->save($imagePath);
        // $section->addImage($imagePath, [
        //     'width' => 400,
        //     'height' => 400,
        //     'alignment' => 'center',
        // ]);
    }
    public function Index_CongKhai(Request $request)
    {

        $idXa = $request->idXa;
        $donvi_xa = $idXa != null ? DonVi::where('id', $idXa)->get() : null;
        $lsDonVis = DonVi::where('id_donvi_cha', 1)->where('id', '<>', 12)->orderBy('ten_donvi', 'asc')->get();

        $idHuyen = $request->idHuyen;
        $donvi_huyen = $idHuyen != null ? DonVi::where('id', $idHuyen)->get() : null;
        if ($idHuyen != null) {
            $lsDonVis = DonVi::where('id_donvi_cha', $idHuyen)->orderBy('ten_donvi', 'asc')->get();
        }

        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();

        $view = 'voyager::ketqua-thuchien-congkhai-new.index-congkhai';
        $currentUser = Auth::user();
        $sdt = $currentUser != null ? $currentUser->username : null;


        $startOfMonth = Carbon::now()->startOfYear();
        $endOfMonth = Carbon::now()->endOfYear();
        $lsKQ = KetquaThuchienCongkhaiNew::query()->with('nhom')->with('muc');

        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();





        $lsNhom = DmNhomCk::all();
        $lsRes = collect();

        for ($i = 0; $i < $lsNhom->count(); $i++) {

            $lsKQ = KetquaThuchienCongkhaiNew::query()->with('nhom')->with('muc');
            $lsKQ = $lsKQ->where('nhom_congkhai', '=', $lsNhom[$i]->id)->get();
            if ($lsKQ->count() > 0) {
                if ($request->idXa != null && $request->idXa != 0) {
                    $lsKQ = $lsKQ->where('donvi_id', '=', $request->idXa);
                    $idXa = $request->idXa;
                }
                if (($request->idHuyen != null && $request->idXa == 0 && $request->idHuyen != 0)) {
                    $lsDonvi = DonVi::where('id_donvi_cha', '=', $request->idHuyen)->get();
                    $lsid = [];
                    for ($j = 0; $j < $lsDonvi->count(); $j++) {
                        array_push($lsid, $lsDonvi[$j]->id);
                    }
                    $lsKQ = $lsKQ->whereIn('donvi_id', $lsid);
                    $idHuyen = $request->idHuyen;
                }
                if ($request->idHuyen != null) {
                    $idHuyen = $request->idHuyen;
                }
                if ($request->tu_ngay != null && $request->den_ngay != null) {
                    $startDate = Carbon::createFromFormat('d-m-Y', $request->tu_ngay)->startOfDay();
                    $endDate = Carbon::createFromFormat('d-m-Y',  $request->den_ngay)->endOfDay();
                    $lsKQ = $lsKQ->whereBetween('ngay_bd_congkhai', [$startDate, $endDate]);
                    $tungay = $request->tu_ngay;
                    $denngay = $request->den_ngay;
                }
                if ($request->tu_ngay == null && $request->den_ngay == null) {
                    $lsKQ = $lsKQ->whereBetween('ngay_bd_congkhai', [$startOfMonth, $endOfMonth]);
                }

                if ($lsKQ->count() > 0) {
                    $item = new KetquaThuchienCongkhaiNew;

                    $item->manhom = $lsNhom[$i]->ma_nhom;
                    $item->nd = $lsNhom[$i]->noi_dung;
                    $item->id = 1;
                    $lsRes->push($item);
                    $lsRes = $lsRes->concat($lsKQ);
                }
            }
        }
        $itemsPerPage = 1000; // Số lượng mục hiển thị trên mỗi trang
        $currentPage = request()->get('page', 1); // Lấy trang hiện tại từ query parameter, mặc định là trang 1
        $collection = collect($lsRes); // Chuyển đổi thành đối tượng Collection
        $paginatedItems = $collection->slice(($currentPage - 1) * $itemsPerPage, $itemsPerPage)->all();

        $lsResPage = new LengthAwarePaginator(
            $paginatedItems,
            $collection->count(),
            $itemsPerPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        $lsResPage->appends(['page' => $currentPage]);
        //dd($count);
        $count = $lsResPage->count();


        $data = [];
        $data[1] = [
            'id' => "PKS01",
            'name' => 'lấy ý kiến của cán bộ, công chức về nội dung thực hiện QCDC tại cơ quan cấp xã',
            'obj' => 'Cán bộ, công chức'
        ];
        $data[2] = [
            'id' => "PKS02",
            'name' => 'lấy ý kiến của người dân đối với chủ tịch UBND cấp xã',
            'obj' => 'Người dân'
        ];
        $data[3] = [
            'id' => "PKS03",
            'name' => 'lấy ý kiến của người dân về kết quả thực hiện QCDC ở cấp xã',
            'obj' => 'Người dân'
        ];
        $data[4] = [
            'id' => "PKS04",
            'name' => 'lấy ý kiến của người dân, tổ chức về thực hiện thủ tục hành chính',
            'obj' => 'Người dân, doanh nghiệp'
        ];
        $data[5] = [
            'id' => "PKS05",
            'name' => 'lấy ý kiến của người dân đối với công chức làm việc tại bộ phận một cửa',
            'obj' => 'Người dân, doanh nghiệp'
        ];
        $data[6] = [
            'id' => "PKS06",
            'name' => 'lấy ý kiến của người dân về nội dung văn minh, văn hóa công sở của UBND cấp xã',
            'obj' => 'Người dân'
        ];
        $data[7] = [
            'id' => "PKS07",
            'name' => 'mức độ hài lòng của người dân đối với chính quyền thân thiện',
            'obj' => 'Người dân'
        ];

        return Voyager::view($view, compact('data', 'lsResPage', 'lsDonVis', 'idXa', 'idHuyen', 'sdt', 'donvi_xa', 'donvi_huyen', 'lsPosts', 'lsKQ', 'count', 'tungay', 'denngay'));
    }

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];

        $searchNames = [];
        if ($dataType->server_side) {
            $searchNames = $dataType->browseRows->mapWithKeys(function ($row) {
                return [$row['field'] => $row->getTranslatedAttribute('display_name')];
            });
        }

        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', $dataType->order_direction);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $query = $model::select($dataType->name . '.*');

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query->{$dataType->scope}();
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%' . $search->value . '%';

                $searchField = $dataType->name . '.' . $search->key;
                if ($row = $this->findSearchableRelationshipRow($dataType->rows->where('type', 'relationship'), $search->key)) {
                    $query->whereIn(
                        $searchField,
                        $row->details->model::where($row->details->label, $search_filter, $search_value)->pluck('id')->toArray()
                    );
                } else {
                    if ($dataType->browseRows->pluck('field')->contains($search->key)) {
                        $query->where($searchField, $search_filter, $search_value);
                    }
                }
            }

            $row = $dataType->rows->where('field', $orderBy)->firstWhere('type', 'relationship');
            if ($orderBy && (in_array($orderBy, $dataType->fields()) || !empty($row))) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                if (!empty($row)) {
                    $query->select([
                        $dataType->name . '.*',
                        'joined.' . $row->details->label . ' as ' . $orderBy,
                    ])->leftJoin(
                        $row->details->table . ' as joined',
                        $dataType->name . '.' . $row->details->column,
                        'joined.' . $row->details->key
                    );
                }

                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        // Actions
        $actions = [];
        if (!empty($dataTypeContent->first())) {
            foreach (Voyager::actions() as $action) {
                $action = new $action($dataType, $dataTypeContent->first());

                if ($action->shouldActionDisplayOnDataType()) {
                    $actions[] = $action;
                }
            }
        }

        // Define showCheckboxColumn
        $showCheckboxColumn = false;
        if (Auth::user()->can('delete', app($dataType->model_name))) {
            $showCheckboxColumn = true;
        } else {
            foreach ($actions as $action) {
                if (method_exists($action, 'massAction')) {
                    $showCheckboxColumn = true;
                }
            }
        }

        // Define orderColumn
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
            $orderColumn = [[$index, $sortOrder ?? 'desc']];
        }

        // Define list of columns that can be sorted server side
        $sortableColumns = $this->getSortableColumns($dataType->browseRows);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }



        $startOfMonth = Carbon::now()->startOfYear();
        $endOfMonth = Carbon::now()->endOfYear();

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $dvx = 0;
        $tungay = '';
        $denngay = '';
        $lsNhom = DmNhomCk::all();
        $lsRes = collect();
        if ($request->donvi_huyen == null && auth()->user()->donvi_id < 12) {
            $donvis = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        if ($request->donvi_huyen) {
            $donvis = DonVi::where('id_donvi_cha', $request->donvi_huyen)->get();
        }
        for ($i = 0; $i < $lsNhom->count(); $i++) {
            $lsKQ = KetquaThuchienCongkhaiNew::query()->with('nhom')->with('muc');
            $lsKQ = $lsKQ->where('nhom_congkhai', '=', $lsNhom[$i]->id)->get();
            if ($lsKQ->count() > 0) {
                if ((auth()->user()->donvi_id > 1 && auth()->user()->donvi_id < 12)) {
                    $lsDonvi = DonVi::where('id_donvi_cha', '=', auth()->user()->donvi_id)->get();
                    $lsid = [];
                    for ($j = 0; $j < $lsDonvi->count(); $j++) {
                        array_push($lsid, $lsDonvi[$j]->id);
                    }
                    $lsKQ = $lsKQ->whereIn('donvi_id', $lsid);
                }
                if ((auth()->user()->donvi_id > 12 && $request->donvi_huyen == null && $request->donvi_xa == null)) {
                    $lsKQ = $lsKQ->where('donvi_id', '=', auth()->user()->donvi_id);
                    $dvx = auth()->user()->donvi_id;
                }


                if ($request->donvi_xa != null && $request->donvi_xa != 0) {
                    $lsKQ = $lsKQ->where('donvi_id', '=', $request->donvi_xa);
                    $dvx = $request->donvi_xa;
                }
                if (($request->donvi_huyen != null && $request->donvi_xa == 0 && $request->donvi_huyen != 0)) {
                    $lsDonvi = DonVi::where('id_donvi_cha', '=', $request->donvi_huyen)->get();
                    $lsid = [];
                    for ($j = 0; $j < $lsDonvi->count(); $j++) {
                        array_push($lsid, $lsDonvi[$j]->id);
                    }
                    $lsKQ = $lsKQ->whereIn('donvi_id', $lsid);
                    $dvh = $request->donvi_huyen;
                }
                if ($request->donvi_huyen != null) {
                    $dvh = $request->donvi_huyen;
                }
                if ($request->tu_ngay != null && $request->den_ngay != null) {
                    $startDate = Carbon::createFromFormat('d-m-Y', $request->tu_ngay)->startOfDay();
                    $endDate = Carbon::createFromFormat('d-m-Y',  $request->den_ngay)->endOfDay();
                    $lsKQ = $lsKQ->whereBetween('ngay_bd_congkhai', [$startDate, $endDate]);
                    $tungay = $request->tu_ngay;
                    $denngay = $request->den_ngay;
                }
                if ($request->tu_ngay == null && $request->den_ngay == null) {
                    $lsKQ = $lsKQ->whereBetween('ngay_bd_congkhai', [$startOfMonth, $endOfMonth]);
                    $tungay = $startOfMonth;
                    $denngay = $endOfMonth;
                }
                if ($lsKQ->count() > 0) {

                    $item = new KetquaThuchienCongkhaiNew;
                    $item->manhom = $lsNhom[$i]->ma_nhom;
                    $item->nd = $lsNhom[$i]->noi_dung;
                    $item->id = 1;
                    $lsRes->push($item);
                    $lsRes = $lsRes->concat($lsKQ);
                }
            }
        }
        $itemsPerPage = 1000; // Số lượng mục hiển thị trên mỗi trang
        $currentPage = request()->get('page', 1); // Lấy trang hiện tại từ query parameter, mặc định là trang 1

        $collection = collect($lsRes); // Chuyển đổi thành đối tượng Collection

        $paginatedItems = $collection->slice(($currentPage - 1) * $itemsPerPage, $itemsPerPage)->all();

        $lsResPage = new LengthAwarePaginator(
            $paginatedItems,
            $collection->count(),
            $itemsPerPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        $lsResPage->appends(['page' => $currentPage]);

        $count = $lsResPage->count();
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();


        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        if (auth()->user()->donvi_id == 1) {
            if ($request->donvi_xa != 0) {
                $baocaotonghop = false;
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            }
            if (($request->donvi_huyen != null && $request->donvi_xa == 0) || ($request->donvi_huyen != 0 && $request->donvi_xa == 0)) {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
            if ($request->donvi_huyen == 0 && $request->donvi_xa == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
                $lsHuyen->pop();
            }
            for ($i = 0; $i < $lsHuyen->count(); $i++) {
                $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
                $lsHuyen[$i]->tong_so = $item->count();
                $totalMuc = 0;
                $total = 0;
                for ($j = 0; $j < $item->count(); $j++) {
                    if ($request->tu_ngay != null) {
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id);
                    }
                    if ($request->tu_ngay != null && $request->den_ngay != null) {
                        $startDate = Carbon::createFromFormat('d-m-Y', $request->tu_ngay)->startOfDay();
                        $endDate = Carbon::createFromFormat('d-m-Y',  $request->den_ngay)->endOfDay();
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id)->whereBetween('ngay_bd_congkhai', [$startDate, $endDate]);
                        $tungay = $request->tu_ngay;
                        $denngay = $request->den_ngay;
                    }
                    if ($request->tu_ngay == null && $request->den_ngay == null) {
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id)->whereBetween('ngay_bd_congkhai', [$startOfMonth, $endOfMonth]);
                        $tungay = $startOfMonth;
                        $denngay = $endOfMonth;
                    }
                    if ($KQ->count()) {
                        $item[$j]->dem = $KQ->count();
                        $item[$j]->check = 1;
                        $totalMuc = $totalMuc + $KQ->count();
                        $total = $total + 1;
                    }
                }
                $lsHuyen[$i]->tong_so_muc = $totalMuc;
                $lsHuyen[$i]->total = $total;
                $lsXa = $lsXa->concat($item);
            }
        }
        if (auth()->user()->donvi_id > 1 && auth()->user()->donvi_id < 12) {
            if ($request->donvi_xa != 0) {
                $baocaotonghop = false;
            }
            $lsHuyen = Donvi::where('id', '=', auth()->user()->donvi_id)->get();
            for ($i = 0; $i < $lsHuyen->count(); $i++) {
                $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
                $lsHuyen[$i]->tong_so = $item->count();
                $totalMuc = 0;
                $total = 0;
                for ($j = 0; $j < $item->count(); $j++) {
                    if ($request->tu_ngay != null) {
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id);
                    }
                    if ($request->tu_ngay != null && $request->den_ngay != null) {
                        $startDate = Carbon::createFromFormat('d-m-Y', $request->tu_ngay)->startOfDay();
                        $endDate = Carbon::createFromFormat('d-m-Y',  $request->den_ngay)->endOfDay();
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id)->whereBetween('ngay_bd_congkhai', [$startDate, $endDate]);
                        $tungay = $request->tu_ngay;
                        $denngay = $request->den_ngay;
                    }
                    if ($request->tu_ngay == null && $request->den_ngay == null) {
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id)->whereBetween('ngay_bd_congkhai', [$startOfMonth, $endOfMonth]);
                        $tungay = $startOfMonth;
                        $denngay = $endOfMonth;
                    }
                    if ($KQ->count()) {
                        $item[$j]->dem = $KQ->count();
                        $item[$j]->check = 1;
                        $total = $total + 1;
                        $totalMuc = $totalMuc + $KQ->count();
                    }
                }
                $lsHuyen[$i]->tong_so_muc = $totalMuc;
                $lsHuyen[$i]->total = $total;
                $lsXa = $lsXa->concat($item);
            }
        }
      
        if (auth()->user()->donvi_id > 12) {
            $baocaotonghop = false;
        }
        $currentYear = Carbon::now()->year;
        $checkTH = 0;
        if ($request->checkTH) {
            $checkTH = $request->checkTH;
        }
        $checkTHNSL =0;
        if ($request->checkTHNSL) {
            $checkTHNSL = $request->checkTHNSL;
            $checkTH = $request->checkTHNSL;
        }
        if($checkTHNSL == 1){
            $baocaotonghop = true;
            $donvicha = Donvi::where('id', '=', auth()->user()->donvi_id)->get();
            $lsHuyen = Donvi::where('id', '=', $donvicha[0]->id_donvi_cha)->get();
            for ($i = 0; $i < $lsHuyen->count(); $i++) {
                $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
                $lsHuyen[$i]->tong_so = $item->count();
                $totalMuc = 0;
                $total = 0;
                for ($j = 0; $j < $item->count(); $j++) {
                    if ($request->tu_ngay != null) {
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id);
                    }
                    if ($request->tu_ngay != null && $request->den_ngay != null) {
                        $startDate = Carbon::createFromFormat('d-m-Y', $request->tu_ngay)->startOfDay();
                        $endDate = Carbon::createFromFormat('d-m-Y',  $request->den_ngay)->endOfDay();
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id)->whereBetween('ngay_bd_congkhai', [$startDate, $endDate]);
                        $tungay = $request->tu_ngay;
                        $denngay = $request->den_ngay;
                    }
                    if ($request->tu_ngay == null && $request->den_ngay == null) {
                        $KQ = KetquaThuchienCongkhaiNew::where('donvi_id', '=', $item[$j]->id)->whereBetween('ngay_bd_congkhai', [$startOfMonth, $endOfMonth]);
                        $tungay = $startOfMonth;
                        $denngay = $endOfMonth;
                    }
                    if ($KQ->count()) {
                        $item[$j]->dem = $KQ->count();
                        $item[$j]->check = 1;
                        $total = $total + 1;
                        $totalMuc = $totalMuc + $KQ->count();
                    }
                }
                $lsHuyen[$i]->tong_so_muc = $totalMuc;
                $lsHuyen[$i]->total = $total;
                $lsXa = $lsXa->concat($item);
            }
        }
        
        return Voyager::view($view, compact(
            'actions',
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortableColumns',
            'sortOrder',
            'searchNames',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'showCheckboxColumn',
            'lsKQ',
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'count',
            'dvh',
            'dvx',
            'tungay',
            'denngay',
            'lsPosts',
            'lsRes',
            'lsResPage',
            'lsHuyen',
            'lsXa',
            'baocaotonghop',
            'currentYear',
            'checkTH',
            'checkTHNSL'
        ));
    }
    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
        $listMuc = DmMucCk::orderBy('ma_muc', 'desc')->get();
        $donvi = auth()->user()->donvi_id;
        $ten_donvi = DonVi::find($donvi);
        return Voyager::view($view, compact('ten_donvi', 'donvi', 'listMuc', 'dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        $query = $model->query();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }

        $data = $query->findOrFail($id);

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();

        // Get fields with images to remove before updating and make a copy of $data
        $to_remove = $dataType->editRows->where('type', 'image')
            ->filter(function ($item, $key) use ($request) {
                return $request->hasFile($item->field);
            });
        $original_data = clone ($data);

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        // Delete Images
        $this->deleteBreadImages($original_data, $to_remove);

        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }
        $listMuc = DmMucCk::all();
        $donvi = auth()->user()->donvi_id;
        $ten_donvi = DonVi::find($donvi);
        return Voyager::view($view, compact('ten_donvi', 'donvi', 'listMuc', 'dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
    public function getNhom(Request $request)
    {
        $idNhom =  DmMucCk::find($request->idMuc);
        $data = DmNhomCk::find($idNhom->id_nhom);
        return  response()->json([
            'data' => $data
        ]);
    }
}
