<div class="modal fade" id="creatGroupTypeModal" tabindex="-1" role="dialog" aria-labelledby="creatGroupTypeModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light"
                    id="creatGroupTypeModal">
                    {{trans('group.create_group_type')}}
                </h5>
            </div>
            <div class="modal-body px-6">
                <form action="{{ route('admin.group_types.store') }}" method="post">
                    @csrf

                    <x-text name="name" :required="true" 
                            placeholder="{{trans('group.enter_the_group_type_name')}}" 
                            label="{{trans('group.group_name')}}" 
                            :value="old('name')"/>

                    <div class="row">
                        <div class="col-6">
                            <x-text name="days_num" 
                                    :required="true" 
                                    placeholder="{{trans('group.enter_the_number_of_group_days')}}" 
                                    label="{{trans('group.days_num') }}" 
                                    :value="old('days_num')"/>
                        </div>
                        <div class="col-6">
                            <x-text name="price" 
                                    :required="true" 
                                    placeholder="{{trans('group.enter_the_group_price')}}" 
                                    label="{{ trans('main.price') }}" 
                                    :value="old('price')"/>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-outline-dark">
                                {{ trans('main.save') }}
                        </button>

                        <button class="btn btn-outline-danger" data-dismiss="modal">
                            <i class="flaticon-cancel-12"></i>
                              {{ trans('main.discard') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
