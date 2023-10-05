<!DOCTYPE html>
<html lang="en">

<head>
      <title>Document</title>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
            integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

      <link rel="stylesheet" href="{{ asset('fonts/heebo/heebo.css') }}">

      @if(LaravelLocalization::getCurrentLocale() == 'ar')
            <link rel="stylesheet" href="{{ asset('css/siteRtl/main.css') }}">
      @else
            <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">
      @endif

      <link rel="stylesheet" href="{{ asset('css/site/nav.css') }}">
      <link rel="stylesheet" href="{{ asset('css/site/about.css') }}">
      <link rel="stylesheet" href="{{ asset('css/site/courses.css') }}">
      <link rel="stylesheet" href="{{ asset('css/site/footer.css') }}">

      @stack('css')
</head>

<body>
      <div class="main-top">
            <nav>
                  <div>
                        <img class="logo" src="{{ $setting->logo }}" alt="">
                  </div>

                  <ul>
                        <li>
                              <a href="{{ route('home.index') }}">{{ trans('main.home') }}</a>
                        </li>
                        <li>
                              <a href="{{route('courses.index')}}">{{ trans('main.courses') }}</a>
                        </li>
                        <li>
                              <a href="{{ route('about.index') }}">{{ trans('main.about') }}</a>
                        </li>
                        <li>
                              <a href="{{route('pricing.index')}}">{{ trans('main.pricing') }}</a>
                        </li>
                        <li class="dropdown lang" data-dropdown>

                              <img class="link" data-dropdown-button src="{{asset('adminAssets/assets/img/' . getFlag(LaravelLocalization::getCurrentLocale()))}}" alt="">

                              <div class="dropdown-menu">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="dropdown-item" data-img-value="ca" data-value="en"
                                          href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><img
                                                src="{{ asset('adminAssets/assets/img/'. getFlag($localeCode)) }}" class="flag-width"
                                                alt="flag alternate" hreflang="{{ $localeCode }}">
                                          {{ $properties['native'] }}</a>
                                    @endforeach
                              </div>
                        </li>

                        <div class="close-btn">
                              <i class="fa-solid fa-xmark"></i>
                        </div>
                  </ul>

                  <div class="burger">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                  </div>
                  <div class="nav-blanket"></div>
            </nav>


            @yield('header')


      </div>


      @yield('content')


      <footer>
            <div class="top text-center">
                  <h2>Newsletter</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                        sed do eiusmod tempor incididunt ut labore et</p>
                  <form action="">
                        <div>
                              <input type="text" class="input" placeholder="your email">
                        </div>
                        <div class="buttons">
                              <button class="btn-blue">
                                    send email
                              </button>
                        </div>
                  </form>
            </div>
            <div class="bot main-top">
                  <div class="logo">
                        <img src="{{ asset('images/site/logo.png') }}" alt="">
                  </div>
                  <div class="copyright">
                        Copyright © E-MAD
                  </div>
                  <div class="social text-center">
                        <div class="icon">
                              <i class="fa-brands fa-facebook-f"></i>
                        </div>
                        <div class="icon">
                              <i class="fa-brands fa-twitter"></i>
                        </div>
                        <div class="icon">
                              <i class="fa-brands fa-youtube"></i>
                        </div>
                        <div class="icon">
                              <i class="fa-brands fa-instagram"></i>
                        </div>
                  </div>
            </div>
      </footer>


      <script src="{{ asset('js/site/shared/nav.js') }}"></script>
      <script src="{{ asset('js/site/index/index.js') }}"></script>
</body>

</html>
