<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\makananModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class makananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getMakanan()
    {
        $makanan = makananModel::with('restoran')->get();
        return response()->json($makanan);
    }

    public function getMakananId($id)
    {
        $makanan = makananModel::where('id_makanan', $id)->with('restoran')->get();
        return response()->json($makanan);
    }

    public function addMakanan(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_makanan' => 'required',
            'harga_makanan' => 'required',
            'id_restoran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = makananModel::create([
            'nama_makanan' => $req->get('nama_makanan'),
            'harga_makanan' => $req->get('harga_makanan'),
            'id_restoran' => $req->get('id_restoran'),
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah']);
        }
    }

    public function updateMakanan(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama_makanan' => 'required',
            'harga_makanan' => 'required',
            'id_restoran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = makananModel::where('id_makanan', $id)->update([
            'nama_makanan' => $req->get('nama_makanan'),
            'harga_makanan' => $req->get('harga_makanan'),
            'id_restoran' => $req->get('id_restoran'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deleteMakanan($id)
    {
        $makanan = makananModel::where('id_makanan', $id)->delete();
        return response()->json($makanan);
    }
}
