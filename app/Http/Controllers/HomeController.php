<?php

namespace App\Http\Controllers;

use Auth;
use App\Kota;
use App\Daftar;
use App\DokumenPersyaratan;
use App\Formulir;
use App\Gelombang;
use App\JenisKelamin;
use App\Kelas;
use App\Lulus;
use App\Prodi;
use App\Validasi;
use App\Agent;
use App\Provinsi;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $aktif = Gelombang::where('aktif', 'Y')->first();
        $level = Auth::user()->level;
        if ($level == 1) {

            $title = 'Home';
            $jml_daftar = Daftar::where('th_akademik_id', $aktif->mst_th_akademik_id)->count();
            $jml_validasi = Validasi::where('th_akademik_id', $aktif->mst_th_akademik_id)->count();
            $jml_formulir = Formulir::where('th_akademik_id', $aktif->mst_th_akademik_id)->count();
            return view('admin.home', compact('title', 'jml_daftar', 'jml_validasi', 'jml_formulir'));
        } else {
            $user_id = Auth::user()->id;


            $gelombang = Gelombang::where('aktif', 'Y')->first();
            $daftar = Daftar::where('id', $user_id)->first();
            $list_kota = Kota::orderBy('province_id')->get();
            $list_prodi = Prodi::orderBy('kode')->get();
            $list_kelas = Kelas::where('table', 'Kelas')->get();
            $list_jk = JenisKelamin::where('table', 'JenisKelamin')->get();
            $prov = Provinsi::pluck('name', 'id');

            $validasi = Validasi::where('user_id', $user_id)
                ->where('status', 'Baru')
                ->first();
            if ($validasi) {
                $title = 'Menunggu Validasi dari Panitia';
                return view('user.validasi', compact('title', 'gelombang', 'daftar', 'list_kota', 'list_prodi', 'list_kelas', 'list_jk', 'validasi'));
            }

            $validasi = Validasi::where('user_id', $user_id)
                ->where('status', 'Tolak')
                ->first();
            if ($validasi) {
                $title = 'Bukti Pembayaran di Tolak silahkan Upload Bukti Pembayaran kembali';
                return view('user.upload_bukti', compact('title', 'gelombang', 'daftar', 'list_kota', 'list_prodi', 'list_kelas', 'list_jk'));
            }

            $validasi = Validasi::where('user_id', $user_id)
                ->where('status', 'Valid')
                ->first();
            if ($validasi) {
                $formulir = Formulir::where('user_id', $user_id)->first();
                $agent = Agent::orderBy('id')->get();
                // dd($agent);
                if ($formulir) {
                    $persyaratan = DokumenPersyaratan::where('pmb_formulir_id', $formulir->id)->first();
                    if (!$persyaratan) {
                        $title = 'Upload Dokumen Persyaratan';
                        return view('user.upload_dokumen', compact('title', 'formulir', 'persyaratan'));
                    }

                    $persyaratan = DokumenPersyaratan::where('pmb_formulir_id', $formulir->id)->get();
                    foreach ($persyaratan as $item) {
                        if ($item->valid == 'N') {
                            $title = 'Menunggu Validasi Dokumen dari Panitia. Silahkan lengkapi Upload Dokumen Persyaratan';
                            return view('user.upload_dokumen', compact('title', 'formulir', 'persyaratan'));
                        }
                    }

                    $lulus = Lulus::where('pmb_formulir_id', $formulir->id)->first();
                    if ($lulus) {
                        $title = 'Informasi Kelulusan';
                        return view('user.info_lulus', compact('title', 'lulus'));
                    } else {
                        $title = 'Formulir Biodata Peserta';
                        return view('user.formulir', compact('title', 'formulir'));
                    }
                } else {
                    $title = 'Formulir Isian';
                    return view('user.home', compact('title', 'gelombang', 'daftar', 'list_kota', 'prov', 'list_prodi', 'agent', 'list_kelas', 'list_jk'));
                }
            } else {
                $title = 'Upload Bukti Pembayaran';
                return view('user.upload_bukti', compact('title', 'gelombang', 'daftar', 'list_kota', 'list_prodi', 'list_kelas', 'list_jk'));
            }
        }
    }
}
