@extends('site.master')

@push('css')
      <link rel="stylesheet" href="{{ asset('css/site/header.css') }}">
@endpush

@section('content')
    <div class="header">
        <h2>Courses</h2>
    </div>




    <div class="main-top">
        <div class="text-popular">
            <div class="adress">
                <h5>Popular</h5>
                <h3>A popular courses lately</h3>
            </div>
        </div>
        <div class="courses">

            <div class="course">

                <div class="photo">
                    <img src="{{asset('images/site/Graphic Design-img.png')}}" alt="">
                </div>
                <div class="text s_one">
                    <p>Graphic Design</p>
                </div>
                <div class="text">
                    <h4>Good and correct application of typography</h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/SEO-img.png')}}" alt="">
                </div>
                <div class="text s_tow">
                    <p>SEO</p>
                </div>
                <div class="text">
                    <h4>Keyword Research Techniques and Tools</h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/Marketing-img.png')}}" alt="">
                </div>
                <div class="text s_three">
                    <p>Marketing</p>
                </div>
                <div class="text">
                    <h4>How do we increase sales quickly and what are the risks?
                    </h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/Animation-img.png')}}" alt="">
                </div>
                <div class="text s_one">
                    <p>Animation</p>
                </div>
                <div class="text">
                    <h4>15 easy title motion graphics techniques
                    </h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/Software & Hardware-img.png')}}" alt="">
                </div>
                <div class="text s_tow">
                    <p>Software & Hardware</p>
                </div>
                <div class="text">
                    <h4>How to improve software & hardware performance
                    </h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/Data Science-img.png')}}" alt="">
                </div>
                <div class="text s_three">
                    <p>Data Science</p>
                </div>
                <div class="text">
                    <h4>Applied Data Science with lorem ipsum dolor sit amet
                    </h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/Marketing2-img.png')}}" alt="">
                </div>
                <div class="text s_one">
                    <p>Marketing</p>
                </div>
                <div class="text">
                    <h4>How do we increase sales quickly and what are the risks?
                    </h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/Web Developemnt-img.png')}}" alt="">
                </div>
                <div class="text s_tow">
                    <p>Web Developemnt</p>
                </div>
                <div class="text">
                    <h4>Speed up website performance for large companies
                    </h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
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
                    <img src="{{asset('images/site/SEO2-img.png')}}" alt="">
                </div>
                <div class="text s_three">
                    <p>SEO</p>
                </div>
                <div class="text">
                    <h4>Keyword Research Techniques and Tools
                    </h4>
                </div>
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
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
    </div>


    
@endsection
