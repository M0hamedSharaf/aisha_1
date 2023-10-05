import { renderGroupDays } from "./groups.js"
import { Book, handleOpenPageClick } from "./book.js"
import { renderLessonsHtml } from "./lesson.js"


export function mainStudentShowRun() {

    let groupStudentsContainer = $('#groupStudentsContainer')
    $.ajax({ //admin.student.getGroupStudents', $student
        url: groupStudentsContainer.data('href'),
        success: function (response) {

            let groupStudents = response.groupStudents
            let subjects = response.subjects

            groupStudents.forEach(groupStudent => {
                groupStudentsContainer.append(`
                    <div id="groupStudentContainer${groupStudent.id}"></div>
                `)
                renderSubjectsForEachGroup(groupStudent, subjects, response.words)

            });
        },
        error: function () { }
    })
}


function renderSubjectsForEachGroup(groupStudent, subjects, words) {
    $(`#groupStudentContainer${groupStudent.id}`).html('')

    renderGroupDays(groupStudent, words)

    renderSubjects(groupStudent, subjects, words)

    handleOnClickSubject(groupStudent, subjects, words)
}


function handleOnClickSubject(groupStudent, subjects, words) {

    let studentId = $('#studentProfileContainer').data('student-id')
    $(`.subjectContainer${groupStudent.id}`).on('click', function () {


        let subject = getSubjectById(subjects, $(this).data('subject-id'))
        let groupId = groupStudent.group_id


        let book = new Book(subject.book)

        book.renderPage()

        $('#next').click(function () {
            book.onNextPage()
        })
        $('#prev').click(function () {
            book.onPrevPage()
        })


        $('#showBookBtn').click(function () {
            $('#showBookModal').modal('show')
        })


        renderLessonsHtml(subject, groupId, studentId, groupStudent, words)


        handleOpenPageClick(book)


        $(`#backToSubjects${groupStudent.id}`).on('click', function () {

            mainStudentShowRun()

        })
    })
}



function renderSubjects(groupStudent, subjects, words) {
    let subjectsElements = ''

    subjects.forEach(subject => {
        subjectsElements += `
        <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
        <div class="card subjectContainer${groupStudent.id}" data-subject-id="${subject.id} ">
            <div class="card-header d-flex justify-content-around align-items-center card__header__for_tables_show_teacher">
                <h3 class="text-capitalize text-white">
                     ${subject.name}
                </h3>
            </div>
            <div class="card-body d-flex flex-column card-body justify-content-around "  >
                            <img src="${subject.avatar}" alt="" class="avatar-image rounded mx-auto d-block">
                            <div class="btn btn-outline-secondary rounded mx-auto d-block mt-4 mb-0">
                                ${words.lessons_count} <span
                                    class="badge badge-light">${subject.lessons.length}</span>
                            </div>
            </div>
        </div>
    </div>
        `
    });

    $(`#groupStudentContainer${groupStudent.id}`).append(`
        <div class="row" id="subjectsContainer${groupStudent.id}">
            ${subjectsElements}
        </div>
    `)
}


function getSubjectById(subjects, subject_id) {
    return subjects.filter(subject => subject.id == subject_id)[0]
}





