function initShowRoleUsersModal() {
    $('.showRoleButton').on('click', function () {
        let url = $(this).data('url')
        
        $('#showRoleModal tbody').html('')

        $.ajax({
            url: url,
            success: function (response) {

                response.users.forEach(user => {
                    $('#showRoleModal tbody').append(`
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td class="text-primary">User</td>
                        </tr>
                    `)
                });

                response.teachers.forEach(user => {
                    $('#showRoleModal tbody').append(`
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td class="text-warning">Teacher</td>
                        </tr>
                    `)
                });

                response.students.forEach(user => {
                    $('#showRoleModal tbody').append(`
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td class="text-success">Student</td>
                        </tr>
                    `)
                });
            },
            error: function () {
            }
        });
    })
}