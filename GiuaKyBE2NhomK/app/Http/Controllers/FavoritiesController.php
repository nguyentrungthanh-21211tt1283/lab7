<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorities;

class FavoritiesController extends Controller
{
    public function indexListFavoritie() {
        $favorities = Favorities::all();
        return view('crud_user.favorities',['favorities' => $favorities]);
    }
}
