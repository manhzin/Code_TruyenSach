{{-- @dd($menu) --}}

<header class="header d-none d-lg-block">
    <!-- place navbar here -->
    <nav class="navbar navbar-expand-lg navbar-dark header__navbar p-md-0">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/frontend/images/logo_text1.png') }}" alt="Logo Truyen Zin" srcset=""
                    class="img-fluid" style="width: 200px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Thể loại
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom">
                            @foreach ($menu['the_loai'] as $menuItem)
                                <li><a class="dropdown-item"
                                        href="{{ route('category', ['slug' => $menuItem->slug]) }}">{{ $menuItem->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Theo số chương
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom">
                            <li><a class="dropdown-item" href="{{ route('get.list.story.with.chapters.count', ['value' => [0, 100]]) }}">Dưới 100</a>
                            <li><a class="dropdown-item" href="{{ route('get.list.story.with.chapters.count', ['value' => [100, 500]]) }}">100 - 500</a>
                            <li><a class="dropdown-item" href="{{ route('get.list.story.with.chapters.count', ['value' => [500, 1000]]) }}">500 - 1000</a>
                            <li><a class="dropdown-item" href="{{ route('get.list.story.with.chapters.count', ['value' => [1000, 999999999]]) }}">Trên 1000</a>
                        </li>
                        </ul>
                    </li>
                    @if (Route::currentRouteName() == 'chapter')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Tùy chỉnh
                            </a>
                            <div class="dropdown-menu dropdown-menu-right settings-theme">
                                <form class="form-horizontal">
                                    <div class="form-group form-group-sm d-flex align-items-center px-2 mb-2">
                                        <label class="w-25 control-label me-1" for="setting_font">Font chữ</label>
                                        <div class="w-75">
                                            <select class="form-control setting-font">
                                                <option value="roboto"
                                                    @if ($chapterFont == 'roboto') selected @endif>Roboto</option>
                                                <option value="mooli"
                                                    @if ($chapterFont == 'mooli') selected @endif>Mooli</option>
                                                <option value="patrick_hand"
                                                    @if ($chapterFont == 'patrick_hand') selected @endif>Patrick Hand
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm d-flex align-items-center px-2 mb-2">
                                        <label class="w-25 control-label me-1" for="setting_font_size">Size chữ</label>
                                        <div class="w-75">
                                            <select class="form-control setting-font-size">
                                                @for ($i = 16; $i <= 48; $i += 2)
                                                    <option value="{{ $i }}"
                                                        @if ($chapterFontSize == $i) selected @endif>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group form-group-sm d-flex align-items-center px-2">
                                        <label class="w-25 control-label me-1" for="setting_line_height">Chiều cao
                                            dòng</label>
                                        <div class="w-75">
                                            <select class="form-control setting-line-height">
                                                @for ($i = 100; $i <= 200; $i += 20)
                                                    <option value="{{ $i }}"
                                                        @if ($chapterLineHeight == $i) selected @endif>
                                                        {{ $i }}%</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endif

                    @if(!Session::get('login_publisher'))
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
                            Khách
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom">
                                <li>
                                    <a class="dropdown-item" href="{{route('dang-nhap')}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg> Đăng nhập</a>
                                    <a class="dropdown-item" href="{{route('dang-ki')}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg> Đăng kí</a>
                                </li>
                        </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
                            Profile:  {{Session::get('username')}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-custom">
                                <li>        
                                    <a class="dropdown-item" href="">Thông tin cơ bản</a>
                                    <a class="dropdown-item" href="">Truyện đã đăng</a>
                                    <a class="dropdown-item" href="{{route('yeu-thich')}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#d12323}</style><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                                        Yêu thích</a>
                                    <a class="dropdown-item" href="{{route('dang-xuat')}}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                                         Đăng xuất</a>
                                </li>
                        </ul>
                        </li>
                    @endif
                </ul>

                <div class="form-check form-switch me-3 d-flex align-items-center">
                    <label class="form-check-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-brightness-high" viewBox="0 0 16 16" style="fill: #fff;">
                            <path
                                d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                            </path>
                        </svg>
                    </label> 
                    <input class="form-check-input theme_mode" type="checkbox"
                        @if ($bgColorCookie == 'dark') checked @endif
                        style="transform: scale(1.3); margin-left: 12px; margin-right: 12px;">
                    <label class="form-check-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 384 512"
                            style="fill: #fff;">
                            <path
                                d="M144.7 98.7c-21 34.1-33.1 74.3-33.1 117.3c0 98 62.8 181.4 150.4 211.7c-12.4 2.8-25.3 4.3-38.6 4.3C126.6 432 48 353.3 48 256c0-68.9 39.4-128.4 96.8-157.3zm62.1-66C91.1 41.2 0 137.9 0 256C0 379.7 100 480 223.5 480c47.8 0 92-15 128.4-40.6c1.9-1.3 3.7-2.7 5.5-4c4.8-3.6 9.4-7.4 13.9-11.4c2.7-2.4 5.3-4.8 7.9-7.3c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-3.7 .6-7.4 1.2-11.1 1.6c-5 .5-10.1 .9-15.3 1c-1.2 0-2.5 0-3.7 0c-.1 0-.2 0-.3 0c-96.8-.2-175.2-78.9-175.2-176c0-54.8 24.9-103.7 64.1-136c1-.9 2.1-1.7 3.2-2.6c4-3.2 8.2-6.2 12.5-9c3.1-2 6.3-4 9.6-5.8c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-3.6-.3-7.1-.5-10.7-.6c-2.7-.1-5.5-.1-8.2-.1c-3.3 0-6.5 .1-9.8 .2c-2.3 .1-4.6 .2-6.9 .4z" />
                        </svg>  
                    </label>
                </div>

                <form class="d-flex header__form-search" action="{{ route('main.search.story') }}" method="GET">
                    @php
                        $valueDefault = '';
                        if (request()->input('key_word')) {
                            $valueDefault = request()->input('key_word');
                        }
                    @endphp
                    <input class="form-control search-story" type="text" placeholder="Tìm kiếm" name="key_word"
                        value="{{ $valueDefault }}">
                    <div class="col-12 search-result shadow no-result d-none">
                        <div class="card text-white bg-light">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush d-none">
                                    <li class="list-group-item">
                                        <a href="#" class="text-dark hover-title">Tự cẩm</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                        {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>

<div class="header-mobile d-sm-block d-lg-none">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/frontend/images/logo_text1.png') }}" alt="Logo Suu Truyen" srcset=""
                    class="img-fluid" style="width: 200px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark w-75" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <img src="{{ asset('assets/frontend/images/logo_text1.png') }}" alt="Logo Suu Truyen"
                        srcset="" class="img-fluid" style="width: 100px;">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mb-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Thể loại
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                @foreach ($menu['the_loai'] as $menuItem)
                                    <li><a class="dropdown-item"
                                            href="{{ route('category', ['slug' => $menuItem->slug]) }}">{{ $menuItem->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @if (Route::currentRouteName() == 'chapter')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Tùy chỉnh
                                </a>
                                <div class="dropdown-menu dropdown-menu-right settings-theme">
                                    <form class="form-horizontal">
                                        <div class="form-group form-group-sm d-flex align-items-center px-2 mb-2">
                                            <label class="w-25 control-label me-1" for="setting_font">Font chữ</label>
                                            <div class="w-75">
                                                <select class="form-control setting-font">
                                                    <option value="roboto"
                                                        @if ($chapterFont == 'roboto') selected @endif>Roboto
                                                    </option>
                                                    <option value="mooli"
                                                        @if ($chapterFont == 'mooli') selected @endif>Mooli</option>
                                                    <option value="patrick_hand"
                                                        @if ($chapterFont == 'patrick_hand') selected @endif>Patrick Hand
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm d-flex align-items-center px-2 mb-2">
                                            <label class="w-25 control-label me-1" for="setting_font_size">Size
                                                chữ</label>
                                            <div class="w-75">
                                                <select class="form-control setting-font-size">
                                                    @for ($i = 16; $i <= 48; $i += 2)
                                                        <option value="{{ $i }}"
                                                            @if ($chapterFontSize == $i) selected @endif>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm d-flex align-items-center px-2">
                                            <label class="w-25 control-label me-1" for="setting_line_height">Chiều cao
                                                dòng</label>
                                            <div class="w-75">
                                                <select class="form-control setting-line-height">
                                                    @for ($i = 100; $i <= 200; $i += 20)
                                                        <option value="{{ $i }}"
                                                            @if ($chapterLineHeight == $i) selected @endif>
                                                            {{ $i }}%</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>

                    <div class="form-check form-switch d-flex align-items-center mb-3 p-0">
                        <label class="form-check-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16"
                                style="fill: #fff;">
                                <path
                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                                </path>
                            </svg>
                        </label>
                        <input class="form-check-input theme_mode" type="checkbox"
                            @if ($bgColorCookie == 'dark') checked @endif
                            style="transform: scale(1.3); margin-left: 12px; margin-right: 12px;">

                        <label class="form-check-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 384 512" style="fill: #fff;">
                                <path
                                    d="M144.7 98.7c-21 34.1-33.1 74.3-33.1 117.3c0 98 62.8 181.4 150.4 211.7c-12.4 2.8-25.3 4.3-38.6 4.3C126.6 432 48 353.3 48 256c0-68.9 39.4-128.4 96.8-157.3zm62.1-66C91.1 41.2 0 137.9 0 256C0 379.7 100 480 223.5 480c47.8 0 92-15 128.4-40.6c1.9-1.3 3.7-2.7 5.5-4c4.8-3.6 9.4-7.4 13.9-11.4c2.7-2.4 5.3-4.8 7.9-7.3c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-3.7 .6-7.4 1.2-11.1 1.6c-5 .5-10.1 .9-15.3 1c-1.2 0-2.5 0-3.7 0c-.1 0-.2 0-.3 0c-96.8-.2-175.2-78.9-175.2-176c0-54.8 24.9-103.7 64.1-136c1-.9 2.1-1.7 3.2-2.6c4-3.2 8.2-6.2 12.5-9c3.1-2 6.3-4 9.6-5.8c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-3.6-.3-7.1-.5-10.7-.6c-2.7-.1-5.5-.1-8.2-.1c-3.3 0-6.5 .1-9.8 .2c-2.3 .1-4.6 .2-6.9 .4z" />
                            </svg>
                        </label>
                    </div>

                    <form class="d-flex header__form-search" action="{{ route('main.search.story') }}"
                        method="GET">
                        @php
                            $valueDefault = '';
                            if (request()->input('key_word')) {
                                $valueDefault = request()->input('key_word');
                            }
                        @endphp
                        <input class="form-control search-story" type="text" placeholder="Tìm kiếm"
                            name="key_word" value="{{ $valueDefault }}">
                        <div class="col-12 search-result shadow no-result d-none">
                            <div class="card text-white bg-light">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush d-none">
                                        <li class="list-group-item">
                                            <a href="#" class="text-dark hover-title">Tự cẩm</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button class="btn" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                            {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="bg-light header-bottom">
    <div class="container py-1">
        <p class="mb-0">Đọc truyện online, đọc truyện chữ, truyện full, truyện hay. Tổng hợp đầy đủ và cập nhật liên
            tục.</p>
    </div>
</div>

@push('scripts')
    <script src="{{ asset(mix('assets/frontend/js/common.js')) }}"></script>
@endpush
