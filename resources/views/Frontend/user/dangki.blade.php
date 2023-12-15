@extends('Frontend.layouts.default')

@push('custom_schema')
{{-- {!! SEOMeta::generate() !!} --}}
{{-- {!! JsonLd::generate() !!} --}}
{!! SEO::generate() !!}
@endpush

@section('content')
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-md-8 col-lg-9 mb-3">
                <div class="head-title-global d-flex justify-content-between mb-2">
                    <div class="col-12 col-md-12 col-lg-12 head-title-global__left d-flex">
                        <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                            <span href="#" class="d-block text-decoration-none text-dark fs-4 category-name" title="dang-nhap">Trang đăng kí cho khách hàng</span>
                            
                        </h2>
                    </div>
                </div>  
            </div>
        </div>

        <form method="POST" action="{{route('register-publisher')}}">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

            @csrf
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">FullName</label>
                <input type="text" name="fullname" class="form-control" id="exampleInputPassword1" placeholder="vd:Nguyen Duc Manh">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">UserName</label>
                <input type="text" name="username" class="form-control" id="exampleInputPassword1"placeholder="vd: DucManh">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
                <input type="text" name="sdt" class="form-control" id="exampleInputPassword1"placeholder="vd: 0922****">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="text" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password Confirmed</label>
                <input type="text" name="password_confirmation" class="form-control" id="exampleInputPassword1">
              </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Don't Forget</label>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
            <hr>
            <a href="{{route('dang-nhap')}}">Đăng nhập nếu bạn đã có tài khoản.</a>
          </form>
    </div>
@endsection
