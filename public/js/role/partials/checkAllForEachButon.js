export function checkAllForEachButon()
{
    $('.checkAll').on('change', function () {
        let table = $(this).data('table')
        if (this.checked == true) {
            $(`input[name='permissions[${table}][]']`).prop('checked', true)
        } else {
            $(`input[name='permissions[${table}][]']`).prop('checked', false)
        }
    })
}

export function permissionCheckbox()
{
    $(".permissionCheckbox").change(function () {
        let table = $(this).data('table')

        console.log(table);

        let allCheckboxes = document.querySelectorAll(`input[name='permissions[${table}][]']:not([id="${table}"])`);
        let checkboxChecked = document.querySelectorAll(`input[name='permissions[${table}][]']:not([id="${table}"]):checked`);

        if (allCheckboxes.length == checkboxChecked.length) {
            $(`input[name='permissions[${table}][]']`).prop('checked', true)
        } else {
            $(`#${table}.checkAll`).prop('checked', false)
        }
    });
}