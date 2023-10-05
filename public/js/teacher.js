getDataShow();

function getDataShow() {
    let href = $('#showTeacherAjaxContainer').data('href')
    $.ajax({
        url: href,
        success: function (response) {

            response.statistics.forEach(statistic => {
                $('#experiences_Container').append(`
                    <div class="col-xl-6 col-lg-6 mb-3">
                        <div class="card border-secondary">
                            <div class="card-body">
                                <h5 class="card-title text-primary text-center">
                                    ${statistic.name}
                                </h5>
                                <p class="card-text text-primary text-center">
                                   ${statistic.value}
                                </p>
                            </div>
                        </div>
                    </div>
                `)
            });

            response.experiences.forEach(experience => {
                $('#experience_Content').append(`
                    <tr>
                        <td>${experience.id}</td>
                        <td>${experience.title}</td>
                        <td>${experience.from}</td>
                        <td>${experience.to}</td>
                        <td>
                            <a class="editExperienceButton title " data-title="${experience.title}"
                                data-from="${experience.from}"
                                data-to="${experience.to}"
                                data-teacherid="${experience.teacher_id}"
                                data-toggle="modal"
                                data-target="#editexperience"
                                data-href="/admin/experience/update/${experience.id}">
                                <i class="icon fa-solid fa-pen-to-square fa-xl"></i>
                            </a>
                        </td>
                        <td>
                            <a class="deleteButton" href="/admin/experience/delete/${experience.id}">
                                <i class="icon fa-solid fa-trash-can fa-xl"></i>
                            </a>
                        </td>
                    </tr>
                `
                )
            });

            response.groups.forEach(group => {
                $('#pills-tab').append(`
                    <li class="nav-item">
                        <div class="nav-link list-actions" id="group-${group.id}"
                            data-invoice-id="group : ${group.name}">
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
                            <td class="text-right">
                                ${student.birthday}</td>
                            <td class="text-right">
                                ${student.phone}</td>
                        </tr>
                    `
                });

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
                                            COUNT Student : ${group.students.length}
                                        </h5>
                                    </div>
                                </div>

                            </div>

                            <div class="row inv--product-table-section">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Name</th>
                                                    <th class="text-right" scope="col">Birthday
                                                    </th>
                                                    <th class="text-right" scope="col">Phone</th>
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
                    </div>
                `)
            });

            invoiceListClickEvents()

            initEditeExperienceModal()
        },
        error: function () {
        }
    })
}


//



