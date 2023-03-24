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
                        <h1>{{ __('frontend.faqs') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.faqs') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!--// Faq Question Section Start //-->
    @if (count($faqs) > 0)
        <section class="section" id="faq-question">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="faq-accordion-wrap">
                            @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <div class="accordion-item-header" id="accordionHeader{{ $loop->index }}">
                                        <a href="javascript:void(0)" data-toggle="collapse" data-target="#accordionItem{{ $loop->index }}" aria-expanded="false" aria-controls="accordionItem{{ $loop->index }}" class="collapsed">
                                            <span>{{ $faq->question }}</span>
                                        </a>
                                    </div>
                                    <div id="accordionItem{{ $loop->index }}" class="collapse" aria-labelledby="accordionHeader{{ $loop->index }}" style="">
                                        <div class="accordion-body">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="section" id="faq-question">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="landing-section-heading">
                            <p>{{ __('frontend.updating') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--// Faq Question Section End //-->

@endsection
