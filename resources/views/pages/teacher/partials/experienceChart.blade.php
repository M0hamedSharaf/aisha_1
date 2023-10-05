<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 my-5">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center card__header__for_tables_show_teacher">
            <h3 class="text-capitalize text-white">
              {{trans('teacher.statistics_of_experience')}}
            </h3>
        </div>
        <div class="card-body"  >
            <div id="experiences_chart" data-href="{{route('admin.teacher.getExpereincesDataForChart', $teacher->id)}}">


                <div class="" id="experiencesChartCanva" style="position: relative;height: 500px;">
                </div>


            </div>
        </div>
    </div>
</div>