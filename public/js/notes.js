
// const csrfToken = $('meta[name="csrf-token"]').attr('content')

//--------------------------------------------------------------------------
//--------------------------------------------------------------------------


function getStudentNotesByAjax(pageNumber = 1, number_products = 6) {



    //--------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------

    //Start ajax
    $.ajax({
        type: 'POST',
        url: `/admin/note/getNotesStaffDetails`,
        data: {
            // _token: csrfToken,
            page_number: pageNumber,
            number_products: number_products,
            type: 'student'
        },
        success: function (response) {
            //Start function success
            //----------------------------------------------------------

            // console.log(response.data[0]['app\\_models\\_student'])
            
            if (!(response.data.length > 0)) {
                $('#content-notes').html(`
                <h6 class="d-flex align-items-center justify-content-center text-danger">
                    There are no notes for students
                </h6>`);
            }


            // console.log(response.data[0]['app\\_models\\_student'].name);


            //---------------------------------
            //Start append notes content
            let allNotes = ``;
            response.data.forEach((note) => {

                allNotes += `<div class="note-item all-notes note-${note.type}">
                            <div class="note-inner-content">

                                <div class="note-content">
                                    <p class="note-title">Student Name Here</p>
                                    <p class="meta-time">${note.created_at}</p>
                                    <div class="note-description-content">
                                        <p class="note-description">${note.note}</p>
                                    </div>
                                </div>

                                <div class="note-action">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather
                                        feather-star fav-note">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-trash-2 delete-note"
                                        data-id="${note.id}">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>

                                <div class="note-footer">
                                    <div class="tags-selector btn-group">
                                        <a class="nav-link dropdown-toggle d-icon label-group" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                            <span>
                                                <div class="tags">
                                                    <div class="g-dot-personal"></div>
                                                    <div class="g-dot-work"></div>
                                                    <div class="g-dot-social"></div>
                                                    <div class="g-dot-important"></div>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </div>
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right d-icon-menu">
                                            <a  class="note-personal label-group-item label-personal dropdown-item position-relative g-dot-personal type-note"
                                            data-type="personal"
                                            data-id="${note.id}"
                                            href="javascript:void(0);">
                                                Personal
                                            </a>
                                            <a class="note-work label-group-item label-work dropdown-item position-relative g-dot-work type-note"
                                                data-type="Work"
                                                data-id="${note.id}"
                                                href="javascript:void(0);">
                                                Work
                                            </a>
                                            <a class="note-social label-group-item label-social dropdown-item position-relative g-dot-social type-note"
                                                data-type="social"
                                                data-id="${note.id}"
                                                href="javascript:void(0);">
                                                Social
                                            </a>
                                            <a class="note-important label-group-item label-important dropdown-item position-relative g-dot-important type-note"
                                                data-type="important"
                                                data-id="${note.id}"
                                                href="javascript:void(0);">
                                                Important
                                            </a>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>`

            });

            $('#content-notes').html(allNotes)
            //End append notes content
            //----------------------------------------------------------



            //----------------------------------------------------------
            //----------------------------------------------------------
            //Start append user content paginating
            let allLinks = ''
            for (let i = 1; i <= response.pagesCount; i++) {
                allLinks += `
                <li class="${pageNumber == i ? 'active' : ''}">
                    <a href="javascript:void(0)" class="btn_link_page_user" data-pagenumber="${i}">
                        ${i}
                    </a>
                </li>`
            }

            console.log(allLinks);

            $('#paginating-container').html(`
                <div class="paginating-container pagination-default">
                    <ul class="pagination" style="flex-wrap:wrap;">
                        <li class="prev">
                            <a href="javascript:void(0);"id="btn_previous_page_user">Previous</a>
                        </li>
                        ${allLinks}
                        <li class="next">
                            <a href="javascript:void(0);" id="btn_next_page_user">Next</a>
                        </li>
                    </ul>
                </div>`);

            //End append content paginating
            //----------------------------------------------------------



            //----------------------------------------------------------
            //----------------------------------------------------------

            $('.btn_link_page_user').on('click', function () {
                if (pageNumber != $(this).data('pagenumber')) {
                    getStudentNotesByAjax($(this).data('pagenumber'))
                }
            })

            $('#btn_previous_page_user').click(function () {
                if ((pageNumber > 1)) {
                    getStudentNotesByAjax(pageNumber - 1)
                }
            })

            $('#btn_next_page_user').click(function () {
                if (pageNumber < response.pagesCount) {
                    getStudentNotesByAjax(pageNumber + 1)
                }
            })

            //----------------------------------------------------------



            //----------------------------------------------------------
            $(".delete-note").on('click', function () {


                var parentItem = $(this).parents('.note-item');

                // //Start ajax
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/note/delete/' + $(this).data('id'),
                    success: function (response) {
                        //Start function success
                        //----------------------------------------------------------

                        parentItem.remove()

                        setTimeout(() => {
                            swal({
                                title: response.title,
                                text: response.message,
                                type: response.alert,
                                padding: '2em'
                            })
                        }, 500);

                        //----------------------------------------------------------
                        //End function success
                    },
                    error: function (reject) {

                        swal({
                            title: 'فشل',
                            text: 'فشل الحذف',
                            type: 'alert',
                            padding: '2em'
                        })
                    }
                })
                // //End ajax

            })
            //----------------------------------------------------------


            //----------------------------------------------------------
            //Start ajax
            $.ajax({
                type: 'POST',
                url: `/admin/note/getStaffDetails`,

                success: function (response) {
                    //Start function success
                    //----------------------------------------------------------
                    console.log(response);
                    // Start append input student type options
                    let allType = ``;
                    response.types.forEach((data) => {
                        allType += `<option value="${data}">
                                        ${data}
                                    </option>`
                    });

                    $('#content-type').html(`<select class="form-control" name="type" id="input-type">
                                                <option selected>Select Type</option>
                                                ${allType}
                                             </select>`);
                    // End append input student type options


                    //Start append input student name options
                    let allStudents = ``;
                    response.students.forEach((student) => {
                        allStudents += `<option value="${student.id}">
                                            ${student.name}
                                        </option>`
                    });

                    $('#content-student').html(`<select name="name" class="form-control basic" id="input-student">
                                                    <option value="">Choose ...</option>
                                                    ${allStudents}
                                                </select>`);
                    //End append input student name options


                    //----------------------------------------------------------
                    //End function success
                },
                error: function (reject) {


                }
            })
            //End ajax

            //----------------------------------------------------------


            //----------------------------------------------------------
            $('#btn-add-notes').on('click', function (event) {
                $('#notesMailModal').modal('show');
                $('#btn-n-save').hide();
                $('#btn-n-add').show();
            })




            
            






            //----------------------------------------------------------


            $('.type-note').on('click', function () {
                console.log($(this).data('type')+"__"+$(this).data('id'));


            })


            $('.tags-selector .label-group-item').off('click').on('click', function (event) {
                event.preventDefault();
                /* Act on the event */

                //('personal', 'work', 'social', 'important')
                var getclass = this.className;
                var getSplitclass = getclass.split(' ')[0];
                if ($(this).hasClass('label-personal')) {
                    $(this).parents('.note-item').removeClass('note-social');
                    $(this).parents('.note-item').removeClass('note-work');
                    $(this).parents('.note-item').removeClass('note-important');
                    $(this).parents('.note-item').toggleClass(getSplitclass);
                    console.log(getSplitclass);

                } else if ($(this).hasClass('label-work')) {
                    $(this).parents('.note-item').removeClass('note-personal');
                    $(this).parents('.note-item').removeClass('note-social');
                    $(this).parents('.note-item').removeClass('note-important');
                    $(this).parents('.note-item').toggleClass(getSplitclass);
                    console.log(getSplitclass);

                } else if ($(this).hasClass('label-social')) {
                    $(this).parents('.note-item').removeClass('note-personal');
                    $(this).parents('.note-item').removeClass('note-work');
                    $(this).parents('.note-item').removeClass('note-important');
                    $(this).parents('.note-item').toggleClass(getSplitclass);
                    console.log(getSplitclass);

                } else if ($(this).hasClass('label-important')) {
                    $(this).parents('.note-item').removeClass('note-personal');
                    $(this).parents('.note-item').removeClass('note-social');
                    $(this).parents('.note-item').removeClass('note-work');
                    $(this).parents('.note-item').toggleClass(getSplitclass);
                    console.log(getSplitclass);

                }
            });





            //----------------------------------------------------------
            //End function success
        },
        error: function () {

        }
    })
    //End ajax

    //--------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------

}

