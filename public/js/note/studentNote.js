
addLabelGroups()


var $btns = $('.list-actions').click(function() {
    if (this.id == 'all-notes') {
        var $el = $('.' + this.id).fadeIn();
        $('#ct > div').not($el).hide();
    } if (this.id == 'important') {
        var $el = $('.' + this.id).fadeIn();
        $('#ct > div').not($el).hide();
    } else {
        var $el = $('.' + this.id).fadeIn();
        $('#ct > div').not($el).hide();
    }
    $btns.removeClass('active');
    $(this).addClass('active');  
})


$('.noteFavoriteButton').click(function(){
    let ele = $(this)
    $.ajax({
        url: ele.data('href'),
        success: function (response) {

            Swal.fire(
                'Success!',
                `The note has been Added successfully !`,
                'success'
            )

            if(response.new_is_favorite)
            {
                ele.parent().parent().parent().addClass('note-fav')
            }
            else
            {
                ele.parent().parent().parent().removeClass('note-fav')
            }
        },
        error: function () { }
    })
})



function addLabelGroups() {
    $('.tags-selector .label-group-item').off('click').on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        var getclass = this.className;

        let ele = this

        var getSplitclass = getclass.split(' ')[0];

        $.ajax({
            url: $(ele).parent().data('href'),
            type: 'POST',
            data:{
                type: getSplitclass
            },
            success: function (response) {

                if ($(ele).hasClass('label-personal')) {
                    $(ele).parents('.note-item').removeClass('note-social');
                    $(ele).parents('.note-item').removeClass('note-work');
                    $(ele).parents('.note-item').removeClass('note-important');
                    $(ele).parents('.note-item').toggleClass(getSplitclass);
                } else if ($(ele).hasClass('label-work')) {
                    $(ele).parents('.note-item').removeClass('note-personal');
                    $(ele).parents('.note-item').removeClass('note-social');
                    $(ele).parents('.note-item').removeClass('note-important');
                    $(ele).parents('.note-item').toggleClass(getSplitclass);
                } else if ($(ele).hasClass('label-social')) {
                    $(ele).parents('.note-item').removeClass('note-personal');
                    $(ele).parents('.note-item').removeClass('note-work');
                    $(ele).parents('.note-item').removeClass('note-important');
                    $(ele).parents('.note-item').toggleClass(getSplitclass);
                } else if ($(ele).hasClass('label-important')) {
                    $(ele).parents('.note-item').removeClass('note-personal');
                    $(ele).parents('.note-item').removeClass('note-social');
                    $(ele).parents('.note-item').removeClass('note-work');
                    $(ele).parents('.note-item').toggleClass(getSplitclass);
                }

            },
            error: function () { }
        })


        
    });
}