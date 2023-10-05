@extends('site.master')

@push('css')
      <link rel="stylesheet" href="{{ asset('css/site/header.css') }}">
@endpush

@section('content')
      <div class="header">
            <h2>about</h2>
      </div>




      <div class="main-top">
            <section class="about">
                  <div class="left">
                        <img src="{{ asset('images/site/about-img.png') }}" alt="">
                        <div class="legend">
                              <p>
                                    <span class="number">
                                          25
                                    </span>
                                    <span>Years of experience</span>
                                    <span class="number ml-1">
                                          150
                                    </span>
                                    <span>Best awards</span>
                              </p>
                        </div>
                  </div>
                  <div class="right">
                        <h5>Gotech</h5>
                        <h2>
                              Welcome to the gotech &
                              let's learn together
                        </h2>
                        <p class="gray">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                              sed do eiusmod tempor incididunt ut labore et
                              dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris
                        </p>
                  </div>
            </section>




            <section>
                  <div class="percentages text-center">
                        <div class="item">
                              <div class="item-img">
                                    <img src="{{ asset('images/site/about.png') }}" alt="">
                              </div>
                              <div class="item-par">
                                    <h2>250+</h2>
                                    <h4>Lessons</h4>
                              </div>
                        </div>
                        <div class="item">
                              <div class="item-img">
                                    <img src="{{ asset('images/site/about.png') }}" alt="">
                              </div>
                              <div class="item-par">
                                    <h2>95%</h2>
                                    <h4>Course Success</h4>
                              </div>
                        </div>
                        <div class="item">
                              <div class="item-img">
                                    <img src="{{ asset('images/site/about.png') }}" alt="">
                              </div>
                              <div class="item-par">
                                    <h2>550</h2>
                                    <h4>Clients</h4>
                              </div>
                        </div>
                        <div class="item">
                              <div class="item-img">
                                    <img src="{{ asset('images/site/about.png') }}" alt="">
                              </div>
                              <div class="item-par">
                                    <h2>210</h2>
                                    <h4>Speaker</h4>
                              </div>
                        </div>
                  </div>
            </section>



            <div class="main-top">

            </div>





            <div class="join-us-container">
                  <div class="join-us-row">
                        <div class="left">
                              <h2>Let's join now and get a
                                    special offer</h2>
                        </div>
                        <div class="right">
                              <button>let's join us</button>
                        </div>
                  </div>
            </div>
      </div>
@endsection
