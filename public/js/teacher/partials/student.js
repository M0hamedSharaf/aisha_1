import { Book } from "../../student/partials/book.js";

export function getStudentsTableHtml(group) {

    let studentsGroupStudentsHtml = '';

    group.students.forEach(student => {
        studentsGroupStudentsHtml += `
            <tr>
                <td>${student.id}</td>
                <td>
                    <a class='text-primary'
                        href="/admin/student/show/${student.id}"
                        title='Enter Page show Student'>${student.name}
                    </a>
                </td>
                <td>
                    ${student.phone}</td>
                <td class="text-primary showStudentLessonButton" data-student-id="${student.id}" data-group-id="${group.id}">
                    <i class='fa-solid fa-eye' role="button"></i>
                </td>
                <td class="text-success addStudentLessonButton" data-student-id="${student.id}">
                    <i class="fa-solid fa-square-plus" role="button"></i>
                </td>
            </tr>
        `
    });



    return studentsGroupStudentsHtml;
}

export function handleStudentLessonModal(groups, words) {
    $('.showStudentLessonButton').click(function () {

        let studentId = $(this).data('student-id')

        let student = getStudentFromGroups(groups, studentId);

        let group_id = $(this).data('group-id')



        $.ajax({
            url: "/admin/syllabus/getStudentUnfinishedSyllabus/" + studentId + "/" + group_id,
            type: "get",
            success: function (response) {
                if (response.status == 200) {

                    $('#studentLessonTableBody').html('')

                    response.syllabus.forEach(syllabi => {
                        appendSyllabi(syllabi, words)
                    });

                    $('#studentLessonModal').modal('show')

                    handleFinishNewLesson()
                }
            },
            error: function (res) {
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



export function handleAddStudentLessonModal(groups, words) {
    $('.addStudentLessonButton').click(function () {

        let studentId = $(this).data('student-id')
        let group = getStudentGroupFromGroups(groups, studentId);

        emptyNewLessonModal(words)
        renderSubjectsInSelect(group)
        handleSubjectSelectChange(group, words)
        handleLessonSelectChange(group , words)

        $('.subject_create').select2({
            dropdownParent: $('#addStudentLessonModal'),
        });

        $('.lesson_create').select2({
            dropdownParent: $('#addStudentLessonModal'),
        });

        $('#addStudentLessonModal #group_id').val(group.id)
        $('#addStudentLessonModal #student_id').val(studentId)



        $('#addStudentLessonModal').modal('show')


    })



}

function getStudentFromGroups(groups, studentId) {
    let myStudent = null;
    groups.forEach(group => {
        group.students.forEach(student => {
            if (student.id == studentId) {
                myStudent = student;
            }
        });
    });

    return myStudent;
}

function getSubjectFromGroup(group, subject_id) {
    let mySubject = null;
    group.subjects.forEach(subject => {
        if (subject.id == subject_id) {
            mySubject = subject;
        }
    });

    return mySubject;
}


function getLessonFromSubject(subject, lesson_id) {
    let myLesson = null;
    subject.lessons.forEach(lesson => {
        if (lesson.id == lesson_id) {
            myLesson = lesson;
        }
    });

    return myLesson;
}


function getStudentGroupFromGroups(groups, studentId) {
    let myGroup = null;
    groups.forEach(group => {
        group.students.forEach(student => {
            if (student.id == studentId) {
                myGroup = group;
            }
        });
    });

    return myGroup;
}

function renderSubjectsInSelect(group) {
    group.subjects.forEach(subject => {
        $('#addStudentLessonModal #subject_id').append(`
            <option value="${subject.id}">${subject.name}</option>
        `)
    });
}

function handleLessonSelectChange(group, words) {
    $('#addStudentLessonModal #lesson_id').change(function () {
        let subject = getSubjectFromGroup(group, $('#addStudentLessonModal #subject_id').val())
        let lesson = getLessonFromSubject(subject, $(this).val())


        if (lesson) {
            $('#addStudentLessonModal #lesson_from_page').html(lesson.from_page)
            $('#addStudentLessonModal #lesson_to_page').html(lesson.to_page)
            $('#addStudentLessonModal #lesson_chapters_count').html(lesson.chapters_count)
        }
        else {
            $('#addStudentLessonModal #lesson_id').html(
                `<option val=''>${words.choose_lesson}</option>`
            )
            $('#addStudentLessonModal #lesson_from_page').html(0)
            $('#addStudentLessonModal #lesson_to_page').html(0)
            $('#addStudentLessonModal #lesson_chapters_count').html(0)
        }

    })
}

function handleSubjectSelectChange(group, words) {
    $('#addStudentLessonModal #subject_id').change(function () {
        let subject = getSubjectFromGroup(group, $(this).val())


        if (subject) {

            handleShowingOfBook(subject.book)


            subject.lessons.forEach(lesson => {
                $('#addStudentLessonModal #lesson_id').append(`
                    <option value="${lesson.id}">${lesson.title}</option>
                `)
            });
        }
        else {
            $('#addStudentLessonModal').data('book', '');
            $('#addStudentLessonModal #lesson_id').html(
                `<option val=''>${words.choose_lesson}</option>`
            )
        }

    })
}

export function addNewLessonHandler(words) {
    $('#addStudentLessonModalForm').submit(function (e) {
        e.preventDefault();
        let from_chapter = $('#addStudentLessonModalForm #from_chapter').val()
        let to_chapter = $('#addStudentLessonModalForm #to_chapter').val()
        let from_page = $('#addStudentLessonModalForm #from_page').val()
        let to_page = $('#addStudentLessonModalForm #to_page').val()
        let lesson_id = $('#addStudentLessonModalForm #lesson_id').val()
        let group_id = $('#addStudentLessonModal #group_id').val()
        let student_id = $('#addStudentLessonModal #student_id').val()

        $.ajax({
            url: $(this).data('href'),
            type: "POST",
            data: {
                from_chapter,
                to_chapter,
                from_page,
                to_page,
                student_id: student_id,
                group_id: group_id,
                lesson_id
            },
            success: function (response) {
                $('#addStudentLessonModal').modal('hide')
                if (response.status == 200) {
                    Swal.fire(
                        'Success!7',
                        `Finished Successfully !`,
                        'success',
                    )

                    emptyNewLessonModal(words)
                }
                else if (response.status == 400) {
                    Swal.fire(
                        'Warning!',
                        `Student Didn't Finish The Last Lesson!`,
                        'warning',
                    )

                    emptyNewLessonModal(words)
                }
            },
            error: function (res) {
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


function handleFinishNewLesson() {
    $('.finishNewLessonBtn').click(function () {
        let rate = $(this).parent().parent().find('#rate').val()
        let syllabi_id = $(this).data('syllabi-id');

        $.ajax({
            url: "/admin/syllabus/finishNewLessonAjax/" + $(this).data('syllabi-id'),
            type: "POST",
            data: {
                rate: rate
            },
            success: function (response) {
                if (response.status == 200) {
                    if (rate == "fail") {
                        location.reload();
                        return;
                    }

                    $(`#syllabi-tr-${syllabi_id}`).remove()

                    Swal.fire(
                        'Success!6',
                        `Finished Successfully !`,
                        'success',
                    )


                }
                else if (response.status == 400) {
                    Swal.fire(
                        'Warning!',
                        `Student Has Finished That Lesson`,
                        'warning',
                    )
                }
            },
            error: function (res) {
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

function emptyNewLessonModal(words) {
    $('#addStudentLessonModal #from_chapter').val('')
    $('#addStudentLessonModal #to_chapter').val('')
    $('#addStudentLessonModal #from_page').val('')
    $('#addStudentLessonModal #to_page').val('')
    $('#addStudentLessonModal #lesson_id').html(
        `<option val=''>${words.choose_lesson}</option>`
    )
    $('#addStudentLessonModal #subject_id').html(
        `<option val=''>${words.choose_subject}</option>`
    )

    $('#addStudentLessonModal #lesson_from_page').html(0)
    $('#addStudentLessonModal #lesson_to_page').html(0)
    $('#addStudentLessonModal #lesson_chapters_count').html(0)
}

function appendSyllabi(syllabi, words) {
    $('#studentLessonTableBody').append(`
        <tr id="syllabi-tr-${syllabi.id}">
            <td>${syllabi.student_lesson.lesson.title}</td>
            <td>${syllabi.from_chapter}</td>
            <td>${syllabi.to_chapter}</td>
            <td>${syllabi.from_page}</td>
            <td>${syllabi.to_page}</td>
            <td style="width:200px">
                <select class="form-control" name="rate" id="rate">
                    <option value="">${words.choose_rate}</option>
                    <option value="excellent"> ${words.excellent} </option>
                    <option value="very good"> ${words.very_good} </option>
                    <option value="good"> ${words.good} </option>
                    <option value="fail"> ${words.fail} </option>
                </select>
            </td>
            <td>
                <button class="btn btn-success finishNewLessonBtn" data-syllabi-id="${syllabi.id}">${words.submit}</button>
            </td>
        </tr>
    `)
}

function handleShowingOfBook(subjectHref) {
    let book = new Book(subjectHref)

    $('.showBookBtn').off('click')
    $('.showBookBtn').on('click', function () {
        book.renderPage()
        $('#showBookModal').modal('show')
    })

    $('#next').off('click')
    $('#prev').off('click')
    $('#next').on('click', function () {
        book.onNextPage()
    })
    $('#prev').on('click', function () {
        book.onPrevPage()
    })


    $('#addStudentLessonModal #lesson_from_page').off('click')
    $('#addStudentLessonModal #lesson_from_page').on('click', function () {
        book.pageNum = Number($('#addStudentLessonModal #lesson_from_page').html())
        book.renderPage()
        $('#showBookModal').modal('show')
    })

    $('#addStudentLessonModal #lesson_to_page').off('click')
    $('#addStudentLessonModal #lesson_to_page').on('click', function () {
        book.pageNum = Number($('#addStudentLessonModal #lesson_to_page').html())
        book.renderPage()
        $('#showBookModal').modal('show')
    })
}