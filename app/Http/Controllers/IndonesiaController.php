<?php

namespace App\Http\Controllers;

use Auth;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;
use Illuminate\Http\Request;

class IndonesiaController extends Controller
{

    public function get_kab(Request $request)
    {
        $kab = Kabupaten::where('provinsi_id', $request->get('id'))->pluck('name', 'id');

        return response()->json($kab);
    }

    public function get_kec(Request $request)
    {
        $kab = Kecamatan::where('kabupaten_id', $request->get('id'))->pluck('name', 'id');

        return response()->json($kab);
    }

    public function get_kel(Request $request)
    {
        $kab = Kelurahan::where('kecamatan_id', $request->get('id'))->pluck('name', 'id');

        return response()->json($kab);
    }
}
