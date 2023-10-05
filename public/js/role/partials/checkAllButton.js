
export function checkAllButtonRun()
{
    let allChecked = false;
        
    $('#giveAllPermissions').on('click', function (e) {
        e.preventDefault();

        if (!allChecked) 
        {
            $('.permissionCheckbox').prop('checked', true);
            $('.checkAll').prop('checked', true);
            $('#giveAllPermissions').css({
                color: '#515365',
            });
            allChecked = true;
        } 
        else 
        {
            $('.permissionCheckbox').prop('checked', false);
            $('.checkAll').prop('checked', false);
            $('#giveAllPermissions').css({
                color: '#e95f2b',
            });
            allChecked = false;
        }
    })
}