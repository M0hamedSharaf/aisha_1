import {runPackage} from "./partials/package.js"
import {appendMainGroup} from "./partials/group.js"
import {appendGroupStudentsHtml, handleClickOnPaidCheckbox, handleChangeMonth} from "./partials/students.js"

$.ajax({ //admin.group.getAllGroupsForPayment
    url: $('.groupsContainer').data('href'),
    success: function (response) {

        let currentMonth = response.currentMonth; 
        let words = response.words

        response.groups.forEach(group => {

            

            appendMainGroup(group, words)



            appendGroupStudentsHtml(group, currentMonth, words)



            runPackage()

        });

        handleClickOnPaidCheckbox()
        handleChangeMonth()
    },
    error: function () { }
})














































// let paidCheckboxes = document.getElementsByClassName('paidCheckbox');
// let token = $('meta[name="csrf_token"]').attr("content");
// // whenMonthChangeHandlePaymentCheckBox()


// $('.paidCheckbox').click(function(){
//     let href = $(this).data('href');
//     let studentId = $(this).data('student-id');
//     let groupId = $(this).data('group-id');
//     let amount = $(this).data('amount');

//     let month = $(element).parent()
//         .parent().parent()
//         .parent().parent()
//         .parent().parent()
//         .parent()
//         .find("#month")
//         .val()

//     console.log(month);

//     // Create Payment
//     if (element.checked == true) {
//         $.ajax({
//             url: href,
//             type: 'post',
//             data: {
//                 student_id: studentId,
//                 group_id: groupId,
//                 amount: amount,
//                 month: month,
//                 paid: true,
//             },
//             success: function (response) {
//                 let paymentsCount = $('#paymentsCount').html()

//                 paymentsCount = parseInt(paymentsCount)

//                 $('#paymentsCount').html(paymentsCount + 1)

//                 Swal.fire(
//                     'Success!',
//                     `The month has been paid successfully !`,
//                     'success'
//                 )
//             },
//             error: function (response) {
//                 month == null ? $(`.paid_finished_checkbox`).prop('checked', false) : '';
//                 Swal.fire(
//                     'Warning!',
//                     `${response.responseJSON.message}`,
//                     'error'
//                 )
//             }
//         })
//     } else {
//         $.ajax({
//             url: href,
//             type: 'post',
//             data: {
//                 student_id: student,
//                 group_id: group,
//                 amount: amount,
//                 month: monthCreatePayment,
//                 paid: false
//             },
//             success: function (response) {
//                 let paymentsCount = $('#paymentsCount').html()

//                 paymentsCount = parseInt(paymentsCount)

//                 $('#paymentsCount').html(paymentsCount - 1)

//                 Swal.fire(
//                     'Success!',
//                     `The month's payment has been cancelled !`,
//                     'success'
//                 )
//             },
//             error: function (response) {
//                 Swal.fire(
//                     'Warning!',
//                     `${response.responseJSON.message}`,
//                     'error'
//                 )
//             }
//         })
//     }
// })

// $(".month").change(function () {
//     whenMonthChangeHandlePaymentCheckBox()
// });


// function whenMonthChangeHandlePaymentCheckBox() {
//     $(`.paid_finished_checkbox_by_show_payment`).prop('checked', false);

//     let monthCreatePayment = $('.month').val();
//     let group = $('.month').data('group');
//     let href = $('.month').data('href');
//     $.ajax({
//         url: href,
//         data: {
//             month: monthCreatePayment,
//             group_id: group,
//         },
//         success: function (response) {
//             response.payments.forEach(payment => {
//                 if (payment.paid == 1) {
//                     $(`#paid_finished_checkbox_${payment.student_id}_${payment.group_id}`).prop('checked', true);
//                     // if (student_id == payment.student_id) {
//                     // $(`#paid_finished_checkbox_${payment.student_id}_${payment.group_id}`).prop('checked', true);
//                     // }
//                 }
//                 else {
//                     $(`#paid_finished_checkbox_${payment.student_id}_${payment.group_id}`).prop('checked', false);
//                 }
//             });
//         },
//         error: function () { }
//     })
// }


// let month = $(".month").val();
// let group = $(".month").data('group');
// let href = $(".month").data('href-payment-count');

// getPymentsCount(month, group, href)


// $(".month").change(function () {

//     let month = $(this).val();
//     let group = $(this).data('group');
//     let href = $(this).data('href-payment-count');

//     getPymentsCount(month, group, href)
// });


// function getPymentsCount(month, group, href) {
//     $.ajax({
//         url: href,
//         data: {
//             month: month,
//             group_id: group,
//         },
//         success: function (response) {
//             $('#paymentsCount').html(response.paymentsCount)
//         },
//         error: function () { }
//     })
// }