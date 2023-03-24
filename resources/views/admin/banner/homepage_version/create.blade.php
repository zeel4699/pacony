@extends('layouts.admin.master')

@section('content')

    <!-- Include Alert Blade -->
    @include('admin.alert.alert')

    <!-- Form row -->
    <div class="row">
        <div class="col-xl-12 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">{{ __('content.homepage_versions') }}</h4>
                    <form action="{{ route('homepage-version.update', $homepage_version->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="hiddenradio">
                                    <label>
                                        <input type="radio" name="choose_version" value="home" {{ ($homepage_version->choose_version == "home")? "checked" : "" }}>
                                        <img class="img-fluid shadow" src="{{ asset('uploads/img/dummy/demo.png') }}" alt="version image">
                                    </label>
                                    <span>{{ __('content.fixed_content') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="hiddenradio">
                                    <label>
                                        <input type="radio" name="choose_version" value="home2" {{ ($homepage_version->choose_version == "home2")? "checked" : "" }}>
                                        <img class="img-fluid shadow" src="{{ asset('uploads/img/dummy/demo.png') }}" alt="light image">
                                    </label>
                                    <span>{{ __('content.sliders') }} </span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-20">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('content.submit') }}</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection