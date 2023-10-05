@check_permission_in_permissions(['index-student', 'show-student', 'note-studentIndex'])
    <li class="menu single-menu {{
        request()->routeIs('admin.student.index') ||
        request()->routeIs('admin.note.studentIndex') ||
        request()->routeIs('admin.student.show') ? 'active' : ''
        }}">
        <a href="#student" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle">
            <div class="">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>
                    {{trans('main.students')}}
                </span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-chevron-down">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </a>
        <ul class="collapse submenu list-unstyled {{
                request()->routeIs('admin.student.index') ||
                request()->routeIs('admin.note.studentIndex') ||
                request()->routeIs('admin.student.show') ? 'show' : ''
            }}" id="student" data-parent="#topAccordion">




            <li class="{{
                    request()->routeIs('admin.student.index')  ? 'active' : ''
                }}">

                <a href="{{ route('admin.student.index') }}"> 
                    {{trans('main.students')}}
                </a>
            </li>





            <li class="{{
                    request()->routeIs('admin.note.studentIndex')  ? 'active' : ''
                }}">

                <a href="{{ route('admin.note.studentIndex') }}">
                     {{trans('main.notes')}}
                 </a>
            </li>



        </ul>
    </li>
@endcheck_permission_in_permissions