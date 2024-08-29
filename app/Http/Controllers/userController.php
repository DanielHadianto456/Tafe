<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\userModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function getUser()
    {
        $user = userModel::get();
        return response()->json($user);
    }

    public function addUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'username' => 'required',
            'pass' => 'required',
            'email' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = userModel::create([
            'nama' => $req->get('nama'),
            'username' => $req->get('username'),
            'pass' => $req->get('pass'),
            'email' => $req->get('email'),
            'status' => 'pelanggan',
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah']);
        }
    }

    public function updateUser(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'username' => 'required',
            'pass' => 'required',
            'email' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = userModel::where('id_user', $id)->update([
            'nama' => $req->get('nama'),
            'username' => $req->get('username'),
            'pass' => $req->get('pass'),
            'email' => $req->get('email'),
            // 'status' => $req->get('status'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function updateStatus(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = userModel::where('id_user', $id)->update([
            'status' => $req->get('status'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deleteUser($id)
    {
        $user = userModel::where('id_user', $id)->delete();
        return response()->json($user);
    }

    public function getUserId($id){
        $dt=userModel::where('id_user', $id)->first();
        return response()->json($dt);
    }
}
