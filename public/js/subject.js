let groupStudentsContainer = $('#groupStudentsContainer')
let studentId = $('#studentProfileContainer').data('student-id')
let groupStudents = null
let subjects = null

function renderSubjectsInStudentsShow(){

    $.ajax({
        url: groupStudentsContainer.data('href'),
        success: function (response) {

            groupStudents = response.groupStudents
            subjects = response.subjects

            groupStudents.forEach(groupStudent => {
                groupStudentsContainer.append(`
                    <div id="groupStudentContainer${groupStudent.id}"></div>
                `)
                renderSubjectsForEachGroup(groupStudent)

            });
        },
        error: function () { }
    })
}


function renderSubjectsForEachGroup(groupStudent)
{
    let subjectsElements = ''
    let groupDaysElements = ''

    $(`#groupStudentContainer${groupStudent.id}`).html('')

    subjects.forEach(subject => {
        subjectsElements += `
            <div class="col-4 mb-4 subjectContainer${groupStudent.id}" data-subject-id="${subject.id}">
                <div class="card component-card_1" style="height:280px">
                    <div class="d-flex flex-column card-body justify-content-between">
                        <h5 class="card-title text-center">
                                ${subject.name}
                        </h5>
                        <img src="${subject.avatar}" alt=""
                            class="avatar-image rounded mx-auto d-block">
                        <div class="btn btn-primary rounded mx-auto d-block mt-2">
                            Lessson Count <span
                                class="badge badge-light">${subject.lessons.length}</span>
                        </div>
                    </div>
                </div>
            </div>
        `
    });

    groupStudent.group.group_days.forEach(groupDay => {
        groupDaysElements += `
            <span class="badge bg-info text-light">${groupDay.day}</span>
        `
    });

    $(`#groupStudentContainer${groupStudent.id}`).append(`
        <p class="text-center">

            <span class="badge bg-primary text-light">From</span>
            ${groupStudent.group.from} :
            <span class="badge bg-primary text-light">To</span>
            ${groupStudent.group.to}

            ${groupDaysElements}

        </p>

        <div class="row" id="subjectsContainer${groupStudent.id}" data-group-id="${groupStudent.group_id}">
            ${subjectsElements}
        </div>
    `)

    let subjectsContainer = $(`#subjectsContainer${groupStudent.id}`)


    $(`.subjectContainer${groupStudent.id}`).on('click',function(){


        let subject = getSubjectById($(this).data('subject-id'))
        let groupId = subjectsContainer.data('group-id')
        let lessonsElements = ''


        handleShowingOfTheBook(1 , subject)


        subject.lessons.forEach(lesson => {
            let studentLesson = lesson.student_lessons.filter(studentLesson => {
                return(studentLesson.student_id == studentId &&
                    studentLesson.group_id == groupId
                )
            })[0]



            let studentLessonShowURL = (studentLesson?.id || false) ? `/admin/student_lesson/show/${studentLesson.id}`:'#'

            let nextLesson = studentLesson?.syllabus.filter(syllabi => syllabi.finished == 0)[0]
            let studentFinishedChaptersCount = studentLesson ? studentLesson.last_chapter_finished : 0
            let studentFinishedChaptersPercentage = studentLesson ? studentLesson.percentage : 0
            let studentLessonIsFinished = studentLesson ? studentLesson.finished : false
            let studentLessonLastPageFinished = studentLesson ? studentLesson.last_page_finished : 0


            let studentLessonReview = studentLesson?.student_lesson_review

            let nextLessonReview = studentLessonReview?.syllabus_reviews.filter(syllabusReview => syllabusReview.finished == 0)[0]

            let studentFinishedChaptersCountReview = studentLessonReview ? studentLessonReview.last_chapter_finished : 0
            let studentFinishedChaptersPercentageReview = studentLessonReview ? studentLessonReview.percentage : 0
            let studentLessonIsFinishedReview = studentLessonReview ? studentLessonReview.finished : false
            let studentLessonLastPageFinishedReview = studentLessonReview ? studentLessonReview.last_page_finished : 0

            lessonsElements += `
                <div class="studentLessonMainContainer borderPrimary">
                    <div class="rotate-inner">


                        <div class="studentLessonContainer">
                            <button class="btn btn-success goToReviewButton">
                                Go To Review
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                            </button>

                            <h2 class="text-center text-primary my-5">${lesson.title}</h2>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <span>
                                    Lesson Is From Page : <span class="badge bg-primary">${lesson.from_page}</span>
                                    To Page : <span class="badge bg-primary">${lesson.to_page}</span>
                                </span>
                                <span>
                                    <a href="${studentLessonShowURL}" class="btn btn-outline-warning text-dark ${studentLessonShowURL == "#" ? 'd-none' : ''}" target="_blank">
                                        Show Progress
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between mb-3 align-items-center">
                                <span class="badge badge-success studentFinishedChaptersCountElement">
                                    ${studentFinishedChaptersCount}
                                </span>

                                <label class="switch s-icons s-outline  s-outline-success">
                                    <input
                                        type="checkbox"
                                        class="lesson_finished_checkbox"
                                        data-group-id="${groupId}"
                                        data-lesson-id="${lesson.id}"
                                        data-student-id="${studentId}"
                                        data-chapters-count="${lesson.chapters_count}"
                                        data-last-page-finished="${lesson.to_page}"
                                        ${studentLessonIsFinished ? 'checked' : ''}
                                    >
                                    <span class="slider"></span>
                                </label>

                                <span class="badge badge-secondary">
                                    ${lesson.chapters_count}
                                </span>
                            </div>

                            <a class="progressOfSubjectLink subject" data-toggle="modal" data-target="#createSubjectModal"
                                data-chapterscount="${lesson.chapters_count}"
                                data-finishedchapterscount="${studentFinishedChaptersCount}"
                                data-groupid="${groupId}" data-lessonid="${lesson.id}"
                                data-studentid="${studentId}">
                                <div class="progress br-30">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        aria-valuenow="${studentFinishedChaptersPercentage}"
                                        style="width:${studentFinishedChaptersPercentage}%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-title">
                                            <span class="progress-bar-percentage">
                                                ${studentFinishedChaptersPercentage}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>



                            <div class="row">
                                <div class="p-3 text-center col" style="font-size:1.5rem;">
                                    <div class="mb-4">
                                        Last Page Finished : <span class="badge bg-success studentLessonLastPageFinishedElement">${studentLessonLastPageFinished}</span>
                                        <span class="btn btn-outline-info openStudentLastPageFinishedElement" data-last-page-finished="${studentLessonLastPageFinished}">
                                            <i class="fa-solid fa-book-open"></i>
                                        </span>
                                    </div>

                                    <div class="${nextLesson ? '' : 'd-none'} newLessonContainerElement">
                                        <div class="mb-3">
                                            <span>
                                                <span>Next Lesson Is From Chapter</span>
                                                <span class="badge bg-info nextLessonFromChapter">
                                                    ${nextLesson?.from_chapter || 0}
                                                </span>
                                                <span>To Chapter</span>
                                                <span class="badge bg-info nextLessonToChapter">${nextLesson?.to_chapter || 0}</span>
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <span>
                                                <span>Next Lesson Is From Page</span>
                                                <span class="badge bg-info nextLessonFromPage" data-last-page-finished="${nextLesson?.from_page || null}">
                                                    <span>${nextLesson?.from_page || 0}</span>
                                                    <i class="fa-solid fa-book-open"></i>
                                                </span>
                                                <span>To Page</span>
                                                <span class="badge bg-info nextLessonToPage" data-last-page-finished="${nextLesson?.to_page || null}">
                                                    <span>${nextLesson?.to_page || 0}</span>
                                                    <i class="fa-solid fa-book-open"></i>
                                                </span>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control newLessonRate ${nextLesson ? '' : 'd-none'}">
                                            <option value="excellent"> excellent </option>
                                            <option value="very good"> very good </option>
                                            <option value="good"> good </option>
                                            <option value="fail"> fail </option>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary newLessonButton ${nextLesson ? 'd-none' : ''}" data-student-lesson-id="${studentLesson ? studentLesson.id : null}" data-group-id="${groupId}" data-lesson-id="${lesson.id}" data-last-page-finished="${studentLesson?.last_page_finished}" data-last-chapter-finished="${studentLesson?.last_chapter_finished}">New Lesson</button>

                                        <button class="btn btn-info finishNewLessonButton ${nextLesson ? '' : 'd-none'}" data-syllabi-id=${nextLesson?.id || null}>
                                            Finish New Lesson
                                            <i class="fa-solid fa-square-check"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>












                        <div class="studentLessonContainerReview">

                            <button class="btn btn-dark goToLessonButton">
                                Go To Lesson
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                            </button>

                            <h2 class="text-center text-success my-5">${lesson.title}</h2>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <span>
                                    Lesson Is From Page : <span class="badge bg-primary">${lesson.from_page}</span>
                                    To Page : <span class="badge bg-primary">${lesson.to_page}</span>
                                </span>
                                <span>
                                    <a href="${studentLessonShowURL}" class="btn btn-outline-warning text-dark ${studentLessonShowURL == "#" ? 'd-none' : ''}" target="_blank">
                                        Show Progress
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between mb-3 align-items-center">
                                <span class="badge badge-success StudentFinishedChaptersCountElementReview">
                                    ${studentFinishedChaptersCountReview}
                                </span>

                                <label class="switch s-icons s-outline  s-outline-success">
                                    <input
                                        type="checkbox"
                                        class="lesson_finished_checkbox_review"
                                        data-group-id="${groupId}"
                                        data-lesson-id="${lesson.id}"
                                        data-student-id="${studentId}"
                                        data-chapters-count="${lesson.chapters_count}"
                                        data-last-page-finished="${lesson.to_page}"
                                        ${studentLessonIsFinishedReview ? 'checked' : ''}
                                    >
                                    <span class="slider"></span>
                                </label>

                                <span class="badge badge-secondary">
                                    ${lesson.chapters_count}
                                </span>
                            </div>

                            <a class="progressOfSubjectLink subject" data-toggle="modal" data-target="#createSubjectModal"
                                data-chapterscount="${lesson.chapters_count}"
                                data-finishedchapterscount="${studentFinishedChaptersCountReview}"
                                data-groupid="${groupId}" data-lessonid="${lesson.id}"
                                data-studentid="${studentId}">
                                <div class="progress br-30">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        aria-valuenow="${studentFinishedChaptersPercentageReview}"
                                        style="width:${studentFinishedChaptersPercentageReview}%"
                                        aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-title">
                                            <span class="progress-bar-percentage">
                                                ${studentFinishedChaptersPercentageReview}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>



                            <div class="row">
                                <div class="p-3 text-center col" style="font-size:1.5rem;">
                                    <div class="mb-4">
                                        Last Page Finished : <span class="badge bg-success studentLessonLastPageFinishedElementReview">${studentLessonLastPageFinishedReview}</span>
                                        <span class="btn btn-outline-info openStudentLastPageFinishedElementReview" data-last-page-finished="${studentLessonLastPageFinishedReview}">
                                            <i class="fa-solid fa-book-open"></i>
                                        </span>
                                    </div>

                                    <div class="${nextLessonReview ? '' : 'd-none'} newLessonContainerElementReview">
                                        <div class="mb-3">
                                            <span>
                                                <span>Next Lesson Is From Chapter</span>
                                                <span class="badge bg-info nextLessonFromChapterReview">
                                                    ${nextLessonReview?.from_chapter || 0}
                                                </span>
                                                <span>To Chapter</span>
                                                <span class="badge bg-info nextLessonToChapterReview">${nextLessonReview?.to_chapter || 0}</span>
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <span>
                                                <span>Next Lesson Is From Page</span>
                                                <span class="badge bg-info nextLessonFromPageReview" data-last-page-finished="${nextLessonReview?.from_page || null}">
                                                    <span>${nextLessonReview?.from_page || 0}</span>
                                                    <i class="fa-solid fa-book-open"></i>
                                                </span>
                                                <span>To Page</span>
                                                <span class="badge bg-info nextLessonToPageReview" data-last-page-finished="${nextLessonReview?.to_page || null}">
                                                    <span>${nextLessonReview?.to_page || 0}</span>
                                                    <i class="fa-solid fa-book-open"></i>
                                                </span>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control newLessonRateReview ${nextLessonReview ? '' : 'd-none'}">
                                            <option value="excellent"> excellent </option>
                                            <option value="very good"> very good </option>
                                            <option value="good"> good </option>
                                            <option value="fail"> fail </option>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary newLessonButtonReview ${nextLessonReview ? 'd-none' : ''}" data-student-lesson-review-id="${studentLessonReview ? studentLessonReview.id : null}" data-group-id="${groupId}" data-lesson-id="${lesson.id}" data-last-page-finished-review="${studentLessonReview?.last_page_finished}" data-last-chapter-finished-review="${studentLessonReview?.last_chapter_finished}">New Lesson</button>

                                        <button class="btn btn-info finishNewLessonButtonReview ${nextLessonReview ? '' : 'd-none'}" data-syllabi-review-id=${nextLessonReview?.id || null}>
                                            Finish New Lesson
                                            <i class="fa-solid fa-square-check"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>






                </div>

            `


        });

        subjectsContainer.html('')

        subjectsContainer.html(`

            <div class="col-12">
                <button class="btn btn-info mb-4" id="backToSubjects${groupStudent.id}">
                    <i class="fa-solid fa-backward"></i>
                </button>
                ${lessonsElements}
            </div>
        `)

        $('.openStudentLastPageFinishedElement').on('click',function(){
            openPageFromTheBook(this, subject)
        })

        $('.openStudentLastPageFinishedElementReview').on('click',function(){
            openPageFromTheBook(this, subject)
        })

        $('.nextLessonFromPage').on('click',function(){
            openPageFromTheBook(this, subject)
        })

        $('.nextLessonFromPageReview').on('click',function(){
            openPageFromTheBook(this, subject)
        })

        $('.nextLessonToPage').on('click',function(){
            openPageFromTheBook(this, subject)
        })

        $('.nextLessonToPageReview').on('click',function(){
            openPageFromTheBook(this, subject)
        })

        // $('.nextReviewLessonFromPage').on('click',function(){
        //     openPageFromTheBook(this, subject)
        // })

        // $('.nextReviewLessonToPage').on('click',function(){
        //     openPageFromTheBook(this, subject)
        // })



        $('.goToReviewButton').on('click',function(){
            $(this).parent().parent().addClass('rotate-inner-active')
            $(this).parent().parent().parent().addClass('borderSuccess')
            $(this).parent().parent().parent().removeClass('borderPrimary')
        })

        $('.goToLessonButton').on('click',function(){
            $(this).parent().parent().removeClass('rotate-inner-active')
            $(this).parent().parent().parent().addClass('borderPrimary')
            $(this).parent().parent().parent().removeClass('borderSuccess')
        })

        studentLessonFinishedAjax()


        $(`#backToSubjects${groupStudent.id}`).on('click',function(){

            renderSubjectsInStudentsShow()

        })


    })
}


function studentLessonFinishedAjax()
{
    $('.lesson_finished_checkbox').on('change',function(){
        let lesson_finished_checkbox = this;
        let group_id = $(this).data('group-id');
        let lesson_id = $(this).data('lesson-id');
        let student_id = $(this).data('student-id');
        let chapters_count = $(this).data('chapters-count');
        let last_page_finished = $(this).data('last-page-finished');

        if (lesson_finished_checkbox.checked == true) {
            $.ajax({
                url: '/admin/student_lesson/ajaxStudentLessonFinished',
                data: {
                    group_id: group_id,
                    lesson_id: lesson_id,
                    student_id: student_id,
                    finished: true,
                    chapters_count: chapters_count,
                    last_page_finished: last_page_finished,
                },
                success: function(response) {
                    let mainParent = $(lesson_finished_checkbox).parent().parent().parent()

                    changePercentageBar(mainParent, 100)

                    mainParent.find('.studentFinishedChaptersCountElement').html(chapters_count)
                    mainParent.find('.studentLessonLastPageFinishedElement').html(last_page_finished)

                    mainParent.find('.openStudentLastPageFinishedElement').data('last-page-finished',last_page_finished)

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
        } else {
            $.ajax({
                url: '/admin/student_lesson/ajaxStudentLessonFinished',
                data: {
                    group_id: group_id,
                    lesson_id: lesson_id,
                    student_id: student_id,
                    finished: false,
                },
                success: function(response) {

                    let mainParent = $(lesson_finished_checkbox).parent().parent().parent()
                    changePercentageBar(mainParent, 0)

                    $('#newLessonForm #from_page').val(0)
                    $('#newLessonForm #from_chapter').val(0)

                    mainParent.find('.studentFinishedChaptersCountElement').html(0)
                    mainParent.find('.studentLessonLastPageFinishedElement').html(0)

                    mainParent.find('.openStudentLastPageFinishedElement').data('last-page-finished',0)

                    Swal.fire(
                        'Success!2',
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
        }
    })


    $('.lesson_finished_checkbox_review').on('change',function(){
        let lesson_finished_checkbox = this;
        let group_id = $(this).data('group-id');
        let lesson_id = $(this).data('lesson-id');
        let student_id = $(this).data('student-id');
        let chapters_count = $(this).data('chapters-count');
        let last_page_finished = $(this).data('last-page-finished');

        if (lesson_finished_checkbox.checked == true) {
            $.ajax({
                url: '/admin/student_lesson_review/ajaxStudentLessonFinishedReview',
                type: 'POST',
                data: {
                    group_id: group_id,
                    lesson_id: lesson_id,
                    student_id: student_id,
                    finished: true,
                    chapters_count: chapters_count,
                    last_page_finished: last_page_finished,
                },
                success: function(response) {
                    let mainParent = $(lesson_finished_checkbox).parent().parent().parent()

                    changePercentageBar(mainParent, 100)

                    mainParent.find('.studentFinishedChaptersCountElement').html(chapters_count)
                    mainParent.find('.studentLessonLastPageFinishedElement').html(last_page_finished)

                    mainParent.find('.openStudentLastPageFinishedElementReview').data('last-page-finished',last_page_finished)

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
        } else {
            $.ajax({
                url: '/admin/student_lesson_review/ajaxStudentLessonFinishedReview',
                type: 'POST',
                data: {
                    group_id: group_id,
                    lesson_id: lesson_id,
                    student_id: student_id,
                    finished: false,
                },
                success: function(response) {
                    let mainParent = $(lesson_finished_checkbox).parent().parent().parent()

                    changePercentageBar(mainParent, 0)
                    
                    Swal.fire(
                        'Success!4',
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
        }
    })



    addNewLessonHandler()




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
                    mainParent.find('.newLessonContainerElement').addClass('d-none')

                    mainParent.find('.newLessonButton').removeClass('d-none')
                    mainParent.find('.finishNewLessonButton').addClass('d-none')

                    mainParent.find('.studentLessonLastPageFinishedElement').html(response.studentLesson.last_page_finished)

                    mainParent.find('.studentFinishedChaptersCountElement').html(response.studentLesson.last_chapter_finished)

                    mainParent.find('.lesson_finished_checkbox').prop('checked', response.studentLesson.finished)

                    mainParent.find('.openStudentLastPageFinishedElement').data('last-page-finished',response.studentLesson.last_page_finished)

                    mainParent.find('.newLessonRate').addClass('d-none')
                    changePercentageBar(mainParent, response.studentLesson.percentage)


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

function addNewLessonHandler()
{
    let student_lesson_id = null;
    let group_id = null;
    let lesson_id = null;
    let mainParent = null;

    let student_lesson_review_id = null;
    let group_review_id = null;
    let lesson_review_id = null;
    let mainParent_review = null;

    $('.newLessonButton').on('click',function(){
        $('#newLessonModal').modal('show')
        student_lesson_id = $(this).data('student-lesson-id')
        let last_page_finished = $(this).data('last-page-finished')
        let last_chapter_finished = $(this).data('last-chapter-finished')
        group_id = $(this).data('group-id')
        lesson_id = $(this).data('lesson-id')

        $('#newLessonForm #from_page').val(last_page_finished || '')
        $('#newLessonForm #from_chapter').val(last_chapter_finished || '')

        mainParent = $(this).parent().parent().parent().parent()
    })

    $('.newLessonButtonReview').on('click',function(){
        $('#newLessonModalReview').modal('show')
        student_lesson_review_id = $(this).data('student-lesson-review-id')
        let last_page_finished_review = $(this).data('last-page-finished-review')
        let last_chapter_finished_review = $(this).data('last-chapter-finished-review')
        group_review_id = $(this).data('group-id')
        lesson_review_id = $(this).data('lesson-id')

        $('#newLessonFromReview #from_page').val(last_page_finished_review || '')
        $('#newLessonFromReview #from_chapter').val(last_chapter_finished_review || '')

        mainParent_review = $(this).parent().parent().parent().parent()
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

function openPageFromTheBook(element, subject)
{
    let lastPageFinished = $(element).data('last-page-finished') || 1
    let bookElement = document.getElementById('show-lesson-con')
    bookElement.scrollIntoView({
        behavior: 'smooth'
    })
    handleShowingOfTheBook(lastPageFinished , subject)
}

function changePercentageBar(mainParent, percentage)
{
    mainParent.find(
    '.progressOfSubjectLink .progress-bar').css({
        'width': `${percentage}%`,
        'transision': '1.5s'
    }).find(".progress-bar-percentage").html(`${percentage}%`)
}

function getSubjectById(subject_id)
{
    return subjects.filter( subject => subject.id == subject_id)[0]
}

function getLessonById(subject,lesson_id)
{
    return subject.lessons.filter( lesson => lesson.id == lesson_id)[0]
}

function emptyNewLessonModal()
{
    $('#newLessonForm #from_chapter').val('')
    $('#newLessonForm #to_chapter').val('')
    $('#newLessonForm #from_page').val('')
    $('#newLessonForm #to_page').val('')
}

function emptyNewLessonModalReview()
{
    $('#newLessonFromReview #from_chapter').val('')
    $('#newLessonFromReview #to_chapter').val('')
    $('#newLessonFromReview #from_page').val('')
    $('#newLessonFromReview #to_page').val('')
}

function handleShowingOfTheBook(pageCount = 1, subject){
    let book = null;
    $('#show-lesson-con').remove('')
    $('#next').remove()
    $('#prev').remove()
    $('#navButtonsForBook').html(`
        <button class="btn btn-info" id="prev">
            <i class="fa-solid fa-left-long"></i>
        </button>
        <button class="btn btn-info" id="next">
            <i class="fa-solid fa-right-long"></i>
        </button>
    `)
    $('#zoom-view-port').html(`
        <div id="show-lesson-con">

        </div>
    `)

    const fullPage = document.querySelector('#fullpage');

    $('#show-lesson-con').append(`
        <div>
            <img
                src="/files/subjects/${subject.name}/1.jpg"
                alt=""
                class="w-100 full--screen"
                height="1200"
            >
        </div>
    `)

    book = $('#show-lesson-con').turn({
        duration:1000,
        direction: "rtl",
        height: 1200,
        display: "single"
    });

    for(let  i = 1; i <= pageCount; i++)
    {
        if( !book.turn('hasPage',i) ){
            addPage(book, subject.name, i)
        }
    }

    $('.full--screen').on('click',function(){
        fullPage.style.backgroundImage = 'url(' + this.src + ')';
        fullPage.style.display = 'block';
    })

    book.bind('start',
        function (event, pageObject, corner)
        {
            if (corner == 'tl' || corner == 'tr' || corner == 'bl' || corner == 'br')
            {
                event.preventDefault();
            }
        }
    );

    $('#prev').on('click',function(){
        book.turn("previous");
    })

    $('#next').on('click',function(){
        pageCount += 1
        if(subject.pages_count >= pageCount)
        {
            addPage(book, subject.name, pageCount)
        }

        pageCount += 1
        if(subject.pages_count >= pageCount)
        {
            addPage(book, subject.name, pageCount)
        }

        $('.full--screen').on('click',function(){
            fullPage.style.backgroundImage = 'url(' + this.src + ')';
            fullPage.style.display = 'block';
        })

        book.turn("next");
    })

    book.turn('page',pageCount)
}

function addPage(book, subjectName, pageCount){
    book.turn('addPage',`
        <div>
            <img
                src="/files/subjects/${subjectName}/${pageCount}.jpg"
                alt=""
                class="w-100 full--screen"
                height="1200"
            >
        </div>
    `)
    book.turn('pages', pageCount)
}
