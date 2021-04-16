<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Alur;

use Auth;
use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AgentController extends Controller
{
    private $title = 'Agent yoUCB';
    private $url = 'agent';
    private $view = 'agent';

    public function lembaga()
    {

        $title = 'Daftar Lembaga Sebagai ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;

        return view('agent.lembaga');
    }

    public function create()
    {
        $title = 'Tambah Data ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = null;

        return view($folder . '.form', compact('title', 'url', 'folder', 'data'));
    }

    public function edit($id)
    {
        $title = 'Edit Data ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = Alur::find($id);

        return view($folder . '.form', compact('title', 'url', 'folder', 'data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if (is_null($request->id)) {
            $msg = [
                'gambar.image' => 'Gambar harus berektensi JPG, JPEG, PNG.',
                'gambar.required' => 'Gambar Tidak Boleh Kosong',
                'gambar.max' => 'Gambar ukuran tidak boleh dari 2Mb',
            ];
            $validator = Validator::make($request->all(), [
                'gambar' => 'required|image|max:2048',
            ], $msg);
        } else {
            $msg = [
                'gambar.image' => 'Gambar harus berektensi JPG, JPEG, PNG.',
                'gambar.required' => 'Gambar Tidak Boleh Kosong',
                'gambar.max' => 'Gambar ukuran tidak boleh dari 2Mb',
            ];
            $validator = Validator::make($request->all(), [
                'gambar' => 'required|image|max:2048',
            ], $msg);
        }


        if ($validator->passes()) {

            if ($request->aktif) {
                Alur::where('aktif', 'Y')->update(['aktif' => 'T']);
            }

            $destinationPath = 'alur';
            $rand = rand(1, 10000);

            $ext_file = $request->gambar->getClientOriginalExtension();
            $file_name = $rand . '.' . $ext_file;

            $request->gambar->move($destinationPath, $file_name);

            Alur::updateOrCreate(
                ['id' => $request->id],
                [
                    'gambar' => $file_name,
                    'aktif' => $request->aktif ? 'Y' : 'T',
                    'user_id' => Auth::user()->id,
                ]
            );

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url);
        }
        // dd($validator->errors()->all());
        Alert::error('tite', 'Error');
        return redirect($this->url);
    }


    public function destroy($id)
    {
        Alur::find($id)->delete();
        return response()->json(['success' => $this->title . ' Berhasil Dihapus.']);
    }
}
