<div class="modal fade" id="addStudentLessonModal" tabindex="-1" role="dialog" aria-labelledby="addStudentLessonModal"
      aria-hidden="true" data-book="">
      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                  <div class="modal-header card-header create__form__header">
                        <h5 class="modal-title font-weight-bold text-capitalize text-light"
                              id="addStudentLessonModalTitle">{{ trans('lesson.add_a_lesson') }}</h5>
                        <a class="icon text-white showBookBtn" id="showBookBtn">
                              <i class="fa-solid fa-book-open fa-2xl"></i>
                              <h6 class="text-capitalize text-white d-inline">{{ trans('subject.show_book') }}</h6>
                        </a>
                  </div>
                  <div class="modal-body">
                        <form id="addStudentLessonModalForm" method="post"
                              data-href="{{ route('admin.syllabus.createNewLesson') }}">
                              @csrf

                              <input type="hidden" name="group_id" id="group_id">
                              <input type="hidden" name="student_id" id="student_id">

                              <div class="row mb-5">
                                    <div class="col-6">
                                          <p>
                                                {{ trans('lesson.lesson_starts_from') }}
                                                <span class="badge bg-primary" id="lesson_from_page">0</span>
                                                {{ trans('lesson.lesson_ends_to') }}
                                                <span class="badge bg-primary" id="lesson_to_page">0</span>
                                          </p>
                                    </div>
                                    <div class="col-6">
                                          <p>
                                                {{ trans('lesson.chapters_count') }}
                                                <span class="badge bg-primary" id="lesson_chapters_count">0</span>
                                          </p>
                                    </div>
                              </div>

                              <div class="form-group">
                                    <label for="subject_id" class="text-capitalize font-weight-bold text-muted">
                                          {{ trans('main.subject') }}
                                          <i class="fa-solid fa-star-of-life required-star"></i>
                                    </label>
                                    <select class="form-control basic subject_create" name="subject_id" id="subject_id"
                                          data-select2-id="subject_create">
                                          <option value="">{{ trans('subject.choose_subject') }}</option>

                                    </select>
                                    @error('lesson')
                                          <p class="text-danger">{{ $message }}</p>
                                    @enderror
                              </div>

                              <div class="form-group">
                                    <label for="lesson_id" class="text-capitalize font-weight-bold text-muted">
                                          {{ trans('main.lesson') }}
                                          <i class="fa-solid fa-star-of-life required-star"></i>
                                    </label>
                                    <select class="form-control basic lesson_create" name="lesson_id" id="lesson_id"
                                          data-select2-id="lesson_create">
                                          <option value="">{{ trans('lesson.choose_lesson') }}</option>

                                    </select>
                                    @error('lesson')
                                          <p class="text-danger">{{ $message }}</p>
                                    @enderror
                              </div>



                              <div class="row">
                                    <div class="col-6">
                                          <x-number name="from_chapter" :required="true" placeholder="{{trans('lesson.from_chapter')}}"
                                                label="{{trans('lesson.from_chapter')}}" :value="old('from_chapter')" />
                                    </div>
                                    <div class="col-6">
                                          <x-number name="to_chapter" :required="true" placeholder="{{trans('lesson.to_chapter')}}"
                                                label="{{trans('lesson.to_chapter')}}" :value="old('to_chapter')" />
                                    </div>
                              </div>

                              <div class="row">
                                    <div class="col-6">
                                          <x-number name="from_page" :required="true" placeholder="{{trans('lesson.from_page')}}"
                                                label="{{trans('lesson.from_page')}}" :value="old('from_page')" />
                                    </div>
                                    <div class="col-6">
                                          <x-number name="to_page" :required="true" placeholder="{{trans('lesson.to_page')}}"
                                                label="{{trans('lesson.to_page')}}" :value="old('to_page')" />
                                    </div>
                              </div>



                              <div class="modal-footer">
                                    <button type="submit"
                                          class="btn btn-outline-dark">{{ __('main.save') }}</button>
                                    <button class="btn btn-outline-danger" data-dismiss="modal"><i
                                                class="flaticon-cancel-12"></i>{{ __('main.discard') }}</button>
                              </div>

                        </form>
                  </div>

            </div>
      </div>
</div>
