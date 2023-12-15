@extends('Frontend.layouts.default')

@push('custom_schema')
    {{-- {!! SEOMeta::generate() !!} --}}
    {{-- {!! JsonLd::generate() !!} --}}
    {!! SEO::generate() !!}
@endpush

@push('before_content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0&appId=642249148046913&autoLogAppEvents=1"
        nonce="Tt2viYEC"></script>
@endpush

@section('content')
    @php    
        if (count($chapters->items()) > 1) {
            $arrChapters = array_chunk($chapters->items(), count($chapters->items()) / 2);
        } else {
            $arrChapters[] = $chapters->items();
        }
        $storyFinal = $story;
    @endphp

    <input type="hidden" id="story_slug" value="{{ $slug }}">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="head-title-global d-flex justify-content-between mb-4">
                    <div class="col-12 col-md-12 col-lg-4 head-title-global__left d-flex">
                        <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                            <span class="d-block text-decoration-none text-dark fs-4 title-head-name"
                                title="Thông tin truyện">Thông
                                tin truyện</span>
                        </h2>
                    </div>
                </div>

                <div class="story-detail">
                    <div class="story-detail__top d-flex align-items-start">
                        <div class="row align-items-start">
                            <div class="col-12 col-md-12 col-lg-3 story-detail__top--image">
                                <div class="book-3d">
                                    <img src="{{ asset($story->image) }}" alt="{{ $story->name }}" class="img-fluid w-100"
                                        width="200" height="300" loading='lazy'>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-9">
                                <h3 class="text-center story-name">{{ $story->name }}</h3>
                                
                                <h3 style="margin: 10px 0px 20px 80px">
                                    <form>
                                        @csrf
                                    <button type="button" onclick="return themyeuthich()" 
                                        data-fa_publisher_id="{{Session::get('publisher_id')}}"
                                        data-fa_date_updated="{{Session::get('date_updated')}}"
                                        data-fa_title="{{$story->name}}" 
                                        data-fa_image="{{$story->image}}"
                                        
                                        class="btn btn-danger btn-yeuthichtruyen">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#31a22f}</style><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                                            Yêu thích</button></h3>
                                    </form>
                                @if (isset($story->star))
                                    <div class="rate-story mb-2">
                                        <div class="rate-story__holder" data-score="{{ $story->star->stars }}">
                                            @php
                                                $valueStars = floatval($story->star->stars);
                                            @endphp

                                            @for ($i = 1; $i <= 10; $i++)
                                                @php
                                                    $tmp = $valueStars - $i;
                                                    $starImage = asset('/images/star-off.png');
                                                    
                                                    if ($valueStars >= $i) {
                                                        if ($tmp > 0.5) {
                                                            $starImage = asset('/images/star-on.png');
                                                        } else {
                                                            $starImage = asset('/images/star-half.png');
                                                        }
                                                    } else {
                                                        // $tmp2 = $i - $valueStars;
                                                        // if ($tmp2 > 0 && $tmp2 < 0.5) {
                                                        //     $starImage = asset('/images/star-half.png');
                                                        // }
                                                    }
                                                @endphp

                                                <img alt="{{ $i }}" src="{{ $starImage }}" />

                                                {{-- @if ($i != 10)
                                                    &nbsp;
                                                @endif --}}
                                            @endfor

                                            {{-- <input name="score" type="hidden" value="6.3" readonly=""> --}}
                                        </div>
                                        <em class="rate-story__text"></em>
                                        <div class="rate-story__value" itemprop="aggregateRating" itemscope=""
                                            itemtype="https://schema.org/AggregateRating">
                                            <em>Đánh giá:
                                                <strong>
                                                    <span itemprop="ratingValue">{{ $story->star->stars }}</span>
                                                </strong>
                                                /
                                                <span class="" itemprop="bestRating">10</span>
                                                từ
                                                <strong>
                                                    <span itemprop="ratingCount">{{ $story->star->count }}</span>
                                                    lượt
                                                </strong>
                                            </em>
                                        </div>
                                    </div>
                                @endif

                                <div class="story-detail__top--desc px-3">
                                    {!! $story->desc !!}
                                </div>

                                <div class="info-more">
                                    <div class="info-more--more active" id="info_more">
                                        <span class="me-1 text-dark">Xem thêm</span>
                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.70749 7.70718L13.7059 1.71002C14.336 1.08008 13.8899 0.00283241 12.9989 0.00283241L1.002 0.00283241C0.111048 0.00283241 -0.335095 1.08008 0.294974 1.71002L6.29343 7.70718C6.68394 8.09761 7.31699 8.09761 7.70749 7.70718Z"
                                                fill="#2C2C37"></path>
                                        </svg>
                                    </div>

                                    <a class="info-more--collapse text-decoration-none" href="#info_more">
                                        <span class="me-1 text-dark">Thu gọn</span>
                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.70749 0.292817L13.7059 6.28998C14.336 6.91992 13.8899 7.99717 12.9989 7.99717L1.002 7.99717C0.111048 7.99717 -0.335095 6.91992 0.294974 6.28998L6.29343 0.292817C6.68394 -0.097606 7.31699 -0.0976055 7.70749 0.292817Z"
                                                fill="#2C2C37"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="story-detail__bottom mb-3">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-3 story-detail__bottom--info">
                                <p class="mb-1">
                                    <strong>Tác giả:</strong>
                                    <a href="#"
                                        class="text-decoration-none text-dark hover-title">{{ $story->author->name }}</a>
                                </p>
                                <div class="d-flex align-items-center mb-1 flex-wrap">
                                    <strong class="me-1">Thể loại:</strong>
                                    <div class="d-flex align-items-center flex-warp">
                                        @if ($story->categories)
                                            @foreach ($story->categories as $category)
                                                {{-- @if (!$loop->last)
                                                    <a href="#" class="text-decoration-none text-dark hover-title me-1" style="width: max-content;">{{ $category->name }},</a>
                                                @else
                                                    <a href="#"
                                                        class="text-decoration-none text-dark hover-title" style="width: max-content;">{{ $category->name }}</a>
                                                @endif --}}

                                                <a href="#"
                                                    class="text-decoration-none text-dark hover-title @if (!$loop->last) me-1 @endif"
                                                    style="width: max-content;">{{ $category->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                {{-- <p class="mb-1">
                                    <strong>Nguồn:</strong>
                                    <a href="#" class="text-decoration-none text-dark hover-title">Phong Nguyệt
                                        Lầu</a>
                                </p> --}}
                                <p class="mb-1">
                                    <strong>Trạng thái:</strong>
                                    <span class="text-info">{{ $story->is_full ? 'Full' : 'Đang ra' }}</span>
                                </p>
                            </div>

                            @if (count($chaptersNew) > 0)
                                <div class="col-12 col-md-12 col-lg-9">
                                    <div class="head-title-global d-flex justify-content-between mb-2">
                                        <div class="col-12 col-md-12 col-lg-6 head-title-global__left d-flex">
                                            <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                                <span href="#"
                                                    class="d-block text-decoration-none text-dark fs-4 title-head-name"
                                                    title="Truyện hot">Các chương mới nhất</span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="story-detail__bottom--chapters-new">
                                        <ul>
                                            @foreach ($chaptersNew as $chapterNew)
                                                <li>
                                                    <a href="#"
                                                        class="text-decoration-none text-dark hover-title">{{ $chapterNew->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="story-detail__list-chapter">
                        <div class="head-title-global d-flex justify-content-between mb-4">
                            <div class="col-6 col-md-12 col-lg-4 head-title-global__left d-flex">
                                <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                    <span href="#" class="d-block text-decoration-none text-dark fs-4 title-head-name"
                                        title="Truyện hot">Danh sách chương</span>
                                </h2>
                            </div>
                        </div>

                        <div class="story-detail__list-chapter--list">
                            <div class="row">
                                @if (count($arrChapters) > 0)
                                    @foreach ($arrChapters as $chaptersList)
                                        <div class="col-12 col-sm-6 col-lg-6 story-detail__list-chapter--list__item">
                                            <ul>
                                                @foreach ($chaptersList as $chapter)
                                                    <li>
                                                        <a href="{{ route('chapter', ['slugStory' => $story->slug, 'slugChapter' => $chapter->slug]) }}"
                                                            class="text-decoration-none text-dark hover-title">{{ $chapter->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="pagination" style="justify-content: center;">
                        {{ $chapters->appends(request()->query())->onEachSide(2)->links('Frontend.snippets.custom_pagination', ['has_ajax' => true]) }}
                    </div>
                    <h2>Bình luận</h2>
                    @php
                        $current_url = Request::url();
                    @endphp
                    <div class="fb-comments" data-href="{{ $current_url}}" data-width="" data-numposts="5"></div>
                    
                </div>
            </div>

            <div class="col-12 col-md-5 col-lg-4 sticky-md-top">
                @if ($story->author->stories->count() - 1 > 0)
                    <div class="section-stories-reading bg-light p-2 rounded mb-3 card-custom">
                        <div class="head-title-global mb-2">
                            <div class="col-12 col-md-12 head-title-global__left">
                                <h2 class="mb-0 border-bottom border-secondary pb-1">
                                    <span href="#" class="d-block text-decoration-none text-dark fs-4"
                                        title="Truyện đang đọc">Truyện cùng tác giả</span>
                                </h2>
                            </div>
                        </div>
                        <div class="stories-reading">
                            @foreach ($story->author->stories as $storyNear)
                                @if ($storyNear->slug != $story->slug)
                                    <div class="story-item-no-image">
                                        <div class="story-item-no-image__name d-flex align-items-center border-0"
                                            style="width: 70%;">
                                            <h3 class="me-1 mb-0 d-flex align-items-center">
                                                <i class="fa-solid fa-angle-right me-1"></i>
                                                <a href="{{ route('story', ['slug' => $storyNear->slug]) }}"
                                                    class="text-decoration-none text-dark fs-6 hover-title text-one-row">{{ $storyNear->name }}</a>
                                            </h3>
                                            @if ($storyNear->is_new)
                                                <span class="badge text-bg-info text-light me-1">New</span>
                                            @endif

                                            @if ($storyNear->is_full)
                                                <span class="badge text-bg-success text-light">Full</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @include('Frontend.snippets.top_ratings', [
                    'ratingsDay' => $ratingsDay, 
                    'ratingsMonth' => $ratingsMonth, 
                    'ratingsAllTime' => $ratingsAllTime, 
                    'storiesDay' => $storiesDay, 
                    'storiesMonth' => $storiesMonth, 
                    'storiesAllTime' => $storiesAllTime
                ])
                @include('Frontend.sections.main.list_category')
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Book",
      "name": "{{ $storyFinal->name }}",
      "author": {
        "@type":"Person",
        "name": "{{ $storyFinal->author->name }}"
      },
      "url" : "{{ route('story', $storyFinal->slug) }}",
      "image": "{{ asset($storyFinal->image) }}",
      "thumbnailUrl": "{{ asset($storyFinal->image) }}",
      "description": "{!! Str::limit($storyFinal->desc, 50) !!}",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ isset($storyFinal->star) ? $storyFinal->star->stars : 0 }}",
        "bestRating": "10",
        "ratingCount": "{{ isset($storyFinal->star) ? $storyFinal->star->count : 0 }}"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Suu Truyen"
      }
    }
</script>
    <script type="application/ld+json">
        {
        "@context": "https://schema.org/",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Đọc Truyện",
                "item": "{{ route('home') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ $storyFinal->name }}",
                "item": "{{ route('story', $storyFinal->slug) }}"
            }
        ]
        }
</script>
<div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="C6Pi4H8F"></script>
    <script src="{{ asset(mix('assets/frontend/js/story.js')) }}"></script>
@endpush
