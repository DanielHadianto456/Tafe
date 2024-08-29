<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\restoranModel;
use App\Models\ratingDetailModel;
use App\Models\ratingModel;
use Illuminate\Support\Facades\Auth;

class ratingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getRating()
    {
        $rating = ratingModel::with('restoran', 'user')->get();
        return response()->json($rating);
    }

    public function getRatingId($id)
    {
        $dt = ratingModel::where('id_rating', $id)->with('restoran', 'user')->first();
        return response()->json($dt);
    }

    public function addRating(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_restoran' => 'required',
            'id_user' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = ratingModel::create([
            'id_restoran' => $req->get('id_restoran'),
            'id_user' => $req->get('id_user'),
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah']);
        }
    }

    public function updateRating(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id_restoran' => 'required',
            'id_user' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = ratingModel::where('id_rating', $id)->update([
            'id_restoran' => $req->get('id_restoran'),
            'id_user' => $req->get('id_user'),
            // 'status' => $req->get('status'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deleteRating($id)
    {
        $rating = ratingModel::where('id_rating', $id)->delete();
        return response()->json($rating);
    }

    public function getDetailRating()
    {
        $ratingDetail = ratingDetailModel::with('rating.restoran', 'rating.user')->get();
        return response()->json($ratingDetail);
    }

    public function getDetailRatingId($id)
    {
        $dt = ratingDetailModel::where('id_rating', $id)->with('user', 'rating.restoran')->get();
        return response()->json($dt);
    }

    public function addDetailRating(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            // 'id_peminjaman_buku' => 'required',
            // 'id_restoran' => 'required',
            'skor' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $save = ratingDetailModel::create([
            'id_rating' => $id,
            // 'id_restoran' => $req->id_restoran,
            'skor' => $req->skor
        ]);

        if ($save) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function updateDetailRating(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'skor' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $update = ratingDetailModel::where('id_detail_rating', $id)->update([
            'skor' => $req->get('skor'),
            // 'status' => $req->get('status'),
        ]);

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses mengganti']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengganti']);
        }
    }

    public function deleteDetailRating($id)
    {
        $ratingDetail = ratingDetailModel::where('id_detail_rating', $id)->delete();
        return response()->json($ratingDetail);
    }
}
