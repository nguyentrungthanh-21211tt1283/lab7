@extends('dashboard')

@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sở thích</th>
                        <th>Nội dung sở thích</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorities as $item)
                    <tr>
                        <th>{{ $item->favorite_id }}</th>
                        <th>{{ $item->favorite_name }}</th>
                        <th>{{ $item->favorite_description }}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2"></div>
            <div class="col-md-5"></div>
        </div>

    </div>
</main>
@endsection