@check_permission_in_permissions(['index-subject','index-lesson'])
    <li class="menu single-menu {{
            request()->routeIs('admin.subject.index')||
            request()->routeIs('admin.lesson.index')  ? 'active' : ''
        }}">
        <a href="#subject" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        class="css-i6dzq1">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span>
                    {{trans('main.subjects')}}
                </span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-down">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </a>
        <ul class="collapse submenu list-unstyled {{
                request()->routeIs('admin.subject.index')||
                request()->routeIs('admin.lesson.index')  ? 'show' : ''
            }}" id="subject" data-parent="#topAccordion">
            @check_permission("index-subject")
            <li class="{{request()->routeIs('admin.subject.index')? 'active' : ''}}">
                <a href="{{ route('admin.subject.index') }}">
                    {{trans('main.subjects')}}
                    </a>
            </li>
            @endcheck_permission

            @check_permission("index-lesson")
            <li class="{{request()->routeIs('admin.lesson.index')? 'active' : ''}}">
                <a href="{{ route('admin.lesson.index') }}"> 
                    {{trans('main.lessons')}}
                </a>
            </li>
            @endcheck_permission
        </ul>
    </li>
@endcheck_permission_in_permissions