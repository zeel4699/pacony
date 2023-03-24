@extends('layouts.frontend.master')

@section('content')

    <!--// Breadcrumb Section Start //-->
    <section class="breadcrumb-section section" data-scroll-index="1" @if (isset($breadcrumb))
    data-bg-image-path="{{ asset('uploads/img/general/'.$breadcrumb->breadcrumb_image) }}"
             @else data-bg-image-path="{{ asset('uploads/img/dummy/1920x750.jpg') }}"
            @endif>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb-inner">
                        <h1>{{ __('frontend.software') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.software') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!--// Product List Section Start //-->
    @if (count($softwares) > 0)
        <section class="section sidebar-wrapper padding-minus-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget-sidebar">
                            <div class="sidebar-widgets">
                                <h5 class="inner-header-title">{{ __('frontend.search') }}</h5>
                                <form action="{{ route('software-page.search') }}" method="POST">
                                    @csrf
                                    <div class="blog-search-bar position-relative">
                                        <input type="text" name="search" placeholder="{{ __('frontend.search_here') }}" class="search-form-control" required>
                                        <button type="submit" class="blog-search-btn"><span class="fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <div class="sidebar-widgets">
                                <h5 class="inner-header-title">{{ __('frontend.categories') }}</h5>
                                <ul class="sidebar-category-list clearfix">
                                    <li class="active"><a href="{{ route('software-page.index') }}">{{ __('frontend.all') }}</a></li>
                                @foreach ($software_count_categories as $software_count_category)
                                        <li>
                                            @if (isset($software_count_category->software_category->software_category_slug))
                                                <a href="{{ url('software/category/'.$software_count_category->software_category->software_category_slug) }}">{{$software_count_category->software_category->category_name }}<span class="category-count">({{ $software_count_category->category_count }})</span></a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            @foreach ($softwares as $software)
                                <div class="col-lg-6 col-md-6">
                                    <div class="product-list-item">
                                        <div class="product-img">
                                            <a href="{{ route('software-page.show', ['slug' => $software->software_slug]) }}">
                                                @if (!empty($software->software_image))
                                                    <img src="{{ asset('uploads/img/software/thumbnail1/'.$software->software_image) }}" alt="image" class="img-fluid">
                                                @else
                                                    <img src="{{ asset('uploads/img/dummy/310x160.jpg') }}" alt="image" class="img-fluid">
                                                @endif
                                            </a>
                                            <div class="product-buttons">
                                                <a href="{{ route('software-page.show', ['slug' => $software->software_slug]) }}"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            @php
                                                $str = $software->tag;
                                                $array_tags = explode(",", $str);
                                            @endphp
                                            @if ($str != null)
                                                @foreach ($array_tags as $tag)
                                                    <span>{{ $tag }} </span>
                                                @endforeach
                                            @endif
                                            <h5>
                                                <a href="{{ route('software-page.show', ['slug' => $software->software_slug]) }}">{{ $software->title }}</a>
                                            </h5>
                                            <h3>
                                                @if ($software->period == "monthly")

                                                    @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->monthly_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                                @elseif ($software->period == "annually")

                                                    @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->annually_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                                @else

                                                    @if ($currency_position == "left") <sup>{{ $currency_symbol }}</sup>{{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }} @else {{ number_format($software->onetime_price, $decimal_digit, $decimal_separator, $thousand_separator) }}<sup>{{ $currency_symbol }}</sup> @endif

                                                @endif
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            {{ $softwares->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="section sidebar-wrapper padding-minus-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                          {{ __('frontend.updating') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--// Product List Section End //-->

@endsection
