@extends('dashboard')

@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID User</th>
                        <th>Post Name</th>
                        <th>Post Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $item)
                    <tr>
                        <th>{{ $item->post_id }}</th>
                        <th>{{ $item->user_id }}</th>
                        <th>{{ $item->post_name }}</th>
                        <th>{{ $item->post_description }}</th>
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