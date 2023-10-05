import { changePercentageBar, getLesson } from "./shared.js";
import { setBook } from "./shared.js";
export function handleLessonFinishedCheckbox()
{
    $('.lesson_finished_checkbox').on('change',function(){
        let lesson_finished_checkbox = this;
        let group_id = $(this).data('group-id');
        let lesson_id = $(this).data('lesson-id');
        let student_id = $(this).data('student-id');
        let chapters_count = $(this).data('chapters-count');
        let last_page_finished = $(this).data('last-page-finished');

        $.ajax({
            url: '/admin/student_lesson/ajaxStudentLessonFinished',
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

                
                changePercentageBar(mainParent, lesson_finished_checkbox.checked ? 100 : 0)


                mainParent.find('.studentFinishedChaptersCountElement').html(lesson_finished_checkbox.checked ? chapters_count : 0)
                mainParent.find('.studentLessonLastPageFinishedElement').html(lesson_finished_checkbox.checked ? last_page_finished : 0)



                mainParent.find('.openStudentLastPageFinishedElement').data('last-page-finished', lesson_finished_checkbox.checked ? last_page_finished : 0)

                Swal.fire(
                    'Success!1',
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


export function addNewLessonHandler(studentId, subject)
{
    let student_lesson_id = null;
    let group_id = null;
    let lesson_id = null;
    let mainParent = null;
    let lesson = null; 


    

    $('.newLessonButton').on('click',function(){
        setBook(subject, 7)

        $('#newLessonModal').modal('show')
        student_lesson_id = $(this).data('student-lesson-id')
        let last_page_finished = $(this).data('last-page-finished')
        let last_chapter_finished = $(this).data('last-chapter-finished')
        group_id = $(this).data('group-id')
        lesson_id = $(this).data('lesson-id')

        lesson = getLesson(subject.lessons, lesson_id)

        $('#newLessonForm #from_page').val(last_page_finished || lesson.from_page)
        $('#newLessonForm #from_chapter').val(last_chapter_finished || '0')

        mainParent = $(this).parent().parent().parent().parent()
    })

    $('#newLessonForm').submit(function(e){
        e.preventDefault()
        let from_chapter = $('#newLessonForm #from_chapter').val()
        let to_chapter = $('#newLessonForm #to_chapter').val()
        let from_page = $('#newLessonForm #from_page').val()
        let to_page = $('#newLessonForm #to_page').val()


        let url = $(this).data('url')

        $.ajax({
            url: url,
            type: "POST",
            data: {
               from_chapter,
               to_chapter,
               from_page,
               to_page,
               student_lesson_id,
               student_id: studentId,
               group_id,
               lesson_id
            },
            success: function(response) {
                $('#newLessonModal').modal('hide')
                if(response.status == 200)
                {
                    Swal.fire(
                        'Success!7',
                        `Finished Successfully !`,
                        'success',
                    )


                    mainParent.find('.newLessonContainerElement').removeClass('d-none')
                    mainParent.find('.nextLessonFromChapter').html(from_chapter)
                    mainParent.find('.nextLessonToChapter').html(to_chapter)
                    mainParent.find('.nextLessonFromPage').find('span').html(from_page)
                    mainParent.find('.nextLessonFromPage').data("last-page-finished", from_page)
                    mainParent.find('.nextLessonToPage').find('span').html(to_page)
                    mainParent.find('.nextLessonToPage').data("last-page-finished", to_page)


                    mainParent.find('.newLessonButton').addClass('d-none')
                    mainParent.find('.finishNewLessonButton').removeClass('d-none')
                    mainParent.find('.finishNewLessonButton').data('syllabi-id', response.syllabi.id)

                    mainParent.find('.newLessonButton').data('last-page-finished', response.syllabi.to_page)
                    mainParent.find('.newLessonButton').data('last-chapter-finished', response.syllabi.to_chapter)

                    mainParent.find('.newLessonRate').removeClass('d-none')

                    emptyNewLessonModal()
                }
                else if(response.status == 400)
                {
                    Swal.fire(
                        'Warning!',
                        `Student Didn't Finish The Last Lesson!`,
                        'warning',
                    )

                    emptyNewLessonModal()
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


function emptyNewLessonModal()
{
    $('#newLessonForm #from_chapter').val('')
    $('#newLessonForm #to_chapter').val('')
    $('#newLessonForm #from_page').val('')
    $('#newLessonForm #to_page').val('')
}


export function handleFinishNewLesson()
{
    $('.finishNewLessonButton').on('click',function(){
        let syllabi_id = $(this).data('syllabi-id')
        let mainParent = $(this).parent().parent().parent().parent()
        let rate = mainParent.find('.newLessonRate').val()

        $.ajax({
            url: "/admin/syllabus/finishNewLessonAjax/" + syllabi_id,
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

                    changePercentageBar(mainParent, response.studentLesson.percentage)

                    mainParent.find('.newLessonContainerElement').addClass('d-none')

                    mainParent.find('.newLessonButton').removeClass('d-none')
                    mainParent.find('.finishNewLessonButton').addClass('d-none')

                    mainParent.find('.studentLessonLastPageFinishedElement').html(response.studentLesson.last_page_finished)

                    mainParent.find('.studentFinishedChaptersCountElement').html(response.studentLesson.last_chapter_finished)

                    mainParent.find('.lesson_finished_checkbox').prop('checked', response.studentLesson.finished)

                    mainParent.find('.openStudentLastPageFinishedElement').data('last-page-finished',response.studentLesson.last_page_finished)

                    mainParent.find('.newLessonRate').addClass('d-none')


                    Swal.fire(
                        'Success!6',
                        `Finished Successfully !`,
                        'success',
                    )

                    
                }
                else if(response.status == 400)
                {
                    Swal.fire(
                        'Warning!',
                        `Student Has Finished That Lesson`,
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