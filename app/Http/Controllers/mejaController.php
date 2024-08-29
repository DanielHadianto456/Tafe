<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\mejaModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// use Illuminate\Http\Request;

class mejaController extends Controller
{   
    // public function getMeja()
    // {
    //     $meja = mejaModel::get();
    //     return response()->json($meja);
    // }

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getMeja()
    {
        $meja = mejaModel::with('restoran')->get();
        return response()->json($meja);
    }

    public function getMejaRestoran($id)
    {
        $meja = mejaModel::where('id_restoran', $id)->with('restoran')->get();
        return response()->json($meja);
    }

    public function addMeja(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_restoran' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = mejaModel::create([
            'id_restoran' => $req->get('id_restoran'),
            'status' => 'kosong',
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah']);
        }
    }

    public function updateMeja(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id_restoran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = mejaModel::where('id_meja', $id)->update([
            'id_restoran' => $req->get('id_restoran'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function updateStatusPenuh(Request $req, $id)
    {
        $update = mejaModel::where('id_meja', $id)->update([
            'status' => 'penuh',
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function updateStatusKosong(Request $req, $id)
    {
        $update = mejaModel::where('id_meja', $id)->update([
            'status' => 'kosong',
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deleteMeja($id)
    {
        $meja = mejaModel::where('id_meja', $id)->delete();
        return response()->json($meja);
    }
}
