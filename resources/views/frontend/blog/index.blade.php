@extends('layouts.frontend.master')

@section('content')

    <!--// Breadcrumb Section Start //-->
    <section class="breadcrumb-section section" data-scroll-index="1" @if (isset($breadcrumb)) data-bg-image-path = "{{ asset('uploads/img/general/'.$breadcrumb->breadcrumb_image) }}"
             @else data-bg-image-path="{{ asset('uploads/img/dummy/1920x750.jpg') }}"
            @endif>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb-inner">
                        <h1>{{ __('frontend.blogs') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.blogs') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!-- Blog Grid Start -->
    @if (count($blogs) > 0)
        <section id="latest-blog" class="section pb-minus-70">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-md-4">
                            <div class="item">
                                <div class="landing-blog-item">
                                    @if (!empty($blog->blog_image))
                                        <div class="blog-img">
                                            <a href="{{ route('blog-page.show', ['slug' => $blog->slug]) }}">
                                                <img src="{{ asset('uploads/img/blog/thumbnail/'.$blog->blog_image) }}" alt="Blog image" class="img-fluid">
                                            </a>
                                        </div>
                                    @else
                                        <div class="blog-img">
                                            <a href="{{ route('blog-page.show', ['slug' => $blog->slug]) }}">
                                                <img src="{{ asset('uploads/img/dummy/no-image.jpg') }}" alt="Blog image" class="img-fluid">
                                            </a>
                                        </div>
                                    @endif

                                    <div class="blog-body">
                                        <div class="blog-meta">
                                            <a href="#"><span><i class="far fa-user"></i>@if ($blog->type == "with_this_account") {{ $blog->author_name }} @else {{ __('frontend.anonymous') }} @endif</span></a>
                                            <a href="#"><span><i class="far fa-bookmark"></i>{{ $blog->category_name }}</span></a>
                                        </div>
                                        <h5>
                                            <a href="{{ route('blog-page.show', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                        </h5>
                                        @if (!empty($blog->short_desc)) <p>{{ $blog->short_desc }}</p> @endif
                                        <a href="{{ route('blog-page.show', ['slug' => $blog->slug]) }}" class="blog-link">
                                            {{ __('frontend.read_more') }}
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-xl-12">
                            {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </section>
    @else
        <section id="latest-blog" class="section pb-minus-70">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        {{ __('frontend.updating') }}
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Blog Grid End -->

@endsection
