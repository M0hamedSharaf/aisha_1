function initEditeExperienceModal() {
    $('.editExperienceButton').on('click', function () {
        let title = $(this).data('title')
        let from = $(this).data('from')
        let to = $(this).data('to')
        let teacher_id = $(this).data('teacherid')

        let href = $(this).data('href')

        $('#editExperienceForm #title').val(title)
        $('#editExperienceForm #from').val(from)
        $('#editExperienceForm #to').val(to)
        $('#editExperienceForm #teacherId').val(teacher_id)

        $('#editExperienceForm').attr('action', href)
    })
}