import { getStudentsTableHtml, handleStudentLessonModal, handleAddStudentLessonModal, addNewLessonHandler } from "./student.js";

export function renderTeacherGroups(groups , words) {
    groups.forEach(group => {
        $('#pills-tab').append(`
            <li class="nav-item">
                <div class="nav-link list-actions" id="group-${group.id}"
                    data-invoice-id="${words.group} : ${group.name}">
                    <div class="f-m-body">
                        <div class="f-head">
                          
                        </div>
                        <div class="f-body">
                       <h3>${group.name}</h3>
                        </div>
                    </div>
                </div>
            </li>
        `)

        let studentsGroupStudentsHtml = getStudentsTableHtml(group );


        $('#ct').append(`
            <div class="group-${group.id}">
                <div class="content-section  animated animatedFadeInUp fadeInUp">

                    <div class="row inv--head-section alert alert-primary" role="alert">

                        <div class="col-sm-6 col-12">
                            <h3 class="in-heading">${group.name}</h3>
                        </div>
                        <div class="col-sm-6 col-12 align-self-center text-sm-right">
                            <div class="company-info">
                           
                                <h5 class="inv-brand-name">
                                    ${words.student_count} : ${group.students.length}
                                </h5>
                            </div>
                        </div>

                    </div>

                    <div class="row inv--product-table-section">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="">
                                    <tr>
                                        <th scope="col">${words.id}</th>
                                        <th scope="col">${words.name}</th>
                                        <th scope="col">${words.phone}</th>
                                        <th scope="col">${words.show_lessons}</th>
                                        <th scope="col">${words.add_lesson}</th>
                                    </tr>
                                </thead>
                                <tbody id="student">
                                `
            +
            studentsGroupStudentsHtml
            +
            `
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        `)
    });


    handleStudentLessonModal(groups , words)
    handleAddStudentLessonModal(groups, words)

    addNewLessonHandler(words)
}