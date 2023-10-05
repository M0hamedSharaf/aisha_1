<div class="modal fade" id="editElementorModal" tabindex="-1" role="dialog" aria-labelledby="editElementorModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title text-white" id="editElementorTitle">
                    {{trans('teacher.edite_teacher')}}
                </h5>
            </div>
            <div class="modal-body">
                <form id="editElementorForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-6">
                            <x-text name="name_en" 
                            :required="true" 
                            placeholder="{{trans('main.name_en')}}" 
                            label="{{trans('main.name_en')}}" />
                        </div>
                        <div class="col-6">
                            <x-text name="name_ar" 
                            :required="true" 
                            placeholder="{{trans('main.name_ar')}}" 
                            label="{{trans('main.name_ar')}}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <x-textarea name="desc_en" 
                            :required="false" 
                            label="{{trans('main.desc_en')}}" />
                        </div>
                        <div class="col-6">
                            <x-textarea name="desc_ar" 
                            :required="false" 
                            label="{{trans('main.desc_ar')}}" />
                        </div>
                    </div>

                    <div class="custom-file-container" data-upload-id="image_edit">
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
                                class="btn btn-outline-info">
                               {{trans('main.save')}}
                            </button>
                        <button class="btn btn-outline-dark" data-dismiss="modal">
                            <i class="flaticon-cancel-12"></i>
                           {{trans('main.discard')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
