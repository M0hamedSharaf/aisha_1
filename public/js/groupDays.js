$(document).ready(function () {

    $('#group_id').select2({
        dropdownParent: $('#creatGroupDayModal'),
    });

    $('#group_id').on('change', function () {

        let href = $(this).data('href');
        let group_id = $(this).val();
        $(`option`).removeAttr('disabled').css({
            'color': 'black'
        });

        $.ajax({
            url: href,
            data: {
                group_id
            },
            success: function (response) {
                let groupDays = response.groupDays

                groupDays.forEach(element => {
                    let day = element.day

                    $(`#day option[value=${day}]`).attr('disabled', true).css({
                        'color': 'red'
                    })
                });
            },
            error: function () {
            }
        })
    })
})
