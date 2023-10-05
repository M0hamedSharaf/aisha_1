<!--  BEGIN TOPBAR  -->
<div class="topbar-nav header navbar" role="banner">
    <nav id="topbar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('admin.home') }}">
                    <img src="{{ asset('images/home.jpg') }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="index.html" class="nav-link"> {{trans('main.home')}} </a>
            </li>
        </ul>

        <ul class="list-unstyled menu-categories" id="topAccordion">


            @include('layout.partials.settings')


            @include('layout.partials.teacher')


            @include('layout.partials.student')


            @include('layout.partials.group')


            @include('layout.partials.subject')


            @include('layout.partials.payment')


            {{-- @include('layout.partials.report') --}}



            {{-- @check_permission_in_permissions(['create-payment','create-payment'])
            <li class="menu single-menu {{
                                        request()->routeIs('admin.exam.index')||
                                     request()->routeIs('admin.exam.create')  ? 'active' : ''
                                }}">
                <a href="#exam"
                   data-toggle="collapse"
                   aria-expanded="false"
                   class="dropdown-toggle">

                    <div class="">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                             stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                             class="css-i6dzq1">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="12" y1="18" x2="12" y2="12"></line>
                            <line x1="9" y1="15" x2="15" y2="15"></line>
                        </svg>
                        <span>{{ __('global.Exams') }}</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="exam" data-parent="#topAccordion">

                    @check_permission("create-payment")
                    <li class="{{request()->routeIs('admin.exam.index')? 'active' : ''}}">
                        <a href="{{ route('admin.exam.index') }}">{{ __('global.Exams') }}</a>
                    </li>
                    @endcheck_permission

                    @check_permission("create-payment")
                    <li class="{{request()->routeIs('admin.exam.create')? 'active' : ''}}">
                        <a href="{{ route('admin.exam.create') }}">{{ __('global.Create Exam') }}</a>
                    </li>
                    @endcheck_permission
                </ul>
            </li>
            @endcheck_permission_in_permissions --}}


        </ul>
    </nav>
</div>
<!--  END TOPBAR  -->
