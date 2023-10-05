<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
    <div class="card"  id="groupStudentsContainer"
         data-href="{{route('admin.student.getGroupStudents', $student)}}">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
             {{trans('main.subjects')}}
            </h3>
            <a class="icon text-white" id="showBookBtn">
                <i class="fa-solid fa-book-open fa-2xl"></i>
                <h6 class="text-capitalize text-white d-inline">
                    {{trans('subject.show_book')}}
                </h6>
            </a>
        </div>
        <div class="card-body "  >
          
        </div>
    </div>
</div>



