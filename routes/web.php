<?php

use App\Alur;
use App\Gelombang;
use App\Info;
use App\Prodi;
use App\Slider;
use App\Provinsi;
use App\Kabupaten;

use App\Http\Controllers\IndonesiaController;
use App\Http\Controllers\admin\AgentController;
use GuzzleHttp\Psr7\Request;
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
    $prov = Provinsi::pluck('name', 'id');
    $title = 'Daftar Lembaga Sebagai Agent yoUCB';
    return view('agent.lembaga', compact('title', 'prov'));
});

Route::get('/agent_individu', function () {
    $prov = Provinsi::pluck('name', 'id');
    $title = 'Daftar Individu Sebagai Agent yoUCB';
    return view('agent.individu', compact('title', 'prov'));
});
Route::get('/agent_individu/success', function () {
    $title = 'Sukses Daftar Individu Sebagai Agent yoUCB';
    return view('agent.success', compact('title'));
});

Route::post('get_kab', [IndonesiaController::class, 'get_kab'])->name('get_kab');
Route::post('get_kec', [IndonesiaController::class, 'get_kec'])->name('get_kec');
Route::post('get_kel', [IndonesiaController::class, 'get_kel'])->name('get_kel');

Route::post('lembagaSave', [AgentController::class, 'lembaga_store'])->name('lembagaSave');
Route::post('individuSave', [AgentController::class, 'individu_store'])->name('individuSave');
Route::post('get_agent', [AgentController::class, 'get_agent'])->name('get_agent');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('admin/pengguna', 'admin\PenggunaController');

    Route::resource('admin/imageslider', 'admin\ImageSliderController');

    Route::resource('admin/gelombang', 'admin\GelombangController');

    Route::resource('admin/alur', 'admin\AlurController');

    Route::resource('admin/agent_youcb', 'admin\AgentYoucbController');
    Route::resource('admin/agent_lembaga', 'admin\AgentLembagaController');
    Route::resource('admin/agent_individu', 'admin\AgentIndividuController');

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
