@check_permission_in_permissions(['index-teacher','index-experience','show-teacher'])
    <li class="menu single-menu {{
            request()->routeIs('admin.teacher.index') ||
            request()->routeIs('admin.teacher.show')||
            request()->routeIs('admin.experience.index')  ? 'active' : ''
        }}">
        
        <a href="#teacher" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle">
            <div class="">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>
                    {{ trans('main.teachers') }}
                </span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-down">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </a>
        <ul class="collapse submenu list-unstyled {{
                request()->routeIs('admin.teacher.index') ||
                request()->routeIs('admin.teacher.show')||
                request()->routeIs('admin.experience.index')  ? 'show' : ''
                }}" id="teacher" data-parent="#topAccordion">
            @check_permission("index-teacher")
            <li class="{{
                                request()->routeIs('admin.teacher.index')  ? 'active' : ''
                            }}">
                <a href="{{ route('admin.teacher.index') }}">
                    {{ trans('main.teachers') }}
                </a>
            </li>
            @endcheck_permission
            @check_permission("index-experience")
            <li class="{{
                                request()->routeIs('admin.experience.index')  ? 'active' : ''
                            }}">
                <a href="{{ route('admin.experience.index') }}">
                    {{ trans('main.experiences') }}
                </a>
            </li>
            @endcheck_permission
        </ul>
    </li>
@endcheck_permission_in_permissions