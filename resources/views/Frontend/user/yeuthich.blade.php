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
                            <span href="#" class="d-block text-decoration-none text-dark fs-4 category-name" title="dang-nhap">Truyện yêu thích</span> 
                        </h2>
                    </div>
                </div>  

                
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên truyện</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">User</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                @foreach($favorites as $key => $favorite)
                <tbody>
                  <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$favorite->title}}</td>
                    <td><img src="{{ asset($favorite->image) }}" alt="{{ $favorite->name }}" class=""
                        width="150" height="160" loading='lazy'></td>
                    <td>{{$favorite->publisher->username}}</td>
                    <td>{{$favorite->date_updated}}</td>
                    <td>
                        <form action="{{ route('xoayeuthich.delete', ['id' => $favorite->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Bạn có chắc chắn muốn xóa yêu thích này?')">Xóa</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>

    </div>
@endsection
