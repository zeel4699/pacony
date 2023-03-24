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
                        <h1>{{ __('frontend.demo_info') }}</h1>
                        <ul class="breadcrumb-links">
                            <li>
                                <a href="{{ url('/') }}">{{ __('frontend.home') }}</a>
                            </li>
                            <li class="active">
                                {{ __('frontend.demo_info') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// Breadcrumb Section end //-->

    <!--// About Section Start //-->
       @isset ($service)
           <section class="section" id="contact">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                           <div class="landing-a-inner">
                               <div class="demo-buttons">
                                   @if (!empty($service->demo_link))
                                       <a href="{{ $service->demo_link }}" class="demo-site-btn"><i class="fa fa-eye"></i> {{ __('frontend.demo_site') }}</a>
                                   @endif
                                   @if (!empty($service->demo_admin_link))
                                       <a href="{{ $service->demo_admin_link }}" class="demo-admin-btn"><i class="fa fa-cog"></i> {{ __('frontend.demo_panel') }}</a>
                                   @endif
                               </div>
                               <p>@php echo html_entity_decode($service->demo_other_info); @endphp</p>
                           </div>
                       </div>
                   </div>
               </div>
           </section>
           @else
           <section class="section" id="contact">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                           <div class="landing-a-inner">
                               <div class="demo-buttons">
                                   @if (!empty($software->demo_site_link))
                                       <a href="{{ $software->demo_site_link }}" class="demo-site-btn"><i class="fa fa-eye"></i> {{ __('frontend.demo_site') }}</a>
                                   @endif
                                   @if (!empty($software->demo_panel_link))
                                       <a href="{{ $software->demo_panel_link }}" class="demo-admin-btn"><i class="fa fa-cog"></i> {{ __('frontend.demo_panel') }}</a>
                                   @endif
                               </div>
                               <p>@php echo html_entity_decode($software->demo_other_info); @endphp</p>
                           </div>
                       </div>
                   </div>
               </div>
           </section>
           @endisset
    <!--// About Section End //-->

@endsection
