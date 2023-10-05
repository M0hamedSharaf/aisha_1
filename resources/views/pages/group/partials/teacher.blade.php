<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
               بيانات مدرس المجموعة
            </h3>
            <a 
            class="icon text-white mt-2 editTeacherButton" 
            data-toggle='modal' 
            data-target='#editTeacher'
            data-teacher="{{ $group->teacher }}"
            data-href="{{ route('admin.teacher.update',$group->teacher->id) }}">
            <i class="fa-solid fa-pen-to-square fa-2xl"></i>
         </a>
        </div>
        <div class="card-body"  >
            <div class="text-center user-info">
                <img src="{{ asset('adminAssets/assets/img/mother.png') }}" class="" alt="..." style="width: 200px">
                <h3 class="">{{ $group->teacher->name }}</h3>
            </div>
            <div class="user-info-list">
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">المؤهل</h6>
                        </th>
                        <td>
                            {{ $group->teacher->qualification }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">البريد الإلكتروني</h6>
                        </th>
                        <td> 
                            {{ $group->teacher->email }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">الهاتف</h6>
                        </th>
                        <td> 
                            {{  $group->teacher->phone }}
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                            <h6 class="text-secondary">تاريخ الميلاد</h6>
                        </th>
                        <td> 
                             {{$group->teacher->birthday }}
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


