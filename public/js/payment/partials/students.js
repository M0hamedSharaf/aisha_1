export function appendGroupStudentsHtml(group, currentMonth, words)
{
    $('#ct').append(
        getGroupStudentsHtml(group, currentMonth, words)
    )
}

export function handleClickOnPaidCheckbox()
{
    $('.paidCheckbox').click(function(){
        let studentId = $(this).data('student-id');
        let groupId = $(this).data('group-id');
        let amount = $(this).data('amount');

        let month = $(`select[name="month${groupId}"]`).val()

        $.ajax({
            url: "/admin/payment/store",
            type: "POST",
            data:{
                student_id: studentId,
                group_id: groupId,
                amount: amount,
                month: month,
                paid: this.checked,
            },
            success: function (response) {
                if(response.status == 200)
                {
                    Swal.fire(
                        'Success!',
                        `The month has been paid successfully !`,
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        `There was an error sorry`,
                        'error'
                    )
                }
                
            },  
            error: function (response) { 
                month == null ? $(`.paidCheckbox`).prop('checked', false) : '';
                Swal.fire(
                    'Error!',
                    `${response.responseJSON.message}`,
                    'error'
                )
            }
        })

    })
}



export function handleChangeMonth()
{
    $('.month').change(function(){

        let month = $(this).val();
        let groupId = $(this).data('group-id');

        $(`input[id^="paidCheckbox-${groupId}"]`).prop('checked', false);

        if(month)
        {
            $.ajax({
                url: "/admin/payment/getPaymentsOfGroupByMonth",
                data: {
                    month: month,
                    group_id: groupId,
                },
                success: function (response) {
    
                    console.log(response);
                    response.payments.forEach(payment => {
                        if (payment.paid == 1) {
                            $(`#paidCheckbox-${payment.group_id}-${payment.student_id}`).prop('checked', true);
                        }
                        else {
                            $(`#paidCheckbox-${payment.group_id}-${payment.student_id}`).prop('checked', false);
                        }
                    });
                },
                error: function () { }
            })
        }

    })
}




export function handleClickOnPaidCheckboxForGroupShow()
{
    $('.paidCheckbox').click(function(){
        let studentId = $(this).data('student-id');
        let groupId = $(this).data('group-id');
        let amount = $(this).data('amount');

        let month = $(`select[name="month${groupId}"]`).val()

        let checked = this.checked;

        $.ajax({
            url: "/admin/payment/store",
            type: "POST",
            data:{
                student_id: studentId,
                group_id: groupId,
                amount: amount,
                month: month,
                paid: this.checked,
            },
            success: function (response) {
                if(response.status == 200)
                {
                    Swal.fire(
                        'Success!',
                        `The month has been paid successfully !`,
                        'success'
                    )

                    let paymentsCount = parseInt($('#paymentsCount').html())

                    if(checked)
                    {
                        $('#paymentsCount').html(paymentsCount + 1)
                    }
                    else
                    {
                        $('#paymentsCount').html(paymentsCount - 1)
                    }
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        `There was an error sorry`,
                        'error'
                    )
                }
                
            },  
            error: function (response) { 
                month == null ? $(`.paidCheckbox`).prop('checked', false) : '';
                Swal.fire(
                    'Error!',
                    `${response.responseJSON.message}`,
                    'error'
                )
            }
        })

    })
}




export function handleChangeMonthForGroupShow()
{
    $('.month').change(function(){

        let month = $(this).val();
        let groupId = $(this).data('group-id');

        $('#paymentsCount').html('0')

        $(`input[id^="paidCheckbox-${groupId}"]`).prop('checked', false);

        if(month)
        {
            $.ajax({
                url: "/admin/payment/getPaymentsOfGroupByMonth",
                data: {
                    month: month,
                    group_id: groupId,
                },
                success: function (response) {
                    
                    $('#paymentsCount').html(response.paidCount)

                    response.payments.forEach(payment => {
                        if (payment.paid == 1) {
                            $(`#paidCheckbox-${payment.group_id}-${payment.student_id}`).prop('checked', true);
                        }
                        else {
                            $(`#paidCheckbox-${payment.group_id}-${payment.student_id}`).prop('checked', false);
                        }
                    });
                },
                error: function () { }
            })
        }

    })
}

function getAllStudentsTableRowsHtml(group)
{
    let studentsTableRowsHtml = '';

    group.students.forEach(student => {
        studentsTableRowsHtml += `
            <tr>
                <td>${student.id}</td>
                <td>${student.name}</td>

                <td id="checkbok">
                    <input type="checkbox"
                        id="paidCheckbox-${group.id}-${student.id}"
                        class="paidCheckbox big-checkbox"
                        data-student-id="${student.id}"
                        data-group-id="${group.id}"
                        data-amount="${group.group_type.price}"
                        ${student.paidThisMonth ? 'checked' : ''}>
                </td>
            </tr>
        ` 
    });

    return studentsTableRowsHtml;
}

function getGroupStudentsHtml(group, currentMonth, words)
{
    let studentsTableRowsHtml = getAllStudentsTableRowsHtml(group)

    return `
        <div class="group-${group.id}" style="display: none;">
            <div class="content-section  animated animatedFadeInUp fadeInUp">
                <div class="row inv--head-section">

                    <div class="col-sm-6 col-12">
                        <h3 class="in-heading">Students</h3>
                    </div>

                </div>


                <select class="form-control basic month" name="month${group.id}" data-group-id="${group.id}">
                    <option value="">
                        ${words.choose_month}
                    </option>
                    <option value="January"
                        ${currentMonth == "January" ? 'selected' : ''}>${words.January} 
                    </option>
                    <option value="February"
                        ${currentMonth == "February" ? 'selected' : ''}>${words.February} 
                    </option>
                    <option value="March"
                        ${currentMonth == "March" ? 'selected' : ''}>${words.March} 
                    </option>
                    <option value="April"
                        ${currentMonth == "April" ? 'selected' : ''}>${words.April} 
                    </option>
                    <option value="May"
                        ${currentMonth == "May" ? 'selected' : ''}>${words.May} 
                    </option>
                    <option value="June"
                        ${currentMonth == "June" ? 'selected' : ''}>${words.June} 
                    </option>
                    <option value="July"
                        ${currentMonth == "July" ? 'selected' : ''}>${words.July} 
                    </option>
                    <option value="August"
                        ${currentMonth == "August" ? 'selected' : ''}>${words.August} 
                    </option>
                    <option value="September"
                        ${currentMonth == "September" ? 'selected' : ''}>${words.September} 
                    </option>
                    <option value="October"
                        ${currentMonth == "October" ? 'selected' : ''}>${words.October} 
                    </option>
                    <option value="November"
                        ${currentMonth == "November" ? 'selected' : ''}>${words.November} 
                    </option>
                    <option value="December"
                        ${currentMonth == "December" ? 'selected' : ''}>${words.December} 
                    </option>
                </select>



                <div class="row inv--product-table-section">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th scope="col">${words.id}</th>
                                    <th scope="col">${words.name}</th>
                                    <th scope="col">${words.paid}</th>
                                </tr>
                            </thead>
                            <tbody>
                                `

                                + studentsTableRowsHtml +

                                `
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    `
}

