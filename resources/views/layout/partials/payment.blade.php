@check_permission_in_permissions(['index-payment','create-payment'])
    <li class="menu single-menu {{  
            request()->routeIs('admin.payment.index')||
            request()->routeIs('admin.payment.create')  ? 'active' : ''
        }}">
        <a href="#payment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        class="css-i6dzq1">
                    <rect x="1" y="4" width="22" height="16" rx="2"
                            ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                <span>
                    {{trans('main.payment')}}
                </span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-down">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </a>
        <ul class="collapse submenu list-unstyled {{
                request()->routeIs('admin.payment.index')||
                request()->routeIs('admin.payment.create')  ? 'show' : ''
            }}" id="payment" data-parent="#topAccordion">

            @check_permission("index-payment")
            <li class="{{request()->routeIs('admin.payment.index')? 'active' : ''}}">
                <a href="{{ route('admin.payment.index') }}">
                    {{trans('main.payment')}}
                </a>
            </li>
            @endcheck_permission

            @check_permission("create-payment")
            <li class="{{request()->routeIs('admin.payment.create')? 'active' : ''}}">
                <a href="{{ route('admin.payment.create') }}">
                    {{trans('payment.create_payments')}}
                </a>
            </li>
            @endcheck_permission
        </ul>
    </li>
@endcheck_permission_in_permissions