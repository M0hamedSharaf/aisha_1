<div class="modal fade" id="creatGroupDayModal" tabindex="-1" role="dialog" aria-labelledby="creatGroupDayModal"
     aria-hidden="true" data-toggle="modal" data-href="{{ route('admin.group_day.getGroupDaysOfGroup') }}">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light" id="creatGroupDayModalTitle">
                   {{trans('group.create_group_days')}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.group_day.store') }}" method="post">
                    @csrf

                    <div class="row">
                        @if (!isset($group))
                            <div class="col-6">
                        @else
                            <div class="col-12">
                        @endif
                            <div class="form-group row mb-4">
                                <label for="day" class="col-xl-12 col-form-label text-dark font-weight-bold">
                                    {{trans('group.groups_days')}}
                                    <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control selectpicker" style="width: 100%;" name="day"
                                            id="day">
                                        <option value="Monday">
                                            {{trans('main.monday')}}
                                        </option>
        
                                        <option value="Tuesday">
                                            {{trans('main.tuesday')}}
                                        </option>
        
                                        <option value="Wednesday">
                                            {{trans('main.wednesday')}}
                                        </option>
        
                                        <option value="Thursday">
                                            {{trans('main.thursday')}}
                                        </option>
        
                                        <option value="Friday">
                                            {{trans('main.friday')}}
                                        </option>
        
                                        <option value="Saturday">
                                            {{trans('main.saturday')}}
                                        </option>
        
                                        <option value="Sunday">
                                            {{trans('main.sunday')}}
                                        </option>
        
                                    </select>
                                    @error('day')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        
                        <div class="col-6">
                            @if (!isset($group))
                            <div class="form-group row mb-4">
                                <label for="age_type" class="col-xl-12 col-form-label text-dark font-weight-bold">
                                   {{trans('group.choose_group')}}
                                    <i class="fa-solid fa-star-of-life required-star"></i>
                                </label>
                                <div class="col-xl-12">
                                    <select class="form-control basic group_days_create" 
                                            name="group_id"
                                            id="group_id" data-select2-id="group_days_create"
                                            data-href="{{ route('admin.group_day.getGroupDaysOfGroup') }}">
                                        <option value="">
                                            {{trans('group.choose_group')}}
                                            </option>
                                        @foreach ($groups as $group)
                                            @if (!$group->checkIfGroupExceededGroupDaysLimit())
    
                                                <option
                                                    value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                                    {{ $group->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('group_id')
                                    <p class="text-danger" data-href="{{ route('admin.group_day.getGroupDaysOfGroup') }}">
                                        {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="group_id" id="group_id" value="{{ $group->id }}"
                                   data-groupid="{{ $group->id }}">
                        @endif
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-time name="from_time" 
                            :required="true" 
                            id="from_time" 
                            label="{{trans('main.from')}}" 
                            :value="old('from_time')"/>
                        </div>
                        <div class="col-6">
                            <x-time name="to_time" 
                            :required="true" 
                            id="to_time" 
                            label="{{trans('main.to')}}" 
                            :value="old('to_time')"/>
                        </div>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-outline-dark">
                                {{trans('main.save')}}
                        </button>

                        <button class="btn btn-outline-danger" data-dismiss="modal">
                            <i class="flaticon-cancel-12"></i>
                            {{trans('main.discard')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
