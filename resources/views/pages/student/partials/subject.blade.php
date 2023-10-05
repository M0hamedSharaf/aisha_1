<div class="modal fade" id="newLessonModal" tabindex="-1" role="dialog" aria-labelledby="newLessonModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLessonModal">
                    {{trans('student.add_a_new_lesson')}}
                </h5>
            </div>
            <div class="modal-body">
                <form method="post" id="newLessonForm">
                    @csrf
                    <input type="hidden" name="student_lesson_id" id="student_lesson_id">

                    <div class="row">
                        <div class="col">
                            <input class="text-dark form-control" id="from_chapter" name="from_chapter">
                        </div>
                        <div class="col">
                            <input class="text-dark form-control" id="to_chapter" name="to_chapter">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input class="text-dark form-control" id="from_page" name="from_page">
                        </div>
                        <div class="col">
                            <input class="text-dark form-control" id="to_page" name="to_page">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            {{trans('main.save')}}
                        </button>
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                            {{trans('main.discard')}}
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
