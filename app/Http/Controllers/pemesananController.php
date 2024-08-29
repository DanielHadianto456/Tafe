<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\pemesananModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class pemesananController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getPemesanan()
    {
        $pemesanan_makanan = pemesananModel::get();
        return response()->json($pemesanan_makanan);
    }

    public function addPemesanan(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_user' => 'required',
            'id_makanan' => 'required',
            'qty' => 'required',
            // 'status_makanan' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = pemesananModel::create([
            'id_user' => $req->get('id_user'),
            'id_makanan' => $req->get('id_makanan'),
            'qty' => $req->get('qty'),
            'status_makanan' => 'masih_dikeranjang',
            // 'status' => 'pelanggan',
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah']);
        }
    }

    public function updatePemesanan(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id_user' => 'required',
            'id_makanan' => 'required',
            'qty' => 'required',
            'status_makanan' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = pemesananModel::where('id_user', $id)->update([
            'id_user' => $req->get('id_user'),
            'id_makanan' => $req->get('id_makanan'),
            'qty' => $req->get('qty'),
            'status_makanan' => $req->get('status_makanan'),
            // 'status' => $req->get('status'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deletePemesanan($id)
    {
        $pemesanan_makanan = pemesananModel::where('id_pemesanan_makanan', $id)->delete();
        return response()->json($pemesanan_makanan);
    }
}
