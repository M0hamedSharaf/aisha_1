function initEditeElementorModal() {
    $('.editElementorButton').on('click', function () {
        let name_en = $(this).data('name-en')
        let name_ar = $(this).data('name-ar')
        let desc_en = $(this).data('desc-en')
        let desc_ar = $(this).data('desc-ar')

        console.log(name_en);
        console.log(name_ar);
        let href = $(this).data('href')

        $('#editElementorForm #name_en').val(name_en)
        $('#editElementorForm #name_ar').val(name_ar)
        $('#editElementorForm #desc_en').val(desc_en)
        $('#editElementorForm #desc_ar').val(desc_ar)

        $('#editElementorForm').attr('action', href)
    })
}