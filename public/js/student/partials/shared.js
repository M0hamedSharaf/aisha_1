export function changePercentageBar(mainParent, percentage)
{
    mainParent.find(
    '.progressOfSubjectLink .progress-bar').css({
        'width': `${percentage}%`,
        'transision': '1.5s'
    }).find(".progress-bar-percentage").html(`${percentage}%`)
}

export function getLesson(lessons,lesson_id) {
    return lessons.filter(lesson => {
        return( lesson.id == lesson_id)
    })[0]
}

export function setBook(subject, page = 3)
{
    $('#embed').attr('src',subject.book + "#page=" + page);
}