<div class="modal fade" id="creatElementorModal" tabindex="-1" role="dialog" aria-labelledby="creatElementorModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title text-white" id="creatElementorModal">
                    {{trans('site.create_elementor')}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.elementor.store') }}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="row">
                        <div class="col-6">
                            <x-text name="name_en" 
                            :required="true" 
                            placeholder="{{trans('main.name_en')}}" 
                            label="{{trans('main.name_en')}}"  
                            :value="old('name_en')"/>
                        </div>
                        <div class="col-6">
                            <x-text name="name_ar" 
                            :required="true" 
                            placeholder="{{trans('main.name_ar')}}" 
                            label="{{trans('main.name_ar')}}"  
                            :value="old('name_ar')"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-textarea name="desc_en" 
                            :required="true" 
                            placeholder="{{trans('main.desc_en')}}" 
                            label="{{trans('main.desc_en')}}"  
                            :value="old('desc_en')"/>
                        </div>
                        <div class="col-6">
                            <x-textarea name="desc_ar" 
                            :required="true" 
                            label="{{trans('main.desc_ar')}}"  
                            :value="old('desc_ar')"/>
                        </div>
                    </div>

                    <div class="custom-file-container" data-upload-id="image_create">
                        <label>
                            {{trans('main.image')}}
                            <a href="javascript:void(0)"
                                class="custom-file-container__image-clear"
                               title="Clear Image">

                            </a>
                        </label>
                        <label class="custom-file-container__custom-file">

                            <input type="file"
                                   class="custom-file-container__custom-file__custom-file-input"
                                accept="image/*"
                                   name="img">

                            <input type="hidden"
                                   name="MAX_FILE_SIZE"
                                   value="10485760" />

                            <span class="custom-file-container__custom-file__custom-file-control"></span>

                        </label>

                        <div class="custom-file-container__image-preview"></div>
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
