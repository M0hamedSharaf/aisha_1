<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
                {{trans('teacher.work_experiences')}}
            </h3>
            <a class="icon text-white creatTeacherExperienceButton"  type="button"
            data-toggle="modal"
            data-target='#creatExperienceModal'>
                <i class="fa-solid fa-plus fa-2xl"></i>
            </a>
        </div>
        <div class="card-body"  >
            <div class="table-responsive">
                <table class="table table-light table-bordered table-hover mb-4">
                    <thead>
                        <tr>
                            <th class="text-primary">{{trans('main.num')}}</th>
                            <th class="text-primary">{{trans('main.title')}}</th>
                            <th class="text-primary">{{trans('main.from')}}</th>
                            <th class="text-primary">{{trans('main.to')}}</th>
                            <th class="text-center text-success">
                                {{trans('main.edit')}}
                            </th>
                            <th class="text-center text-danger">
                                {{trans('main.delete')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="experience_Content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@include('pages.experience.createModal')

@include('pages.experience.editModal')
