<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class PostController extends Controller
{
    public function indexListPost() {
        $posts = Posts::all();
        return view('crud_user.post',['posts' => $posts]);
    }
}
