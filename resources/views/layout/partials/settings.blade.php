@check_permission_in_permissions(['index-user','index-role'])

    <li class="menu single-menu {{
            request()->routeIs('admin.home') ||
            request()->routeIs('admin.user.index') ||
            request()->routeIs('admin.role.index') ||
            request()->routeIs('admin.role.edit') ? 'active' : ''
        }}">
        <a href="#dashboard" data-toggle="collapse" aria-expanded="true"
            class="dropdown-toggle autodroprown">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-home">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span class="font-weight-bold text-capitalize">
                  {{trans('main.settings')}}
                </span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-down">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </a>
        <ul class="collapse submenu list-unstyled {{
                request()->routeIs('admin.home') ||
                request()->routeIs('admin.user.index') ||
                request()->routeIs('admin.role.index') ||
                request()->routeIs('admin.setting.index') ||
                request()->routeIs('admin.elementor.index') ||
                request()->routeIs('admin.role.edit') ? 'show' : ''
            }}" id="dashboard" data-parent="#topAccordion">

            @check_permission("index-user")
            <li class="{{request()->routeIs('admin.user.index') ? 'active' : '' }}">
                <a href="{{route('admin.user.index')}}"
                    class="text-capitalize font-weight-bold">
                    {{trans('main.users')}}
                </a>
            </li>
            @endcheck_permission

            @check_permission("index-role")
            <li class="{{
                        request()->routeIs('admin.role.index') ||
                            request()->routeIs('admin.role.edit') ? 'active' : ''
                    }}">
                <a href="{{route('admin.role.index')}}"
                    class="text-capitalize font-weight-bold">
                    {{trans('main.roles')}}
                </a>
            </li>
            @endcheck_permission

            @check_permission("index-setting")
            <li class="{{ request()->routeIs('admin.setting.index') ? 'active' : '' }}">
                <a href="{{route('admin.setting.index')}}" class="text-capitalize font-weight-bold">
                    {{trans('main.settings')}}
                </a>
            </li>
            @endcheck_permission

            @check_permission("index-elementor")
            <li class="{{ request()->routeIs('admin.elementor.index') ? 'active' : '' }}">
                <a href="{{route('admin.elementor.index')}}" class="text-capitalize font-weight-bold">
                    {{trans('main.elementor')}}
                </a>
            </li>
            @endcheck_permission
        </ul>
    </li>
@endcheck_permission_in_permissions