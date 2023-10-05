<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
                {{ __('group.groups_days') }}
                @if ($groupDaysCount < $groupTypeNumDays)
                    <span class="badge badge-pill badge-light">
                       {{ $groupDaysCount }}
                    </span>
               @else
                    <span class="badge badge-pill badge-light">
                      {{ $groupDaysCount }}
                    </span>
              @endif
            </h3>
            @if (!$group->checkIfGroupExceededGroupDaysLimit())
                    <a 
                    class="icon text-white mt-2"
                    data-toggle='modal' data-target='#creatGroupDayModal' data-href="{{ route('admin.group_day.getGroupDaysOfGroup') }}">
                    <i class="fa-solid fa-pen-to-square fa-2xl"></i>
                </a>
            @endif
        </div>
        <div class="card-body ">
            <div class="user-info-list overflow-hidden">
                <table id="zero-config" class="table table-hover dataTable">
                    <thead>
                        <tr role="row">
                            <th class="text-center text-secondary"> {{ trans('group.groups_days') }} </th>
                            <th class="text-center text-secondary">{{ trans('main.delete') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group->groupDays as $groupDay)
                            <tr role="row overflow-auto">
                                <td class="text-center text-dark">{{ $groupDay->day }}</td>
                                <td class="text-center">
                                    <div class="text-center">
                                        <x-delete-link :route="route('admin.group_day.delete', $groupDay->id)" />
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


