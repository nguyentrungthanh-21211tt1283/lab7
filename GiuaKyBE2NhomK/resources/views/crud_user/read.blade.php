@extends('dashboard')

@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <h3 class="card-header text-center">Màn hình chi tiết</h3>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"><span>ID</span></div>
                            <div class="col-md-3">{{ $user->user_id }}</div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"><span>Username</span></div>
                            <div class="col-md-3">{{ $user->name }}</div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"><span>Email</span></div>
                            <div class="col-md-3">{{ $user->email}}</div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"><span>Name Image</span></div>
                            <div class="col-md-3">{{ $user->image}}</div>
                            <div class="col-md-3"></div>
                        </div>

                        <h3>Hiển thị thông tin user được trích xuất từ user_profile:</h3>
                        @foreach($userProfile as $item)
                        {{ $item->first_name }} <br>
                        {{ $item->last_name }} <br>
                        @if($item->sex == 0)
                        Nam <br>
                        @elseif($item->sex == 1)
                        Nữ <br>
                        @else
                        Khác <br>
                        @endif
                        {{ $item->phone }} <br>
                        {{ $item->address }} <br>
                        @endforeach

                        <h3>Hiển thị thông tin bài viết được đăng bởi user</h3>
                        @foreach($userPost as $item)
                        <span><b>ID bài viết:</b></span> {{ $item->post_id }} <br>
                        <span><b>Tên bài viết:</b></span> {{ $item->post_name }} <br>
                        @endforeach

                        <h3>Hiển thị thông tin sở thích của user</h3>
                        @foreach($userFavoritie as $item)
                        <span><b>ID sở thích:</b></span> {{ $item->favorite_id }} <br>
                        <span><b>Tên sở thích:</b></span> {{ $item->favorite_name }} <br>
                        @endforeach
                        <div class="row btn_edit">
                            <div class="col-md-8"></div>
                            <div class="col-md-2">
                                <div class="d-grid mx-auto">
                                    <a href="{{ route('user.UpdatetUser', ['id' => $user->id]) }}"
                                        class="btn btn-primary btn-block">Chỉnh sửa</a>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection