<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4 my-4">
      <div class="card ">
            <div
                  class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
                  <h3 class="text-capitalize text-white">
                        {{ trans('group.groups_subject') }}
                        <span class="badge badge-pill badge-light">{{ $countSubjects }}</span>
                  </h3>
                  <a class="icon text-white mt-2" data-toggle='modal' data-target='#creatGroupSubjectModal'
                        data-href="{{ route('admin.group_subjects.getGroupSubjects') }}"
                        id="creatGroupSubjectModalInGroupShow" data-group_id="{{ $group->id }}">
                        <i class="fa-solid fa-pen-to-square fa-2xl"></i>
                  </a>
            </div>
            <div class="card-body">
                  <div class="user-info-list">
                        <div class="table-responsive group_show_card_scroll">
                              <table class="table table-bordered table-hover table-striped mb-4">
                                    <thead>
                                          <tr>
                                                <th class="text-secondary">{{ __('main.id') }}</th>
                                                <th class="text-secondary">{{ __('group.group_name') }}</th>
                                                <th class="text-secondary">
                                                      {{ trans('subject.pages_count') }}
                                                </th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach ($group->groupSubjects as $groupSubject)
                                                <tr role="row">
                                                      <td>{{ $groupSubject->id }}</td>
                                                      <td>{{ $groupSubject->subject->name }}</td>
                                                      <td>{{ $groupSubject->subject->pages_count }}</td>
                                                      <td>
                                                            <div>
                                                                  <x-delete-link :route="route(
                                                                      'admin.group_subjects.delete',
                                                                      $groupSubject->id,
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
