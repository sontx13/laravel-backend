<?php

use App\Http\Controllers\Voyager\ChinhQuyenThanThienController;
use App\Http\Controllers\Voyager\DmMucCkController;
use App\Http\Controllers\Voyager\DmNhomCkController;
use App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiNewController;
use App\Http\Controllers\Voyager\NhanDanThamGiaYKienController;
use App\Http\Controllers\Voyager\TongHopSoLieuNewController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Khảo sát
    //Route::get('khao-sat', 'App\Http\Controllers\Voyager\KhaoSatController@Index')->name('voyager.khao-sat.index');

    Route::get('getDmTinhs', 'App\Http\Controllers\Voyager\DanhMucController@getDmTinhs')->name('voyager.danhsach.dmtinh');
    Route::get('getHuyens', 'App\Http\Controllers\Voyager\DanhMucController@getDmHuyens')->name('voyager.danhsach.dmhuyen');
    Route::get('getPhuongXas', 'App\Http\Controllers\Voyager\DanhMucController@getDmXaphuongs')->name('voyager.danhsach.dmphuongxa');
    Route::post('danhmuc-congkhai',  [DmMucCkController::class, 'index']);
    Route::post('danhmuc-nhom-congkhai',  [DmNhomCkController::class, 'index']);
    Route::post('ketqua-thuchien-congkhai-new',  [KetQuaThucHienCongKhaiNewController::class, 'index']);
    Route::post('ketqua-thuchien-congkhai-new/store',  [KetQuaThucHienCongKhaiNewController::class, 'store'])->name('voyager.ketqua-thuchien-congkhai-new.store');
    Route::post('getNhom',  [KetQuaThucHienCongKhaiNewController::class, 'getNhom']);
    // Route::get('getqr',  [KetQuaThucHienCongKhaiNewController::class, 'generateQRCode']);
    Route::get('thsolieu',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index')->name('voyager.solieu.index');

    Route::get('thsolieu_backup',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index_backup')->name('voyager.solieu.index_backup');
    Route::get('thsolieu02',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index02')->name('voyager.solieu.index02');
    Route::get('thsolieu03',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index03')->name('voyager.solieu.index03');
    Route::get('thsolieu04',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index04')->name('voyager.solieu.index04');
    Route::get('thsolieu05',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index05')->name('voyager.solieu.index05');
    Route::get('thsolieu06',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index06')->name('voyager.solieu.index06');
    Route::get('thsolieu07',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index07')->name('voyager.solieu.index07');
    Route::get('thsolieu08',  'App\Http\Controllers\Voyager\TongHopNhapSoLieuController@index08')->name('voyager.solieu.index08');

    // Xem nhập liệu báo cáo webview
    Route::get('thslks',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index')->name('voyager.solieukhaosat.index');
    Route::get('thpks01',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index01')->name('voyager.solieukhaosat.index01');
    Route::get('thpks02',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index02')->name('voyager.solieukhaosat.index02');
    Route::get('thpks03',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index03')->name('voyager.solieukhaosat.index03');
    Route::get('thpks04',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index04')->name('voyager.solieukhaosat.index04');
    Route::get('thpks05',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index05')->name('voyager.solieukhaosat.index05');
    Route::get('thpks06',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index06')->name('voyager.solieukhaosat.index06');
    Route::get('thpks07',  'App\Http\Controllers\Voyager\TongHopSoLieuKSController@index07')->name('voyager.solieukhaosat.index07');
    // Xem nhập liệu báo cáo
    Route::get('xem-nhaplieu-baocao', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index')->name('voyager.xem-nhaplieu-baocao.index')->middleware('auth');

    Route::get('xem-nhaplieu-baocao-backup', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index_backup')->name('voyager.xem-nhaplieu-baocao.index-backup')->middleware('auth');
    Route::get('xem-nhaplieu-baocao-2', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index2')->name('voyager.xem-nhaplieu-baocao.index2')->middleware('auth');
    Route::get('xem-nhaplieu-baocao-3', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index3')->name('voyager.xem-nhaplieu-baocao.index3')->middleware('auth');
    Route::get('xem-nhaplieu-baocao-4', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index4')->name('voyager.xem-nhaplieu-baocao.index4')->middleware('auth');
    Route::get('xem-nhaplieu-baocao-5', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index5')->name('voyager.xem-nhaplieu-baocao.index5')->middleware('auth');
    Route::get('xem-nhaplieu-baocao-6', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index6')->name('voyager.xem-nhaplieu-baocao.index6')->middleware('auth');
    Route::get('xem-nhaplieu-baocao-7', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index7')->name('voyager.xem-nhaplieu-baocao.index7')->middleware('auth');
    Route::get('xem-nhaplieu-baocao-8', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoController@Index8')->name('voyager.xem-nhaplieu-baocao.index8')->middleware('auth');
    // Nhập liệu báo cáo
    Route::get('nhaplieu-baocao', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index')->name('voyager.nhaplieu-baocao.index')->middleware('auth');

    Route::get('nhaplieu-baocao-backup', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index_backup')->name('voyager.nhaplieu-baocao.index-backup')->middleware('auth');
    Route::get('nhaplieu-baocao-2', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index2')->name('voyager.nhaplieu-baocao.index2')->middleware('auth');
    Route::get('nhaplieu-baocao-3', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index3')->name('voyager.nhaplieu-baocao.index3')->middleware('auth');
    Route::get('nhaplieu-baocao-4', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index4')->name('voyager.nhaplieu-baocao.index4')->middleware('auth');
    Route::get('nhaplieu-baocao-5', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index5')->name('voyager.nhaplieu-baocao.index5')->middleware('auth');
    Route::get('nhaplieu-baocao-6', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index6')->name('voyager.nhaplieu-baocao.index6')->middleware('auth');
    Route::get('nhaplieu-baocao-7', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index7')->name('voyager.nhaplieu-baocao.index7')->middleware('auth');
    Route::get('nhaplieu-baocao-8', 'App\Http\Controllers\Voyager\NhapLieuBaoCaoController@Index8')->name('voyager.nhaplieu-baocao.index8')->middleware('auth');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('chinhquyen-thanthien', [ChinhQuyenThanThienController::class, 'index'])->name('voyager.chinhquyen-thanthien.index');

        Route::group(['prefix' => 'chinhquyen-thanthien'], function () {
            Route::get('nhaplieu', [ChinhQuyenThanThienController::class, 'nhaplieu'])->name('voyager.chinhquyen-thanthien.nhaplieu');
            Route::get('baocaohuyen', [ChinhQuyenThanThienController::class, 'baoCaoHuyen'])->name('voyager.chinhquyen-thanthien.baocaohuyen');
            Route::get('baocaotinh', [ChinhQuyenThanThienController::class, 'baoCaoTinh'])->name('voyager.chinhquyen-thanthien.baocaotinh');

            //Ajax Zone
            Route::post('upload', [ChinhQuyenThanThienController::class, 'uploadFileDinhKem'])->name('voyager.chinhquyen-thanthien.upload');
            Route::post('load', [ChinhQuyenThanThienController::class, 'loadViewData'])->name('voyager.chinhquyen-thanthien.load');
            Route::post('delete', [ChinhQuyenThanThienController::class, 'xoaFileDinhKem'])->name('voyager.chinhquyen-thanthien.delete');
            Route::post('savediem', [ChinhQuyenThanThienController::class, 'saveDiem'])->name('voyager.chinhquyen-thanthien.savediem');
            Route::post('savediemmulti', [ChinhQuyenThanThienController::class, 'saveDiemMulti'])->name('voyager.chinhquyen-thanthien.savediemmulti');
        });
    });


    Route::get('ketqua_hotro_huongdan_motcua', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Index')->name('voyager.ketqua_hotro_huongdan_motcua.index')->middleware('auth');


    Route::get('pks_01', 'App\Http\Controllers\Voyager\PKS01Controller@Index01')->name('voyager.pks-01.index')->middleware('auth');
    Route::get('pks_02', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Index02')->name('voyager.pks-02.index')->middleware('auth');
    Route::get('pks_03', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Index03')->name('voyager.pks-03.index')->middleware('auth');
    Route::get('pks_04', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Index04')->name('voyager.pks-04.index')->middleware('auth');
    Route::get('pks_06', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Index06')->name('voyager.pks-06.index')->middleware('auth');
    Route::get('pks_07', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Index07')->name('voyager.pks-07.index')->middleware('auth');
    Route::get('pks_05', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Index05')->name('voyager.pks-05.index')->middleware('auth');

    Route::get('ketqua_hotro_huongdan_motcua-webview', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@Webview')->name('voyager.ketqua_hotro_huongdan_motcua-webview.index')->middleware('auth');
    //----------------Kết quả thực hiện công khai----------------
    // Partial kết quả thực hiện công khai
    Route::post('ketqua-thuchien-congkhai', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiController@KetQuaThucHienCongKhai');
    // Thêm mới kết quả thực hiện công khai
    Route::post('ketqua-thuchien-congkhai/them-moi', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiController@ThemMoiKetQuaThucHienCongKhai');
    // Show modal sửa
    Route::post('ketqua-thuchien-congkhai/sua-modal', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiController@ShowModalSuaKetQuaThucHienCongKhai');
    Route::post('ketqua-thuchien-congkhai/add-edit-modal', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiController@ShowAddEditKQTHCK')->name('voyager.kqthck.add-edit');
    // Action cập nhật kết quả thực hiện công khai
    Route::post('ketqua-thuchien-congkhai/cap-nhat', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiController@CapNhatKetQuaThucHienCongKhai');
    Route::post('ketqua-thuchien-congkhai/add-edit-submit', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiController@SubmitEditKetQuaThucHienCongKhai')->name('voyager.kqthck.add-edit-submit');
    // Action xóa kết quả thực hiện công khai
    Route::post('ketqua-thuchien-congkhai/xoa', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiController@XoaKetQuaThucHienCongKhai');
    //----------------End Kết quả thực hiện công khai-------------

    //----------------Nhân dân bàn và quyết định trực tiếp-----------------
    Route::post('nhandan-ban-va-quyetdinh-tructiep', 'App\Http\Controllers\Voyager\NhanDanBanVaQuyetDinhTrucTiepController@NhanDanBanVaQuyetDinhTrucTiep');
    // Thêm mới nhân dân bàn và quyết định trực tiếp
    Route::post('nhandan-ban-va-quyetdinh-tructiep/them-moi', 'App\Http\Controllers\Voyager\NhanDanBanVaQuyetDinhTrucTiepController@ThemMoiNhanDanBanVaQuyetDinhTrucTiep');
    // Show modal sửa
    Route::post('nhandan-ban-va-quyetdinh-tructiep/sua-modal', 'App\Http\Controllers\Voyager\NhanDanBanVaQuyetDinhTrucTiepController@ShowModalSuaNhanDanBanVaQuyetDinhTrucTiep');
    // Action cập nhật Nhân dân bàn và quyết định trực tiếp
    Route::post('nhandan-ban-va-quyetdinh-tructiep/cap-nhat', 'App\Http\Controllers\Voyager\NhanDanBanVaQuyetDinhTrucTiepController@CapNhatNhanDanBanVaQuyetDinhTrucTiep');
    // Action xóa Nhân dân bàn và quyết định trực tiếp
    Route::post('nhandan-ban-va-quyetdinh-tructiep/xoa', 'App\Http\Controllers\Voyager\NhanDanBanVaQuyetDinhTrucTiepController@XoaNhanDanBanVaQuyetDinhTrucTiep');
    //----------------End Nhân dân bàn và quyết định trực tiếp-------------

    //----------------Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định-----------------bỏ 24/08/2023
    //Route::post('nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh', 'App\Http\Controllers\Voyager\NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhController@NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh');
    // Thêm mới Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định
    //Route::post('nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/them-moi', 'App\Http\Controllers\Voyager\NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhController@ThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh');
    // Show modal sửa
    //Route::post('nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/sua-modal', 'App\Http\Controllers\Voyager\NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhController@ShowModalSuaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh');
    // Action cập nhật Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định
    //Route::post('nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/cap-nhat', 'App\Http\Controllers\Voyager\NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhController@CapNhatNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh');
    // Action xóa Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định
    //Route::post('nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/xoa', 'App\Http\Controllers\Voyager\NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhController@XoaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh');
    //----------------End Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định-------------

    //----------------Nhân dân tham gia ý kiến-----------------
    Route::post('nhandan-thamgia-ykien', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@NhanDanThamGiaYKien');
    Route::post('nhandan-thamgia-ykien/bao-cao', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@BaoCaoNhanDanThamGiaYKien');
    // Thêm mới
    Route::post('nhandan-thamgia-ykien/them-moi', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@ThemMoiNhanDanThamGiaYKien');
    Route::post('nhandan-thamgia-ykien/noidung', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@NoidungNhandanthamgiaykien');
    Route::post('nhandan-thamgia-ykien/upload', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@upload');
    // Show modal sửa
    Route::post('nhandan-thamgia-ykien/sua-modal', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@ShowModalSuaNhanDanThamGiaYKien');
    // Action cập nhật
    Route::post('nhandan-thamgia-ykien/cap-nhat', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@CapNhatNhanDanThamGiaYKien');
    // Action xóa
    Route::post('nhandan-thamgia-ykien/xoa', 'App\Http\Controllers\Voyager\NhanDanThamGiaYKienController@XoaNhanDanThamGiaYKien');
    //----------------End Nhân dân tham gia ý kiến-------------

    //----------------Kết quả huy động vốn xây dựng hạ tầng cơ sở------------------------------bỏ 24/08/2023
    //Route::post('ketqua-huydongvon-xaydung-hatangcoso', 'App\Http\Controllers\Voyager\KetQuaHuyDongVonXayDungHaTangCoSoController@KetQuaHuyDongVonXayDungHaTangCoSo');
    // Thêm mới
    //Route::post('ketqua-huydongvon-xaydung-hatangcoso/them-moi', 'App\Http\Controllers\Voyager\KetQuaHuyDongVonXayDungHaTangCoSoController@ThemMoiKetQuaHuyDongVonXayDungHaTangCoSo');
    // Show modal sửa
    //Route::post('ketqua-huydongvon-xaydung-hatangcoso/sua-modal', 'App\Http\Controllers\Voyager\KetQuaHuyDongVonXayDungHaTangCoSoController@ShowModalSuaKetQuaHuyDongVonXayDungHaTangCoSo');
    // Action cập nhật
    //Route::post('ketqua-huydongvon-xaydung-hatangcoso/cap-nhat', 'App\Http\Controllers\Voyager\KetQuaHuyDongVonXayDungHaTangCoSoController@CapNhatKetQuaHuyDongVonXayDungHaTangCoSo');
    // Action xóa
    //Route::post('ketqua-huydongvon-xaydung-hatangcoso/xoa', 'App\Http\Controllers\Voyager\KetQuaHuyDongVonXayDungHaTangCoSoController@XoaKetQuaHuyDongVonXayDungHaTangCoSo');
    //----------------End Kết quả huy động vốn xây dựng hạ tầng cơ sở--------------

    //----------------Nhân dân kiểm tra, giám sát-----------------
    Route::post('nhandan-kiemtra-giamsat', 'App\Http\Controllers\Voyager\NhanDanKiemTraGiamSatController@NhanDanKiemTraGiamSat');
    // Thêm mới
    Route::post('nhandan-kiemtra-giamsat/them-moi', 'App\Http\Controllers\Voyager\NhanDanKiemTraGiamSatController@ThemMoiNhanDanKiemTraGiamSat');
    // Show modal sửa
    Route::post('nhandan-kiemtra-giamsat/sua-modal', 'App\Http\Controllers\Voyager\NhanDanKiemTraGiamSatController@ShowModalSuaNhanDanKiemTraGiamSat');
    // Action cập nhật
    Route::post('nhandan-kiemtra-giamsat/cap-nhat', 'App\Http\Controllers\Voyager\NhanDanKiemTraGiamSatController@CapNhatNhanDanKiemTraGiamSat');
    // Action xóa
    Route::post('nhandan-kiemtra-giamsat/xoa', 'App\Http\Controllers\Voyager\NhanDanKiemTraGiamSatController@XoaNhanDanKiemTraGiamSat');
    //----------------End Nhân dân kiểm tra, giám sát--------------

    //----------------Kết quả hoạt động của ban thanh tra nhân dân-----------------
    Route::post('ketqua-hoatdong-cuabanthanhtra-nhandan', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanThanhTraNhanDanController@KetQuaHoatDongCuaBanThanhTraNhanDan');
    // Thêm mới
    Route::post('ketqua-hoatdong-cuabanthanhtra-nhandan/them-moi', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanThanhTraNhanDanController@ThemMoiKetQuaHoatDongCuaBanThanhTraNhanDan');
    // Show modal sửa
    Route::post('ketqua-hoatdong-cuabanthanhtra-nhandan/sua-modal', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanThanhTraNhanDanController@ShowModalSuaKetQuaHoatDongCuaBanThanhTraNhanDan');
    // Action cập nhật
    Route::post('ketqua-hoatdong-cuabanthanhtra-nhandan/cap-nhat', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanThanhTraNhanDanController@CapNhatKetQuaHoatDongCuaBanThanhTraNhanDan');
    // Action xóa
    Route::post('ketqua-hoatdong-cuabanthanhtra-nhandan/xoa', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanThanhTraNhanDanController@XoaKetQuaHoatDongCuaBanThanhTraNhanDan');
    //----------------End Kết quả hoạt động của ban thanh tra nhân dân--------------

    //----------------Kết quả hoạt động của giám sát đầu tư của cộng đồng-----------------
    Route::post('ketqua-hoatdong-cuabangiamsatdautu-cuacongdong', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongController@KetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong');
    // Thêm mới
    Route::post('ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/them-moi', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongController@ThemMoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong');
    // Show modal sửa
    Route::post('ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/sua-modal', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongController@ShowModalSuaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong');
    // Action cập nhật
    Route::post('ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/cap-nhat', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongController@CapNhatKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong');
    // Action xóa
    Route::post('ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/xoa', 'App\Http\Controllers\Voyager\KetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongController@XoaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong');
    //----------------End Kết quả hoạt động của ban giám sát đầu tư của cộng đồng--------------

    //----------------Đơn thư khiếu nại tố cáo-----------------
    Route::post('donthu-khieunai-tocao', 'App\Http\Controllers\Voyager\DonThuKhieuNaiToCaoController@DonThuKhieuNaiToCao');
    // Thêm mới
    Route::post('donthu-khieunai-tocao/them-moi', 'App\Http\Controllers\Voyager\DonThuKhieuNaiToCaoController@ThemMoiDonThuKhieuNaiToCao');
    // Show modal sửa
    Route::post('donthu-khieunai-tocao/sua-modal', 'App\Http\Controllers\Voyager\DonThuKhieuNaiToCaoController@ShowModalSuaDonThuKhieuNaiToCao');
    // Action cập nhật
    Route::post('donthu-khieunai-tocao/cap-nhat', 'App\Http\Controllers\Voyager\DonThuKhieuNaiToCaoController@CapNhatDonThuKhieuNaiToCao');
    // Action xóa
    Route::post('donthu-khieunai-tocao/xoa', 'App\Http\Controllers\Voyager\DonThuKhieuNaiToCaoController@XoaDonThuKhieuNaiToCao');
    //----------------End Đơn thư khiếu nại tố cáo--------------

    //----------------Kết quả tổ chức họp thôn, bản, tổ dân phố-----------------
    Route::post('ketqua-tochuchop-thonban-todanpho', 'App\Http\Controllers\Voyager\KetQuaToChucHopThonBanToDanPhoController@KetQuaToChucHopThonBanToDanPho');
    // Thêm mới
    Route::post('ketqua-tochuchop-thonban-todanpho/them-moi', 'App\Http\Controllers\Voyager\KetQuaToChucHopThonBanToDanPhoController@ThemMoiKetQuaToChucHopThonBanToDanPho');
    // Show modal sửa
    Route::post('ketqua-tochuchop-thonban-todanpho/sua-modal', 'App\Http\Controllers\Voyager\KetQuaToChucHopThonBanToDanPhoController@ShowModalSuaKetQuaToChucHopThonBanToDanPho');
    // Action cập nhật
    Route::post('ketqua-tochuchop-thonban-todanpho/cap-nhat', 'App\Http\Controllers\Voyager\KetQuaToChucHopThonBanToDanPhoController@CapNhatKetQuaToChucHopThonBanToDanPho');
    // Action xóa
    Route::post('ketqua-tochuchop-thonban-todanpho/xoa', 'App\Http\Controllers\Voyager\KetQuaToChucHopThonBanToDanPhoController@XoaKetQuaToChucHopThonBanToDanPho');
    //----------------End Kết quả tổ chức họp thôn, bản, tổ dân phố--------------
    //----------------Kết quả hỗ trợ hướng dẫn một cửa-----------------
    Route::post('ketqua-hotro-huongdan-motcua', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@KetQuaHoTroHuongDanMotCua');
    // Thêm mới
    Route::post('ketqua-hotro-huongdan-motcua/them-moi', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@ThemMoiKetQuaHoTroHuongDanMotCua');
    // Show modal sửa
    Route::post('ketqua-hotro-huongdan-motcua/sua-modal', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@ShowModalSuaKetQuaHoTroHuongDanMotCua');
    // Action cập nhật
    Route::post('ketqua-hotro-huongdan-motcua/cap-nhat', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@CapNhatKetQuaHoTroHuongDanMotCua');
    // Action xóa
    Route::post('ketqua-hotro-huongdan-motcua/xoa', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@XoaKetQuaHoTroHuongDanMotCua');

    Route::post('ketqua-hotro-huongdan-motcua-06', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@KetQuaHoTroHuongDanMotCua06');
    // Thêm mới
    Route::post('ketqua-hotro-huongdan-motcua-06/them-moi', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@ThemMoiKetQuaHoTroHuongDanMotCua06');
    // Show modal sửa
    Route::post('ketqua-hotro-huongdan-motcua-06/sua-modal', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@ShowModalSuaKetQuaHoTroHuongDanMotCua06');
    // Action cập nhật
    Route::post('ketqua-hotro-huongdan-motcua-06/cap-nhat', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@CapNhatKetQuaHoTroHuongDanMotCua06');
    // Action xóa
    Route::post('ketqua-hotro-huongdan-motcua-06/xoa', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@XoaKetQuaHoTroHuongDanMotCua06');

    Route::post('ketqua-hotro-huongdan-motcua-webview', 'App\Http\Controllers\Voyager\KetQuaHoTroHuongDanMotCuaController@KetQuaHoTroHuongDanMotCuaWebview');
    //----------------End Kết quả tổ chức họp thôn, bản, tổ dân phố--------------

    Route::post('pks-01', 'App\Http\Controllers\Voyager\PKS01Controller@KetQuaHoTroHuongDanMotCua');
    // Thêm mới
    Route::post('pks-01/them-moi', 'App\Http\Controllers\Voyager\PKS01Controller@ThemMoiKetQuaHoTroHuongDanMotCua');
    // Show modal sửa
    Route::post('pks-01/sua-modal', 'App\Http\Controllers\Voyager\PKS01Controller@ShowModalSuaKetQuaHoTroHuongDanMotCua');
    // Action cập nhật
    Route::post('pks-01/cap-nhat', 'App\Http\Controllers\Voyager\PKS01Controller@CapNhatKetQuaHoTroHuongDanMotCua');
    // Action xóa
    Route::post('pks-01/xoa', 'App\Http\Controllers\Voyager\PKS01Controller@XoaKetQuaHoTroHuongDanMotCua');

    Route::post('pks-01-webview', 'App\Http\Controllers\Voyager\PKS01Controller@KetQuaHoTroHuongDanMotCuaWebview');

    Route::post('pks-02', 'App\Http\Controllers\Voyager\PKS02Controller@KetQuaHoTroHuongDanMotCua');
    // Thêm mới
    Route::post('pks-02/them-moi', 'App\Http\Controllers\Voyager\PKS02Controller@ThemMoiKetQuaHoTroHuongDanMotCua');
    // Show modal sửa
    Route::post('pks-02/sua-modal', 'App\Http\Controllers\Voyager\PKS02Controller@ShowModalSuaKetQuaHoTroHuongDanMotCua');
    // Action cập nhật
    Route::post('pks-02/cap-nhat', 'App\Http\Controllers\Voyager\PKS02Controller@CapNhatKetQuaHoTroHuongDanMotCua');
    // Action xóa
    Route::post('pks-02/xoa', 'App\Http\Controllers\Voyager\PKS02Controller@XoaKetQuaHoTroHuongDanMotCua');

    Route::post('pks-02-webview', 'App\Http\Controllers\Voyager\PKS02Controller@KetQuaHoTroHuongDanMotCuaWebview');

    Route::post('pks-03', 'App\Http\Controllers\Voyager\PKS03Controller@KetQuaHoTroHuongDanMotCua');
    // Thêm mới
    Route::post('pks-03/them-moi', 'App\Http\Controllers\Voyager\PKS03Controller@ThemMoiKetQuaHoTroHuongDanMotCua');
    // Show modal sửa
    Route::post('pks-03/sua-modal', 'App\Http\Controllers\Voyager\PKS03Controller@ShowModalSuaKetQuaHoTroHuongDanMotCua');
    // Action cập nhật
    Route::post('pks-03/cap-nhat', 'App\Http\Controllers\Voyager\PKS03Controller@CapNhatKetQuaHoTroHuongDanMotCua');
    // Action xóa
    Route::post('pks-03/xoa', 'App\Http\Controllers\Voyager\PKS03Controller@XoaKetQuaHoTroHuongDanMotCua');

    Route::post('pks-03-webview', 'App\Http\Controllers\Voyager\PKS03Controller@KetQuaHoTroHuongDanMotCuaWebview');

    Route::post('pks-04', 'App\Http\Controllers\Voyager\PKS04Controller@KetQuaHoTroHuongDanMotCua');
    // Thêm mới
    Route::post('pks-04/them-moi', 'App\Http\Controllers\Voyager\PKS04Controller@ThemMoiKetQuaHoTroHuongDanMotCua');
    // Show modal sửa
    Route::post('pks-04/sua-modal', 'App\Http\Controllers\Voyager\PKS04Controller@ShowModalSuaKetQuaHoTroHuongDanMotCua');
    // Action cập nhật
    Route::post('pks-04/cap-nhat', 'App\Http\Controllers\Voyager\PKS04Controller@CapNhatKetQuaHoTroHuongDanMotCua');
    // Action xóa
    Route::post('pks-04/xoa', 'App\Http\Controllers\Voyager\PKS04Controller@XoaKetQuaHoTroHuongDanMotCua');

    Route::post('pks-04-webview', 'App\Http\Controllers\Voyager\PKS04Controller@KetQuaHoTroHuongDanMotCuaWebview');

    Route::post('pks-07', 'App\Http\Controllers\Voyager\PKS07Controller@KetQuaHoTroHuongDanMotCua');
    // Thêm mới
    Route::post('pks-07/them-moi', 'App\Http\Controllers\Voyager\PKS07Controller@ThemMoiKetQuaHoTroHuongDanMotCua');
    // Show modal sửa
    Route::post('pks-07/sua-modal', 'App\Http\Controllers\Voyager\PKS07Controller@ShowModalSuaKetQuaHoTroHuongDanMotCua');
    // Action cập nhật
    Route::post('pks-07/cap-nhat', 'App\Http\Controllers\Voyager\PKS07Controller@CapNhatKetQuaHoTroHuongDanMotCua');
    // Action xóa
    Route::post('pks-07/xoa', 'App\Http\Controllers\Voyager\PKS07Controller@XoaKetQuaHoTroHuongDanMotCua');

    Route::post('pks-07-webview', 'App\Http\Controllers\Voyager\PKS07Controller@KetQuaHoTroHuongDanMotCuaWebview');
    //----------------End Nhập liệu báo cáo
    //----------------Quản trị PAKN----------------------------------------------------------------------------
    Route::get('tiep-nhan-pakn', 'App\Http\Controllers\Voyager\QuanTriPAKNController@Index')->name('voyager.quan-tri-pakn.index');
    Route::get('tiep-nhan-pakn2', 'App\Http\Controllers\Voyager\QuanTriPAKNController@Index')->name('voyager.tiep-nhan-pakn.index');
    Route::post('quan-tri-pakn/danh-sach', 'App\Http\Controllers\Voyager\QuanTriPAKNController@PartialViewDsPAKN');
    Route::get('quan-tri-pakn/sua-modal/{id}', 'App\Http\Controllers\Voyager\QuanTriPAKNController@ShowModalSuaPAKN')->name('voyager.quan-tri-pakn.edit');
    Route::post('quan-tri-pakn/cap-nhap', 'App\Http\Controllers\Voyager\QuanTriPAKNController@CapNhatPAKN');
    //----------------End Quản trị PAKN----------------------------------------------------------------------------
    //----------------Quản trị thông báo-----------------------------------------
    //----------------Kết quả tổ chức họp thôn, bản, tổ dân phố-----------------
    Route::get('thong-bao', 'App\Http\Controllers\Voyager\QuanTriThongBaoController@Index')->name('voyager.thong-bao.index');;
    //----------------Partial view danh sách thông báo-----------------
    Route::post('thong-bao/danh-sach', 'App\Http\Controllers\Voyager\QuanTriThongBaoController@PartialViewDsThongBaos');
    // Thêm mới
    Route::post('thong-bao/them-moi', 'App\Http\Controllers\Voyager\QuanTriThongBaoController@ThemMoiThongBao');
    // Show modal sửa
    Route::post('thong-bao/sua-modal', 'App\Http\Controllers\Voyager\QuanTriThongBaoController@ShowModalSuaThongBao');
    // Action cập nhật
    Route::post('thong-bao/cap-nhat', 'App\Http\Controllers\Voyager\QuanTriThongBaoController@CapNhatThongBao');
    // Action xóa
    Route::post('thong-bao/xoa', 'App\Http\Controllers\Voyager\QuanTriThongBaoController@XoaThongBao');
    // Action xóa
    Route::post('thong-bao/gui', 'App\Http\Controllers\Voyager\QuanTriThongBaoController@GuiThongBao');
    //----------------End quản trị thông báo-------------------------------------

    // Quản lý user
    Route::match(['get', 'post'], 'users', 'App\Http\Controllers\Voyager\UserController@Index')->name('voyager.users.index');
    // Partial view danh sách user
    Route::any('user/danh-sach', 'App\Http\Controllers\Voyager\UserController@PartialViewDsUser');
    // Thêm mới user
    Route::post('user/them-moi', 'App\Http\Controllers\Voyager\UserController@CreateUser');
    // Sửa user
    Route::post('user/sua-modal', 'App\Http\Controllers\Voyager\UserController@PartialViewEditUserModal');
    // Cập nhật user
    Route::post('user/cap-nhat', 'App\Http\Controllers\Voyager\UserController@UpdateUser');
    // Chuyển trạng thái người dùng
    Route::post('user/chuyen-trangthai', 'App\Http\Controllers\Voyager\UserController@UpdateTrangThaiUser');
    // Xóa người dùng
    Route::post('user/xoa', 'App\Http\Controllers\Voyager\UserController@DeleteUser');
    // Reset password
    Route::post('user/resetpassword', 'App\Http\Controllers\Voyager\UserController@ResetPassword');

    //----------------Quản trị khảo sát-----------------------------------------
    Route::get('khao-sat', 'App\Http\Controllers\Voyager\QuanTriKhaoSatController@Index')->name('voyager.quantri-khao-sat.index');;
    //----------------Partial view danh sách khảo sát-----------------
    Route::post('khao-sat/danh-sach', 'App\Http\Controllers\Voyager\QuanTriKhaoSatController@PartialViewDsKhaoSats');

    // Show modal sửa
    Route::post('khao-sat/sua-modal', 'App\Http\Controllers\Voyager\QuanTriKhaoSatController@ShowModalSuaKhaoSat');
    // Action cập nhật
    Route::post('khao-sat/cap-nhat', 'App\Http\Controllers\Voyager\QuanTriKhaoSatController@CapNhatKhaoSat');
    //----------------End quản trị khảo sát-------------------------------------

    //----------------Báo cáo tổng hợp khảo sát-----------------------------------------
    Route::get('baocao-tonghop-khaosat', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@Index')->name('voyager.baocao-tonghop-khaosat.index');
    Route::post('baocao-tonghop-khaosat/data-chart', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataChart');
    Route::post('baocao-tonghop-khaosat/tong-hop-data-chart', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetSoLuotTonghopDataChart');
    Route::post('baocao-tonghop-khaosat/soluot-khaosat-chitiet', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataSoLuotKhaoSatChitiet');
    Route::post('baocao-tonghop-khaosat/soluot-khaosat', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataSoLuotKhaoSat');
    Route::post('baocao-tonghop-khaosat/traloi-khaosat', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataTraloiKhaoSat');
    Route::post('baocao-tonghop-khaosat/traloi-khaosat-huyen', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataTraloiKhaoSatHuyen');
    Route::post('baocao-tonghop-khaosat/traloi-khaosat-xa', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataTraloiKhaoSatXa');
    Route::post('baocao-tonghop-khaosat/dropdown-traloi', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataDropdownTraloi');
    Route::post('baocao-tonghop-khaosat/donvi-khaosat', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@GetDataDonvi');

    Route::get('baocao-ks-tonghop', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@Baocaokstonghop')->name('voyager.khao-sat.baocao-ks-tonghop-browser');
    Route::get('baocao-ks-chitiet', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@Baocaokschitiet')->name('voyager.khao-sat.baocao-ks-chitiet-browser');

    // Action upload files
    Route::post('file/upload', 'App\Http\Controllers\Voyager\FileController@UploadFileDinhKem')->name('voyager.file.upload');
    // Route::group([
    //     'middleware' => 'auth.token'
    // ], function() {
    //     Route::get('baocao-ks-tonghop', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@Baocaokstonghop')->name('voyager.khao-sat.baocao-ks-tonghop-browser');
    // });

    // Route::group([
    //     'middleware' => 'auth.token'
    // ], function() {
    //     Route::get('baocao-ks-chitiet', 'App\Http\Controllers\Voyager\BaoCaoTongHopKhaoSatController@Baocaokschitiet')->name('voyager.khao-sat.baocao-ks-chitiet-browser');
    // });

});

Route::group(['prefix' => 'pakn'], function () {

    Route::group([
        'middleware' => 'auth.token.login'
    ], function () {
        Route::get('khao-sat', 'App\Http\Controllers\Voyager\KhaoSatController@Index_KhaoSat')->name('voyager.khao-sat.index');
    });

    Route::post('khao-sat/don-vi', 'App\Http\Controllers\Voyager\KhaoSatController@GetDonvi');
    Route::post('gui-khao-sat', 'App\Http\Controllers\Voyager\KhaoSatController@GuiKhaoSat')->name('voyager.khao-sat.guikhaosat');
    Route::post('gui-otp', 'App\Http\Controllers\Voyager\KhaoSatController@GuiOTP')->name('voyager.khao-sat.guiotp');
    Route::post('check-otp', 'App\Http\Controllers\Voyager\KhaoSatController@CheckOTP')->name('voyager.khao-sat.checkotp');

    Route::get('tiep-nhan-pakn', 'App\Http\Controllers\Voyager\KhaoSatController@Index')->name('voyager.khao-sat.pakn-index');
    Route::get('danh-sach-pakn', 'App\Http\Controllers\Voyager\KhaoSatController@paknList')->name('voyager.khao-sat.pakn-browser');

    Route::get('pakn-chitiet/{id}', 'App\Http\Controllers\Voyager\KhaoSatController@paknDetails')->name('voyager.khao-sat.pakn-chitiet');
    Route::group([
        'middleware' => 'auth.token'
    ], function () {
        Route::get('xem-khao-sat-webview', 'App\Http\Controllers\Voyager\KhaoSatController@PartialViewDsKhaoSat')->name('voyager.xem-khao-sat-webview.index');
    });


    Route::get('xem-khao-sat-webview/chi-tiet/{khaosatid}', 'App\Http\Controllers\Voyager\KhaoSatController@DetailSurvey')->name('voyager.xem-khao-sat-webview-chitiet.index');
    Route::post('xem-khao-sat-webview/chi-tiet/filter1', 'App\Http\Controllers\Voyager\KhaoSatController@FilterCauHoi')->name('voyager.xem-khao-sat-webview-chitiet.index1');
    Route::post('xem-khao-sat-webview/chi-tiet/filter2', 'App\Http\Controllers\Voyager\KhaoSatController@FilterLinhVuc')->name('voyager.xem-khao-sat-webview-chitiet.index2');
    Route::match(['get', 'post'], 'tiepnhan', 'App\Http\Controllers\Voyager\KhaoSatController@TiepNhan')->name('pakn.tiepnhan.nguoidan');
});

Route::group(['prefix' => 'view'], function () {
    Route::group([
        'middleware' => 'auth.token'
    ], function () {
        Route::get('xem-nhaplieu-baocao-webview', 'App\Http\Controllers\Voyager\XemNhapLieuBaoCaoWebViewController@Index')->name('voyager.xem-nhaplieu-baocao-webview.index');
        Route::get('xemlai-khaosat', 'App\Http\Controllers\Voyager\KhaoSatController@XemLaiKhaoSat');
    });

    Route::get('congkhai-webview', 'App\Http\Controllers\Voyager\KetQuaThucHienCongKhaiNewController@Index_CongKhai')->name('voyager.ketqua-thuchien-congkhai-new.index-congkhai');

    Route::post('xem-ketqua-thuchien-congkhai-webview', 'App\Http\Controllers\Voyager\XemKetQuaThucHienCongKhaiController@KetQuaThucHienCongKhai');
    Route::post('xem-nhandan-ban-va-quyetdinh-tructiep-webview', 'App\Http\Controllers\Voyager\XemNhanDanBanVaQuyetDinhTrucTiepController@NhanDanBanVaQuyetDinhTrucTiep');
    Route::post('xem-nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh-webview', 'App\Http\Controllers\Voyager\XemNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhController@NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh');
    Route::post('xem-nhandan-thamgia-ykien-webview', 'App\Http\Controllers\Voyager\XemNhanDanThamGiaYKienController@NhanDanThamGiaYKien');
    Route::post('xem-ketqua-huydongvon-xaydung-hatangcoso-webview', 'App\Http\Controllers\Voyager\XemKetQuaHuyDongVonXayDungHaTangCoSoController@KetQuaHuyDongVonXayDungHaTangCoSo');
    Route::post('xem-nhandan-kiemtra-giamsat-webview', 'App\Http\Controllers\Voyager\XemNhanDanKiemTraGiamSatController@NhanDanKiemTraGiamSat');
    Route::post('xem-ketqua-hoatdong-cuabanthanhtra-nhandan-webview', 'App\Http\Controllers\Voyager\XemKetQuaHoatDongCuaBanThanhTraNhanDanController@KetQuaHoatDongCuaBanThanhTraNhanDan');
    Route::post('xem-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong-webview', 'App\Http\Controllers\Voyager\XemKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongController@KetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong');
    Route::post('xem-donthu-khieunai-tocao-webview', 'App\Http\Controllers\Voyager\XemDonThuKhieuNaiToCaoController@DonThuKhieuNaiToCao');
    Route::post('xem-ketqua-tochuchop-thonban-todanpho-webview', 'App\Http\Controllers\Voyager\XemKetQuaToChucHopThonBanToDanPhoController@KetQuaToChucHopThonBanToDanPho');
});
Route::get('login', ['uses' => 'App\Http\Controllers\Voyager\VoyagerAuthController@login', 'as' => 'login']);
