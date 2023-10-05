      <!-- Left Panel -->
      <aside id="left-panel" class="left-panel">
          <nav class="navbar navbar-expand-sm navbar-default">
              <div id="main-menu" class="main-menu collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                      <li class="active">
                          <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                      </li>
                      <li class="menu-title">UI elements</li><!-- /.menu-title -->

                      @if (request()->route()->getName() == 'admin.teacher.index' ||
                          request()->route()->getName() == 'admin.student.index' ||
                          request()->route()->getName() == 'admin.attend.index' ||
                          request()->route()->getName() == 'admin.examstudent.index' ||
                          request()->route()->getName() == 'admin.exam.index' ||
                          request()->route()->getName() == 'admin.group.index' ||
                          request()->route()->getName() == 'admin.lesson.index' ||
                          request()->route()->getName() == 'admin.user.index' ||
                          request()->route()->getName() == 'admin.Payment.index' ||
                          request()->route()->getName() == 'admin.teacher.create' ||
                          request()->route()->getName() == 'admin.student.create' ||
                          request()->route()->getName() == 'admin.attend.create' ||
                          request()->route()->getName() == 'admin.examstudent.create' ||
                          request()->route()->getName() == 'admin.exam.create' ||
                          request()->route()->getName() == 'admin.group.create' ||
                          request()->route()->getName() == 'admin.lesson.create' ||
                          request()->route()->getName() == 'admin.user.create' ||
                          request()->route()->getName() == 'admin.Payment.create' ||
                          request()->route()->getName() == 'admin.teacher.edit' ||
                          request()->route()->getName() == 'admin.student.edit' ||
                          request()->route()->getName() == 'admin.attend.edit' ||
                          request()->route()->getName() == 'admin.examstudent.edit' ||
                          request()->route()->getName() == 'admin.exam.edit' ||
                          request()->route()->getName() == 'admin.group.edit' ||
                          request()->route()->getName() == 'admin.lesson.edit' ||
                          request()->route()->getName() == 'admin.user.edit' ||
                          request()->route()->getName() == 'admin.Payment.edit')
                          <li class="menu-item-has-children dropdown open show">
                            
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-table mr-2"></i>
                              الجداول</a>
                              <ul class="sub-menu children dropdown-menu show">
                              @else
                                  <li class="menu-item-has-children dropdown open">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                          aria-expanded="false">
                                          </i><i class="fas fa-table mr-2"></i>الجداول</a>
                                      <ul class="sub-menu children dropdown-menu">
                      @endif
                      <li>
                       
                        <i class="fas fa-chalkboard-teacher"></i>
                          <a href="{{ route('admin.teacher.index') }}"
                              class="{{ request()->route()->getName() == 'admin.teacher.index' ||request()->route()->getName() == 'admin.teacher.create' ||request()->route()->getName() == 'admin.teacher.edit'? 'text-primary': '' }}">المُعلِّمين</a>
                      </li>
                      <li>
                        <i class="fas fa-user-graduate"></i>
                          <a href="{{ route('admin.student.index') }}"
                              class="{{ request()->route()->getName() == 'admin.student.index' ||request()->route()->getName() == 'admin.student.create' ||request()->route()->getName() == 'admin.student.edit'? 'text-primary': '' }}">الطلاب</a>
                      </li>
                      <li>
                        
                        <i class="fas fa-user"></i>
                          <a
                              href="{{ route('admin.user.index') }}
                          "class="{{ request()->route()->getName() == 'admin.user.index' ||request()->route()->getName() == 'admin.user.create' ||request()->route()->getName() == 'admin.user.edit'? 'text-primary': '' }}">المستخدمين</a>
                      </li>
                      <li>
                        <i class="fas fa-users"></i>
                          <a href="{{ route('admin.group.index') }}"
                              class="{{ request()->route()->getName() == 'admin.group.index' ||request()->route()->getName() == 'admin.group.create' ||request()->route()->getName() == 'admin.group.edit'? 'text-primary': '' }}">المجموعات</a>
                      </li>
                      <li>
                        <i class="fas fa-book-medical"></i>
                          <a href="{{ route('admin.exam.index') }}"
                              class="{{ request()->route()->getName() == 'admin.exam.index' ||request()->route()->getName() == 'admin.exam.create' ||request()->route()->getName() == 'admin.exam.edit'? 'text-primary': '' }}">الاختبارات</a>
                      </li>
                      <li>
                        <i class="fas fa-clipboard-user"></i>
                          <a href="{{ route('admin.attend.index') }}"
                              class="{{ request()->route()->getName() == 'admin.attend.index' ||request()->route()->getName() == 'admin.attend.create' ||request()->route()->getName() == 'admin.attend.edit'? 'text-primary': '' }}">الحضور</a>
                      </li>
                      <li>
                        <i class="far fa-money-bill-alt"></i>
                          <a href="{{ route('admin.Payment.index') }}"
                              class="{{ request()->route()->getName() == 'admin.Payment.index' ||request()->route()->getName() == 'admin.Payment.create' ||request()->route()->getName() == 'admin.Payment.edit'? 'text-primary': '' }}">المدفوعات</a>
                      </li>
                      <li>
                        <i class="fas fa-file-alt"></i>
                          <a href="{{ route('admin.examstudent.index') }}"
                              class="{{ request()->route()->getName() == 'admin.examstudent.index' ||request()->route()->getName() == 'admin.examstudent.create' ||request()->route()->getName() == 'admin.examstudent.edit'? 'text-primary': '' }}">إختبارات
                              الطلاب</a>
                      </li>
                      <li>
                        <i class="fas fa-address-card"></i>
                          <a href="{{ route('admin.lesson.index') }}"
                              class="{{ request()->route()->getName() == 'admin.lesson.index' ||request()->route()->getName() == 'admin.lesson.create' ||request()->route()->getName() == 'admin.lesson.edit'? 'text-primary': '' }}">
                              الدروس</a>
                      </li>
                  </ul>
                  </li>
                  </ul>
              </div><!-- /.navbar-collapse -->
          </nav>
      </aside>
      <!-- /#left-panel -->
