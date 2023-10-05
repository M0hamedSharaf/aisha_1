
<div class="modal fade" id="newLessonModalReview" tabindex="-1" role="dialog" aria-labelledby="newLessonModalReview"
aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header card-header create__form__newReview">
                <h5 class="modal-title font-weight-bold text-capitalize text-light" id="newLessonModalReviewTitle">
                    {{trans('student.add_a_new_review')}}
                </h5>
            </div>
            <div class="modal-body">
                <form data-url="{{route('admin.syllabusReview.createNewLessonAjax')}}" method="post" id="newLessonFromReview">
                    
                    {{-- <input type="hidden" name="student_lesson_review_id" id="student_lesson_review_id"> --}}

                    <div class="row mb-3">
                        <div class="col">
                            <input class="text-dark form-control" 
                                    id="from_chapter" 
                                    name="from_chapter" 
                                    placeholder="{{trans('student.from_chapter')}}" 
                                    type="number">
                        </div>
                        <div class="col">
                            <input class="text-dark form-control" 
                                    id="to_chapter" 
                                    name="to_chapter" 
                                    placeholder="{{trans('student.to_chapter')}}" 
                                    type="number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input class="text-dark form-control" id="from_page" 
                            name="from_page" placeholder="{{trans('student.from_page')}}" type="number">
                        </div>
                        <div class="col">
                            <input class="text-dark form-control" id="to_page" 
                            name="to_page" placeholder="{{trans('student.to_page')}}" type="number">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-outline-primary">
                            {{trans('main.save')}}
                        </button>

                        <button class="btn btn-outline-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> 
                            {{trans('main.discard')}}
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>