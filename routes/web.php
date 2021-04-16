<?php

use App\Alur;
use App\Gelombang;
use App\Info;
use App\Prodi;
use App\Slider;

use App\Http\Controllers\admin\EmailController;
use App\Http\Controllers\admin\AgentController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $gelombang = Gelombang::where('aktif', 'Y')->first();

    $slider = Slider::where('aktif', 'Y')->latest()->limit(5)->get();
    $info = Info::latest()->limit(10)->get();
    return view(
        'welcome',
        compact('slider', 'gelombang', 'info')
    );
});

Route::get('/program_studi', function () {
    $title = 'Program Studi';
    $gelombang = Gelombang::where('aktif', 'Y')->first();
    $prodi = Prodi::orderBy('kode')->get();
    return view(
        'program_studi',
        compact('title', 'gelombang', 'prodi')
    );
});

Route::get('/gelombang', function () {
    $title = 'Gelombang Pendaftaran';
    $gelombang = Gelombang::where('aktif', 'Y')->first();
    $list_gelombang = Gelombang::where('mst_th_akademik_id', $gelombang->mst_th_akademik_id)->latest()->get();
    return view(
        'gelombang',
        compact('title', 'gelombang', 'list_gelombang')
    );
});

Route::get('/alur_pendaftaran', function () {
    $title = 'Alur Pendaftaran';
    $gelombang = Gelombang::where('aktif', 'Y')->first();
    $alur = Alur::where('aktif', 'Y')->first();
    return view(
        'alur',
        compact('title', 'gelombang', 'alur')
    );
});

Route::get('/agent', function () {
    $title = 'Agent yoUCB';
    $gelombang = Gelombang::where('aktif', 'Y')->first();
    $alur = Alur::where('aktif', 'Y')->first();
    return view(
        'agent',
        compact('title', 'gelombang', 'alur')
    );
});

Route::get('/agent_lembaga', function () {
    $title = 'Daftar Lembaga Sebagai Agent yoUCB';
    return view('agent.lembaga');
});

Route::get('/agent_individu', function () {
    $title = 'Daftar Individu Sebagai Agent yoUCB';
    return view('agent.individu');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('admin/pengguna', 'admin\PenggunaController');

    Route::resource('admin/imageslider', 'admin\ImageSliderController');

    Route::resource('admin/gelombang', 'admin\GelombangController');

    Route::resource('admin/alur', 'admin\AlurController');

    Route::resource('admin/email', 'admin\EmailController');
    // Route::post('admin/email', 'EmailController@test')->name('email.test');

    Route::resource('admin/info', 'admin\InfoController');

    Route::resource('admin/prodi', 'admin\ProdiController');

    Route::resource('admin/profile', 'admin\ProfileController');

    //Transaksi
    Route::resource('admin/daftar', 'admin\DaftarController');
    Route::resource('admin/validasi', 'admin\ValidasiController');

    Route::post('admin/formulir/simpanSyaratValid', 'admin\FormulirController@simpanSyaratValid')->name('admin.formulir.simpanSyaratValid');
    Route::get('admin/formulir/{id}/listGelombang', 'admin\FormulirController@listGelombang')->name('admin.formulir.listGelombang');
    Route::resource('admin/formulir', 'admin\FormulirController');
    Route::resource('admin/lulus', 'admin\LulusController');

    Route::resource('admin/lapdaftar', 'admin\LapDaftarController');
    Route::resource('admin/lapformulir', 'admin\LapFormulirController');
    Route::resource('admin/laplulus', 'admin\LapLulusController');


    //User
    Route::resource('user/formulir', 'user\FormulirController');

    Route::resource('user/uploadbukti', 'user\UploadBuktiController');
});
