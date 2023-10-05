<!DOCTYPE html>
<html lang="en">

<head>
      @if (LaravelLocalization::getCurrentLocale() == 'en')
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
            <title>{{trans('auth.AISHA Admin - Login Page')}}</title>
            <link rel="icon" type="image/x-icon" href="{{ asset('adminAssets/assets/img/favicon.ico') }}" />
            <link href="{{ asset('fonts/fonts_en.css') }}" rel="stylesheet">
            <link href="{{ asset('adminAssets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminAssets/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminAssets/assets/css/authentication/form-1.css') }}" rel="stylesheet"
                  type="text/css" />
            <link rel="stylesheet" type="text/css"
                  href="{{ asset('adminAssets/assets/css/forms/theme-checkbox-radio.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('adminAssets/assets/css/forms/switches.css') }}">
            <link href="{{ asset('adminAssets/plugins/font-icons/fontawesome/css/all.css') }}" rel="stylesheet"
                  type="text/css" />
            <link href="{{ asset('adminAssets/plugins/font-icons/fontawesome/webfonts/JF-Flat-regular.woff') }}"
                  rel="stylesheet" type="text/css" />
      @else
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
            <title>{{trans('auth.AISHA Admin - Login Page')}}</title>
            <link rel="icon" type="image/x-icon" href="{{ asset('adminRtl/assets/img/favicon.ico') }}" />
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="{{ asset('fonts/fonts_ar.css') }}" rel="stylesheet">
            <link href="{{ asset('adminRtl/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminRtl/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('adminRtl/assets/css/authentication/form-1.css') }}" rel="stylesheet"
                  type="text/css" />
            <!-- END GLOBAL MANDATORY STYLES -->
            <link rel="stylesheet" type="text/css"
                  href="{{ asset('adminRtl/assets/css/forms/theme-checkbox-radio.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('adminRtl/assets/css/forms/switches.css') }}">
            <link href="{{ asset('adminAssets/plugins/font-icons/fontawesome/css/all.css') }}" rel="stylesheet"
                  type="text/css" />
            <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
            <style>
                  body {
                        font-family: 'Cairo', sans-serif;
                  }
            </style>
      @endif
      <!--Start Font STYLES -->

</head>

<body class="form">

      <div class="form-container">
            <div class="form-form">
                  <div class="form-form-wrap">
                        <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="{{ asset('adminAssets/assets/img/' . getFlag(LaravelLocalization::getCurrentLocale())) }}"
                                    class="flag-width" alt="flag"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                              </svg></a>

                        <div class="dropdown-menu dropdown-menu-right animated fadeInUp"
                              aria-labelledby="customDropdown">
                              @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="dropdown-item" data-img-value="ca" data-value="en"
                                          href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><img
                                                src="{{ asset('adminAssets/assets/img/' . getFlag($localeCode)) }}"
                                                class="flag-width" alt="flag alternate" hreflang="{{ $localeCode }}">
                                          {{ $properties['native'] }}</a>
                              @endforeach
                        </div>
                        <div class="form-container">
                              <div class="form-content">

                                    <h1 class="">{{ trans('auth.login_to') }}:<a href="#"><span
                                                      class="brand-name">{{ trans('auth.educational_platform') }}</span></a></h1>
                                    <form class="text-left" method="POST" action="{{ route('login') }}">
                                          <div class="form">
                                                @csrf
                                                <div id="username-field" class="field-wrapper input">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-user">
                                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                            <circle cx="12" cy="7" r="4">
                                                            </circle>
                                                      </svg>
                                                      <input id="email" name="email" type="text"
                                                            class="form-control"
                                                            placeholder="{{ trans('auth.email') }}">
                                                </div>
                                                <div id="password-field" class="field-wrapper input mb-2">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-lock">
                                                            <rect x="3" y="11" width="18"
                                                                  height="11" rx="2" ry="2">
                                                            </rect>
                                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                      </svg>
                                                      <input id="password" name="password" type="password"
                                                            class="form-control"
                                                            placeholder="{{ trans('auth.password') }}">
                                                </div>
                                                <div class="field-wrapper terms_condition">
                                                      <div class="n-chk">
                                                            <label class="new-control ">
                                                                  {{-- <input type="checkbox" class="new-control-input"> --}}
                                                                  <span class="new-control-indicator">
                                                                  </span><span>
                                                                        <a href="javascript:void(0);">{{ trans('auth.choose_the_login_method') }}
                                                                              </a></span>
                                                            </label>
                                                            <select name="type" id="typeOfLogin"
                                                                  class="form-control p-0">

                                                                  <option value="admin">{{ trans('main.admin') }}</option>
                                                                  <option value="teacher">{{ trans('main.teacher') }}</option>
                                                                  <option value="student">{{ trans('main.student') }}</option>
                                                            </select>
                                                      </div>
                                                </div>
                                                <div class="d-sm-flex justify-content-between">
                                                      <div class="field-wrapper toggle-pass">
                                                            <p class="d-inline-block">{{ trans('auth.show_password') }}
                                                            </p>
                                                            <label class="switch s-primary">
                                                                  <input type="checkbox" id="toggle-password"
                                                                        class="d-none">
                                                                  <span class="slider round"></span>
                                                            </label>
                                                      </div>
                                                      <div class="field-wrapper">
                                                            <button type="submit" class="btn btn-primary"
                                                                  value="">{{ trans('auth.log_in') }}</button>
                                                      </div>
                                                </div>

                                          </div>
                                    </form>
                                    <p class="terms-conditions">© {{ trans('auth.2023_all_rights_reserved') }}. <a
                                                href="index.html">{{ trans('auth.educational_platform') }}</a> {{ trans('auth.is_a_product_of') }} <a
                                                href="javascript:void(0);">{{ trans('auth.educational_platform') }}</a>, <a
                                                href="javascript:void(0);">{{ trans('auth.privacy') }}</a>, {{ trans('auth.and') }} <a
                                                href="javascript:void(0);"> {{ trans('auth.terms') }}</a>.</p>

                              </div>
                        </div>
                  </div>
            </div>
            <div class="form-image">
                  <div class="l-image">
                  </div>
            </div>
      </div>


      <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
      <script src="{{ asset('adminAssets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
      <script src="{{ asset('adminAssets/bootstrap/js/popper.min.js') }}"></script>
      <script src="{{ asset('adminAssets/bootstrap/js/bootstrap.min.js') }}"></script>

      <!-- END GLOBAL MANDATORY SCRIPTS -->
      <script src="{{ asset('adminAssets/assets/js/authentication/form-1.js') }}"></script>

</body>

</html>
