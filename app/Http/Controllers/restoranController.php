<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;
use App\Models\restoranModel;
use Illuminate\Support\Facades\Auth;

class restoranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getRestoran']]);
    }
    public function getRestoran()
    {
        $restoran = restoranModel::with(['menu', 'meja'])->get();
        return response()->json($restoran);
    }

    public function getRestoranId($id)
    {
        $restoran = restoranModel::where('id_restoran', $id)->with(['menu', 'meja'])->get();
        return response()->json($restoran);
    }

    public function addRestoran(Request $req)
    {   
        $validator = Validator::make($req->all(), [
            'nama_restoran' => 'required',
            'alamat_restoran' => 'required',
            'deskripsi' => 'required',
            'denah' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = restoranModel::create([
            'nama_restoran' => $req->get('nama_restoran'),
            'alamat_restoran' => $req->get('alamat_restoran'),
            'deskripsi' => $req->get('deskripsi'),
            'denah' => $req->get('denah'),
            'jam_buka' => $req->get('jam_buka'),
            'jam_tutup' => $req->get('jam_tutup'),
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'gagal menambah']);
        }
    }

    public function updateRestoran(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama_restoran' => 'required',
            'alamat_restoran' => 'required',
            'deskripsi' => $req->get('deskripsi'),
            'denah' => $req->get('denah'),
            'jam_buka' => $req->get('jam_buka'),
            'jam_tutup' => $req->get('jam_tutup'),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = restoranModel::where('id_restoran', $id)->update([
            'nama_restoran' => $req->get('nama_restoran'),
            'alamat_restoran' => $req->get('alamat_restoran'),
            'deskripsi' => $req->get('deskripsi'),
            'denah' => $req->get('denah'),
            'jam_buka' => $req->get('jam_buka'),
            'jam_tutup' => $req->get('jam_tutup'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deleteRestoran($id)
    {
        $hapus = restoranModel::where('id_restoran', $id)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'message' => 'Sukses menghapus']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus']);
        }
    }
}
