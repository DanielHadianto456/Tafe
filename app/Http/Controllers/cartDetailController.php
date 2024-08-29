<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\cartDetailModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class cartDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getCartDetail()
    {
        $user = cartDetailModel::with('cart.meja.restoran', 'cart.user', 'makanan.restoran')->get();
        return response()->json($user);
    }

    public function getCartDetailId($id)
    {
        $user = cartDetailModel::where('id_cart', $id)->with('cart.meja.restoran', 'cart.user', 'makanan.restoran')->get();
        return response()->json($user);
    }

    public function addCartDetail(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id_makanan' => 'required',
            'qty' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = cartDetailModel::create([
            'id_cart' => $id,
            'id_makanan' => $req->get('id_makanan'),
            'qty' => $req->get('qty'),
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah']);
        }
    }

    public function updateCartDetail(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id_makanan' => 'required',
            'qty' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = cartDetailModel::where('id_detail_cart', $id)->update([
            'id_makanan' => $req->get('id_makanan'),
            'qty' => $req->get('qty'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }
    //checkpoint
    public function deleteCartDetail($id)
    {
        $user = cartDetailModel::where('id_detail_cart', $id)->delete();
        return response()->json($user);
    }
}
