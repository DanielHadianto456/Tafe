<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\cartModel;
use App\Models\cartDetailModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    // public function getCart()
    // {   

    //     $cart = cartModel::with('user', 'meja.restoran')->get();
    //     return response()->json($cart);
    // }

    public function getCart()
    {
        $carts = cartModel::with(['user', 'meja.restoran', 'cartDetails.makanan.restoran'])->get();

        return response()->json($carts);
    }

    // public function getCartId($id)
    // {   
    //     $cart = cartModel::where('id_cart', $id)->with('user', 'meja.restoran')->first();
    //     $cartDetail = cartDetailModel::where('id_cart', $id)->with('cart.meja.restoran', 'cart.user', 'makanan.restoran')->get();

    //     $combined = [
    //         'cart' => $cart,
    //         'cartDetail' => $cartDetail
    //     ];

    //     return response()->json($combined);
    // }

    public function getCartId($id)
    {
        $carts = cartModel::where('id_cart', $id)->with(['user', 'meja.restoran', 'cartDetails.makanan.restoran'])->get();

        return response()->json($carts);
    }

    // public function getCartIdUser($id)
    // {   
    //     $cart = cartModel::where('id_user', $id)->with('user', 'meja.restoran')->get();
    //     return response()->json($cart);
    // }
    public function getCartIdUser($id)
    {
        // $cart = cartModel::where('id_user', $id)->with('user', 'meja.restoran')->get();
        $cart = cartModel::where('id_user', $id)->with(['user', 'meja.restoran', 'cartDetails.makanan.restoran'])->get();
        return response()->json($cart);
    }

    public function addCart(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_user' => 'required',
            // 'id_meja' => 0,
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = cartModel::create([
            'id_user' => $req->get('id_user'),
            'id_meja' => null,
            'status' => 'UNCONFIRMED',
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah']);
        }
    }

    public function updateCartMeja(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id_meja' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = cartModel::where('id_cart', $id)->update([
            'id_meja' => $req->get('id_meja'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deleteCart($id)
    {
        $user = cartModel::where('id_cart', $id)->delete();
        return response()->json($user);
    }

    public function setConfirmed($id)
    {
        $cart = cartModel::find($id);

        if (!$cart) {
            return response()->json(['status' => false, 'message' => 'Cart not found']);
        }

        $cart->status = 'CONFIRMED';
        $cart->save();

        $cartMeja = $cart->cartMeja;
        if ($cartMeja) {
            $cartMeja->status = 'penuh';
            $cartMeja->save();
        }

        return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
    }

    public function setCancel($id)
    {
        $cart = cartModel::find($id);

        if (!$cart) {
            return response()->json(['status' => false, 'message' => 'Cart not found']);
        }

        $cart->status = 'CANCELED';
        $cart->save();

        $cartMeja = $cart->cartMeja;
        if ($cartMeja) {
            $cartMeja->status = 'kosong';
            $cartMeja->save();
        }

        return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
    }

    // public function deletart($id)
    // {
    //     $cart = cartModel::where('id_cart', $id)->delete();
    //     return response()->json($cart);
    // }

    // public function setUnconfirmed($id)
    // {
    //     $update = cartModel::where('id_cart', $id)->update([
    //         'status' => 'UNCONFIRMED'
    //     ]);

    //     if ($update) {
    //         return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
    //     } else {
    //         return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
    //     }
    // }
}
