@extends('site.master')

@push('css')
      <link rel="stylesheet" href="{{ asset('css/site/header.css') }}">
      <link rel="stylesheet" href="{{ asset('css/site/pricing.css') }}">
@endpush

@section('content')
    <div class="header">
        <h2>pricing</h2>
    </div>


    <div class="main-top">
        <section class="prices-section">
            <div class="text-popular">
                <h5>
                    pricing
                </h5>
                <h3>
                    Choose Price
                </h3>
            </div>
            <div class="prices text-center">
                <div class="price">
                    <h3>
                        Free
                    </h3>
                    <p class="price-value">
                        $0.00
                    </p>
                    <p class="desc">
                        Lorem ipum dolor sit amet. consectetur
                        adipisicing elit .sed do elusmod tempor
                        incididunt ut labore et
                    </p>
                    <div class="button">
                        <button class="btn-blue">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="price standard">
                    <h3>
                        Standard
                    </h3>
                    <p class="price-value">
                        $50.00
                    </p>
                    <p class="desc">
                        Lorem ipum dolor sit amet. consectetur
                        adipisicing elit .sed do elusmod tempor
                        incididunt ut labore et
                    </p>
                    <div class="button">
                        <button class="btn-blue">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="price">
                    <h3>
                        Premium
                    </h3>
                    <p class="price-value">
                        $90.00
                    </p>
                    <p class="desc">
                        Lorem ipum dolor sit amet. consectetur
                        adipisicing elit .sed do elusmod tempor
                        incididunt ut labore et
                    </p>
                    <div class="button">
                        <button class="btn-blue">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

   

    
@endsection
