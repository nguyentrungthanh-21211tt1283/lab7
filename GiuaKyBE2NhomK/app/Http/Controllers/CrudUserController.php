<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Redirector;
use Hash;
use Session;
use App\Models\User;
use App\Models\User_favorite;
use App\Models\Posts;
use App\Models\Favorities;

use Illuminate\Support\Facades\Auth;
class CrudUserController extends Controller
{
    public function indexCreate()
    {
        return view('crud_user.create');
    }

    public function createUser(Request $request)
    {                                   

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|max:10',
            'image' => 'required',
        ]);

        $data = $request->all();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ex = $file->getClientOriginalExtension(); //Lay phan mo rong .jpn,....
            $filename = time().'.'.$ex;
            $file->move('uploads/userimage/',$filename);
            $data['image'] = $filename;

        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'image' => $data['image'],    
        ]);

        return redirect()->route('user.loginIndex');
    }

    public function listUser()
    {
            $users = User::paginate(2);
            return view('crud_user.list',['users' => $users]);
    }

    public function detail(Request $request)
    {
        $user_id = $request->query('id');
        $user = User::find($user_id);
        $userProfile = User::join('user_profile', 'user_profile.user_id', '=', 'users.user_id')
        ->where('user_profile.user_id', $user_id)
        ->get();
        $userPost = User::join('posts', 'posts.user_id', '=', 'users.user_id')
        ->where('posts.user_id', $user_id)
        ->get();
        $userFavoritie = Favorities::join('user_favorites', 'favorities.favorite_id', '=', 'user_favorites.favorite_id')
        ->where('user_favorites.user_id', $user_id)
        ->get();
        return view('crud_user.read',
        ['user' => $user,
        'userProfile' => $userProfile,
        'userPost' => $userPost,
        'userFavoritie' => $userFavoritie]);
    }

    public function UpdateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update',['user' => $user]);
    }

    public function PostUpdateUser(Request $request)
    {
        $input = $request->all();
        $user = User::find($input['id']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->phone = $input['phone'];

        if($request->hasFile('image'))
        {
            //Xoa ảnh cũ
            $image_cu = 'uploads/userimage/' . $user->image;
            if(File::exists($image_cu))
            {
                File::delete($image_cu);
            }
            //xử lý ảnh mới
            $file = $request->file('image');
            $ex = $file->getClientOriginalExtension(); //Lay phan mo rong .jpn,....
            $filename = time().'.'.$ex;
            $file->move('uploads/userimage/',$filename);
            $user['image'] = $filename;
        }
        $user->save();
        return redirect('list');

    }

    // Delete user by id
    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        $user_Favorite = User_favorite::where('user_id', $user_id)->first();
        $user_Post = Posts::where('user_id', $user_id)->first();
        if ($user_Favorite !== null || $user_Post !== null) {
            return redirect("list")->withErrors('Không thể xóa vì user có bài viết hoặc sở thích');
        }
        $user = User::destroy($user_id);
        return redirect("list")->withSuccess('You have Signed-in');
    }
    public function indexLogin()
    {
        return view('crud_user.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');

        // $user = \App\Models\User::find(4);
        // if ($user) {
        //     Auth::loginUsingId($user ->id);
        //     return redirect('/list');
        // }
        // else{
        //    return redirect('/login') ->with('Login details are not valid');
        // }
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        
        return Redirect('login');
    }
}