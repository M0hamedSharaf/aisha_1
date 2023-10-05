<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4 my-4">
      <div class="card ">
            <div
                  class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
                  <h3 class="text-capitalize text-white">
                        {{ trans('group.group_students') }}
                        <span class="badge badge-pill badge-light">{{ $countStudents }}</span>
                  </h3>
                  <a class="icon text-white mt-2" data-toggle='modal' data-target='#creatGroupStudentModal'
                        data-href="{{ route('admin.group_students.getGroupStudents') }}"
                        id="creatGroupStudentModalInGroupShow" data-group_id="{{ $group->id }}">
                        <i class="fa-solid fa-pen-to-square fa-2xl"></i>
                  </a>
            </div>
            <div class="card-body">
                  <div class="user-info-list">
                        <div class="table-responsive group_show_card_scroll">
                              <table class="table table-bordered table-hover table-striped mb-4">
                                    <thead>
                                          <tr>
                                                <th class="text-secondary">{{ __('main.name') }}</th>
                                                <th class="text-secondary">{{ __('main.birthday') }}</th>
                                                <th class="text-secondary">{{ __('main.phone') }}</th>
                                                <th class="text-secondary">{{ __('main.delete') }}</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach ($group->groupStudents as $groupStudent)
                                                <tr role="row">
                                                      <td class="sorting_1 sorting_2">
                                                            <div class="d-flex">
                                                                  <div class="usr-img-frame mr-2 rounded-circle">
                                                                        @if ($groupStudent->student->avatar)
                                                                              <img alt="avatar"
                                                                                    class="img-fluid rounded-circle"
                                                                                    src="{{ $groupStudent->student->avatar }}">
                                                                        @else
                                                                              <img src="{{ asset('images/Spare.jpg') }}"
                                                                                    class="img-fluid rounded-circle"
                                                                                    class="avatar-image">
                                                                        @endif
                                                                  </div>
                                                                  <a
                                                                        href="{{ route('admin.student.show', $groupStudent->student->id) }}">
                                                                        <p
                                                                              class="align-self-center mb-0 admin-name text-primary">
                                                                              {{ $groupStudent->student->name }}</p>
                                                                  </a>
                                                            </div>
                                                      </td>
                                                      <td>{{ $groupStudent->student->birthday }}</td>
                                                      <td>{{ $groupStudent->student->phone }}</td>
                                                      <td>
                                                            <div>
                                                                  <x-delete-link :route="route(
                                                                      'admin.group_students.delete',
                                                                      $groupStudent->id,
                                                                  )" />
                                                            </div>
                                                      </td>
                                                </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>
      </div>
</div>
