<div class="modal fade" id="studentLessonModal" tabindex="-1" role="dialog" aria-labelledby="studentLessonModal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__header">
                <h5 class="modal-title font-weight-bold text-capitalize text-light" id="studentLessonModalTitle">{{ __('teacher.create teacher') }}</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>{{ trans('main.lesson') }}</th>
                                <th>{{ trans('lesson.from_chapter') }}</th>
                                <th>{{ trans('lesson.to_chapter') }}</th>
                                <th>{{ trans('lesson.from_page') }}</th>
                                <th>{{ trans('lesson.to_page') }}</th>
                                <th>{{ trans('main.rate') }}</th>
                                <th>{{ trans('main.finished') }}</th>
                            </tr>
                        </thead>
                        <tbody id="studentLessonTableBody">
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
