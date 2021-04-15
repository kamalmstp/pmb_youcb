<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Validasi;

use Auth;
use Alert;
use App\DokumenPersyaratan;
use App\Gelombang;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;

class UploadBuktiController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());

        $msg = [
            'file_bukti.image' => 'File harus berektensi JPG, JPEG, PNG.',
            'file_bukti.required' => 'File Tidak Boleh Kosong',
            'file_bukti.max' => 'File ukuran tidak boleh dari 2Mb',
        ];
        $validator = Validator::make($request->all(), [
            'file_bukti' => 'required|image|max:2048',
        ], $msg);


        if ($validator->passes()) {

            $gelombang = Gelombang::where('aktif', 'Y')->first();

            $destinationPath = 'file_bukti';

            $ext_file = $request->file_bukti->getClientOriginalExtension();
            $file_name = Auth::user()->id . '.' . $ext_file;

            $request->file_bukti->move($destinationPath, $file_name);

            Validasi::updateOrCreate(
                ['user_id' => Auth::user()->id],
                [
                    'file_bukti' => $file_name,
                    'status' => 'Baru',
                    'th_akademik_id' => $gelombang->mst_th_akademik_id,
                    'gelombang_id' => $gelombang->id,
                    'user_id' => Auth::user()->id,
                ]
            );

            Alert::success('Upload Bukti Pembayaran', 'File berhasil di Upload.');

            try {
                Mail::send('email.notify', ['nama' => 'Bukti', 'pesan' => 'Pemberitahuan Bahwa Sudah di Transfer'], function ($message) {
                    $message->subject('Notifikasi Pembayaran Calon Mahasiswa');
                    $message->from('noreply.youcb@gmail.com', 'PMB yoUCB');
                    $message->to('pmb.youcb@gmail.com');
                });
                return redirect('home');
            } catch (Exception $e) {
                return response(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
        // dd($validator->errors()->all());
        Alert::error('Upload Bukti Pembayaran', $validator->errors()->all());
        return redirect('home')
            ->withErrors($validator)
            ->withInput();
    }

    public function update($id, Request $request)
    {
        // dd($id);
        // dd($request->all());

        $msg = [
            'nama_berkas.required' => 'Nama File Tidak Boleh Kosong',
            'berkas.image' => 'File harus berektensi JPG, JPEG, PNG.',
            'berkas.required' => 'File Tidak Boleh Kosong',
            'berkas.max' => 'File ukuran tidak boleh dari 2Mb',
        ];
        $validator = Validator::make($request->all(), [
            'nama_berkas' => 'required',
            'berkas' => 'required|image|max:2048',
        ], $msg);


        if ($validator->passes()) {



            $destinationPath = 'dokumen_syarat';
            $slug = Str::of($request->nama_berkas)->slug('-');
            $ext_file = $request->berkas->getClientOriginalExtension();
            $file_name = Auth::user()->id . '_' . $slug . '.' . $ext_file;

            $request->berkas->move($destinationPath, $file_name);

            DokumenPersyaratan::create(
                [
                    'pmb_formulir_id' => $id,
                    'nama_berkas' => $request->nama_berkas,
                    'berkas' => $file_name,
                    'user_id' => Auth::user()->id,
                ]
            );

            Alert::success('Upload Dokumen Persyaratan', 'File berhasil di Upload.');

            try {
                Mail::send('email.notify', ['nama' => 'Dokumen Persyaratan', 'pesan' => 'Pemberitahuan Dokumen Persyaratan'], function ($message) {
                    $message->subject('Notifikasi Upload Dokumen Persyaratan Calon Mahasiswa');
                    $message->from('noreply.youcb@gmail.com', 'PMB yoUCB');
                    $message->to('pmb.youcb@gmail.com');
                });
                return redirect('home');
            } catch (Exception $e) {
                return response(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
        Alert::error('Upload Dokumen Persyaratan', $validator->errors()->all());
        return redirect('home')
            ->withErrors($validator)
            ->withInput();
    }
}