getStudentNotesByAjax()

handleStoreEvent()


function handleStoreEvent()
{
    $("#btn-n-add").on('click', function (event) {

        var type = $('#input-type').val();
        var user_id = $('#input-student').val();
        var note = $('#input-note').val();


        //Start ajax
        $.ajax({
            type: 'POST',
            url: '/admin/note/store',
            data: {
                type: type,
                note: note,
                notable_id: user_id,
            },
            success: function (response) {
                //Start function success
                //----------------------------------------------------------

                $('#notesMailModal').modal('hide');

                // $('#input-note').text('');
                $('#notesMailModalTitle')[0].reset()


                swal({
                    title: 'success',
                    text: "تمت العملية بنجاح",
                    type: 'success',
                    padding: '2em'
                })

                getStudentNotesByAjax()
                //----------------------------------------------------------
                //End function success
            },
            error: function (reject) {

                console.log(reject)
                // let res = $.parseJSON(reject.responseText);
                // $.each(res.errors, function(key, value) {
                //     $("#" + key).text(value[0]);
                // })
            }
        })
        //End ajax



    });
}





/*
function appendStudentsOptions(data, student_id = null) {

    let allStudents = ``;
    data.forEach((student) => {
        allStudents += `<option value="${student.id}" ${(student_id == student.id) ? 'selected' : ''}>
                            ${student.name}
                        </option>`
    });

    $('#content-student').html(`<select name="name" class="form-control basic" id="input-student">
                                    <option value="">Choose ...</option>
                                    ${allStudents}
                                </select>`);


}

function appendTypesOptions(data, type = null) {

    //Start append type content
    let allType = ``;
    data.forEach((data) => {
        allType += `<option value="${data}" ${(type == data) ? 'selected' : ''}>
                        ${data}
                    </option>`
    });

    $('#content-type').html(`<select class="form-control" name="type" id="input-type">
                                <option selected>Select Type</option>
                                ${allType}
                             </select>`);

    //End append type content
}

*/
