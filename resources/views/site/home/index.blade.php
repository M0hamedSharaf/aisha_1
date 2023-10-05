@extends('site.master')


@push('css')
      <link rel="stylesheet" href="{{ asset('css/site/index.css') }}">
@endpush


@section('header')
      <header>
            <div class="header-paragraph text-center">
                  <h2>{{$setting->welcome_text_1->{LaravelLocalization::getCurrentLocale()} }}</h2>
                  <h3>{{$setting->welcome_text_2->{LaravelLocalization::getCurrentLocale()} }}</h3>
                  <div class="btns-con">
                        <button class="btn-blue">{{$setting->welcome_btn_1->{LaravelLocalization::getCurrentLocale()} }}</button>
                        <button class="btn-blue">{{$setting->welcome_btn_2->{LaravelLocalization::getCurrentLocale()} }}</button>
                  </div>
            </div>
            <div class="header-image-con text-center">
                  <img src="{{ $setting->welcome_img }}" alt="">
            </div>
      </header>






      <section class="elementor-section text-center">

            @for ($i = 0; $i <= 3; $i++)
                  <div class="elementor-item">
                        <div class="img_back_ground" id="online">
                              <img src="{{ $elementors[$i]->img ?? '' }}" alt="">
                        </div>

                        <h2>
                              {{ $elementors[$i]->name->{LaravelLocalization::getCurrentLocale()} ?? '' }}
                        </h2>
                        <p>
                              {{ $elementors[$i]->desc->{LaravelLocalization::getCurrentLocale()} ?? '' }}
                        </p>
                  </div>
            @endfor
      </section>




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
                  <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                        sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris
                  </p>
            </div>
      </section>
@endsection


@section('content')
      <section class="process-section">
            <div class="process text-center">
                  <h5>process</h5>
                  <h3>How it work for all students</h3>
            </div>


            <div class="page-process elementor-section text-center">
                  @for ($i = 4; $i <= 6; $i++)
                        <div class="elementor-item">
                              <div class="img_back_ground" id="online">
                                    <img src="{{ $elementors[$i]->img ?? '' }}" alt="">
                              </div>

                              <h2>
                                    {{ $elementors[$i]->name->{LaravelLocalization::getCurrentLocale()} ?? '' }}
                              </h2>
                              <p>
                                    {{ $elementors[$i]->desc->{LaravelLocalization::getCurrentLocale()} ?? '' }}
                              </p>
                        </div>
                  @endfor

                  <div class="video">
                        <img src="{{asset('images/site/img-vido.png')}}">

                        <div class="icon-play">
                              <i class="fa-solid fa-play"></i>
                        </div>
                  </div>
                  <div class="blanket">
                        <iframe src="https://www.youtube.com/embed/7CLccP_tElk" title="YouTube video player" frameborder="0"
                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                              allowfullscreen></iframe>
                        <div class="close-btn">
                              <i class="fa-solid fa-xmark"></i>
                        </div>
                  </div>
            </div>



      </section>











      <div class="main-top">



            <div class="text-popular-mt">
                  <div>
                        <h5>Popular</h5>
                        <h3>A popular courses lately</h3>
                  </div>
                  <div>
                        <button class="btn-blue">see all</button>
                  </div>
            </div>

            <div class="courses">

                  <div class="course">
                        <div class="photo">
                              <img src="{{ asset('images/site/Graphic Design-img.png') }}" alt="">
                        </div>
                        <div class="text s_one">
                              <p>Graphic Design</p>
                        </div>
                        <div class="text">
                              <h4>Good and correct application of typography</h4>
                        </div>
                        <div class="stars">
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="text">
                              <h5>By: John Doe</h5>
                        </div>
                  </div>

                  <div class="course">
                        <div class="photo">
                              <img src="{{ asset('images/site/SEO2-img.png') }}" alt="">
                        </div>
                        <div class="text s_tow">
                              <p>SEO</p>
                        </div>
                        <div class="text">
                              <h4>Keyword Research Techniques and Tools</h4>
                        </div>
                        <div class="stars">
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="text">
                              <h5>By: John Doe</h5>
                        </div>
                  </div>

                  <div class="course">
                        <div class="photo">
                              <img src="{{ asset('images/site/Marketing-img.png') }}" alt="">
                        </div>
                        <div class="text s_three">
                              <p>Marketing</p>
                        </div>
                        <div class="text">
                              <h4>How do we increase sales quickly and what are the risks?
                              </h4>
                        </div>
                        <div class="stars">
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star active"></i>
                              <i class="fa-solid fa-star active"></i>
                        </div>
                        <div class="text">
                              <h5>By: John Doe</h5>
                        </div>
                  </div>
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




            <div class="course-categories-title text-center">
                  <h5>Courses</h5>
                  <h2>List of courses that you can take</h2>
            </div>

            <section>
                  <div class="course-categories text-center">
                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/background-img.png') }}" alt="">
                              </div>
                              <h3>Web Development With Design</h3>
                        </div>

                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/imgelementor-container2.png') }}">
                              </div>
                              <h3>Graphic Design & Animation</h3>
                        </div>

                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/img-elementor-container3.png') }}">
                              </div>
                              <h3>Sofware & Hardware Engineering</h3>
                        </div>

                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/img.elementor-container4.png') }}">
                              </div>
                              <h3>Online Marketing & SEO</h3>
                        </div>
                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/background-img.png') }}" alt="">
                              </div>
                              <h3>Web Development With Design</h3>
                        </div>

                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/imgelementor-container2.png') }}">
                              </div>
                              <h3>Graphic Design & Animation</h3>
                        </div>

                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/img-elementor-container3.png') }}">
                              </div>
                              <h3>Sofware & Hardware Engineering</h3>
                        </div>

                        <div class="course-category">
                              <div class="background-img">
                                    <img src="{{ asset('images/site/img.elementor-container4.png') }}">
                              </div>
                              <h3>Online Marketing & SEO</h3>
                        </div>
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
      </div>
@endsection
