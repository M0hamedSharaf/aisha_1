import { changePercentageBar } from "./shared.js";

export function handleLessonReviewFinishedCheckbox()
{
    $('.lesson_finished_checkbox_review').on('change',function(){
        let lesson_finished_checkbox = this;
        let group_id = $(this).data('group-id');
        let lesson_id = $(this).data('lesson-id');
        let student_id = $(this).data('student-id');
        let chapters_count = $(this).data('chapters-count');
        let last_page_finished = $(this).data('last-page-finished');


        $.ajax({
            url: '/admin/student_lesson_review/ajaxStudentLessonFinishedReview',
            type: 'POST',
            data: {
                group_id: group_id,
                lesson_id: lesson_id,
                student_id: student_id,
                finished: lesson_finished_checkbox.checked,
                chapters_count: chapters_count,
                last_page_finished: last_page_finished,
            },
            success: function(response) {
                let mainParent = $(lesson_finished_checkbox).parent().parent().parent()

                changePercentageBar(mainParent,lesson_finished_checkbox.checked ? 100 : 0)

                mainParent.find('.studentFinishedChaptersCountElement').html(lesson_finished_checkbox.checked ? chapters_count : 0)
                mainParent.find('.studentLessonLastPageFinishedElement').html(lesson_finished_checkbox.checked ? last_page_finished : 0)

                mainParent.find('.openStudentLastPageFinishedElementReview').data('last-page-finished',lesson_finished_checkbox.checked ? last_page_finished : 0)

                Swal.fire(
                    'Success!3',
                    `Finished Successfully !`,
                    'success',
                )
            },
            error: function(res) {
                Swal.fire(
                    'Error!',
                    `There Was an Error !`,
                    'error',
                )
                console.log(res);
            }
        })
    })
}


export function addNewLessonReviewHandler(studentId , subject)
{
    let student_lesson_review_id = null;
    let group_review_id = null;
    let lesson_review_id = null;
    let mainParent_review = null;

    $('.newLessonButtonReview').on('click',function(){
        $('#newLessonModalReview').modal('show')
        student_lesson_review_id = $(this).data('student-lesson-review-id')
        let last_page_finished_review = $(this).data('last-page-finished-review')
        let last_chapter_finished_review = $(this).data('last-chapter-finished-review')
        group_review_id = $(this).data('group-id')
        lesson_review_id = $(this).data('lesson-id')

        $('#newLessonFromReview #from_page').val(last_page_finished_review || '')
        $('#newLessonFromReview #from_chapter').val(last_chapter_finished_review || 0)

        mainParent_review = $(this).parent().parent().parent().parent()
    })


    $('#newLessonFromReview').submit(function(e){
        e.preventDefault()
        let from_chapter = $('#newLessonFromReview #from_chapter').val()
        let to_chapter = $('#newLessonFromReview #to_chapter').val()
        let from_page = $('#newLessonFromReview #from_page').val()
        let to_page = $('#newLessonFromReview #to_page').val()


        let url = $(this).data('url')

        $.ajax({
            url: url,
            type: "POST",
            data: {
               from_chapter,
               to_chapter,
               from_page,
               to_page,
               student_lesson_review_id,
               student_id: studentId,
               group_id: group_review_id,
               lesson_id: lesson_review_id
            },
            success: function(response) {
                $('#newLessonModalReview').modal('hide')
                if(response.status == 200)
                {
                    Swal.fire(
                        'Success!8',
                        `Finished Successfully !`,
                        'success',
                    )
                    mainParent_review.find('.newLessonContainerElementReview').removeClass('d-none')
                    mainParent_review.find('.nextLessonFromChapterReview').html(from_chapter)
                    mainParent_review.find('.nextLessonToChapterReview').html(to_chapter)
                    mainParent_review.find('.nextLessonFromPageReview').find('span').html(from_page)
                    mainParent_review.find('.nextLessonFromPageReview').data("last-page-finished", from_page)
                    mainParent_review.find('.nextLessonToPageReview').find('span').html(to_page)
                    mainParent_review.find('.nextLessonToPageReview').data("last-page-finished", to_page)


                    mainParent_review.find('.newLessonButtonReview').addClass('d-none')
                    mainParent_review.find('.finishNewLessonButtonReview').removeClass('d-none')
                    mainParent_review.find('.finishNewLessonButtonReview').data('syllabi-review-id', response.syllabusReview.id)

                    mainParent_review.find('.newLessonButtonReview').data('last-page-finished-review', response.syllabusReview.to_page)
                    mainParent_review.find('.newLessonButtonReview').data('last-chapter-finished-review', response.syllabusReview.to_chapter)

                    mainParent_review.find('.newLessonRateReview').removeClass('d-none')

                    emptyNewLessonModalReview()
                }
                else if(response.status == 400)
                {
                    Swal.fire(
                        'Warning!',
                        `Student Didn't Finish The Last Review Lesson!`,
                        'warning',
                    )

                    emptyNewLessonModalReview()
                }
            },
            error: function(res) {
                let errors = '';

                res.responseJSON.errors.forEach(errorArray => {
                    errors += `
                        <p class="text-danger py-1"> ${errorArray[0]} </p>
                        <hr>
                    `
                });
                Swal.fire(
                    'Error!',
                    `${errors}`,
                    'error',
                )
            }
        })
    })
}

function emptyNewLessonModalReview()
{
    $('#newLessonFromReview #from_chapter').val('')
    $('#newLessonFromReview #to_chapter').val('')
    $('#newLessonFromReview #from_page').val('')
    $('#newLessonFromReview #to_page').val('')
}

export function handleFinishNewLessonReview()
{
    $('.finishNewLessonButtonReview').on('click',function(){
        let syllabi_review_id = $(this).data('syllabi-review-id')
        let mainParent = $(this).parent().parent().parent().parent()
        let rate = mainParent.find('.newLessonRateReview').val()

        $.ajax({
            url: "/admin/syllabus-review/finishNewLessonReviewAjax/" + syllabi_review_id,
            type: "POST",
            data: {
            rate: rate
            },
            success: function(response) {
                if(response.status == 200)
                {
                    if(rate == "fail")
                    {
                        location.reload();
                        return;
                    }
                    mainParent.find('.newLessonContainerElementReview').addClass('d-none')

                    mainParent.find('.newLessonButtonReview').removeClass('d-none')
                    mainParent.find('.finishNewLessonButtonReview').addClass('d-none')

                    mainParent.find('.studentLessonLastPageFinishedElementReview').html(response.studentLessonReview.last_page_finished)

                    mainParent.find('.StudentFinishedChaptersCountElementReview').html(response.studentLessonReview.last_chapter_finished)

                    mainParent.find('.lesson_finished_checkbox_review').prop('checked', response.studentLessonReview.finished)

                    mainParent.find('.openStudentLastPageFinishedElement').data('last-page-finished',response.studentLessonReview.last_page_finished)

                    mainParent.find('.newLessonRateReview').addClass('d-none')

                    changePercentageBar(mainParent, response.studentLessonReview.percentage)

                    Swal.fire(
                        'Success!5',
                        `Finished Successfully !`,
                        'success',
                    )
                }
                else if(response.status == 400)
                {
                    Swal.fire(
                        'Warning!',
                        `The Student Did't F`,
                        'warning',
                    )
                }
            },
            error: function(res) {
                Swal.fire(
                    'Error!',
                    `There Was an Error !`,
                    'error',
                )
                console.log(res);
            }
        })
    })
}