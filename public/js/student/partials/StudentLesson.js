export class StudentLesson
{
    constructor(lesson, groupId, studentId) {
        this.studentLesson = lesson.student_lessons.filter(studentLesson => {
            return(studentLesson.student_id == studentId &&
                studentLesson.group_id == groupId
            )
        })[0]
    }

    getStudentLessonId()
    {
        if(this.studentLesson)
        {
            return this.studentLesson.id
        }
        return null
    }

    getNextLesson()
    {
        if(this.studentLesson)
        {
            return this.studentLesson.syllabus.filter(syllabi => syllabi.finished == 0)[0]
        }
        return null
    }

    getNextLessonData()
    {
        if(this.studentLesson || this.getNextLesson())
        {
            return {
                showUrl: `/admin/student_lesson/show/${this.studentLesson.id}`,
                nextLesson: this.studentLesson.syllabus.filter(syllabi => syllabi.finished == 0)[0] || null,
                fromChapter: this.getNextLesson()?.from_chapter || 0,
                toChapter: this.getNextLesson()?.to_chapter || 0,
                fromPage: this.getNextLesson()?.from_page || null,
                toPage: this.getNextLesson()?.to_page || null,
                id: this.getNextLesson()?.id || null,
                lastChapter: this.studentLesson.last_chapter_finished || 0,
                finishPercentage: this.studentLesson.percentage || 0,
                finished: this.studentLesson.finished ||false,
                lastPage: this.studentLesson.last_page_finished || 0
            }
        }

        return {
            showUrl: "#",
            nextLesson: null,
            fromChapter: 0,
            toChapter: 0,
            fromPage: null,
            toPage: null,
            id: null,
            lastChapter: 0,
            finishPercentage: 0,
            finished: false,
            lastPage: 0
        }
    }


    getStudentLessonReview()
    {
        if(this.studentLesson)
        {
            if(this.studentLesson.student_lesson_review)
            {
                return this.studentLesson.student_lesson_review
            }
        }
        return null
    }

    getNextLessonReview()
    {
        if(this.studentLesson)
        {
            if(this.getStudentLessonReview())
            {
                return this.getStudentLessonReview().syllabus_reviews.filter(syllabusReview => syllabusReview.finished == 0)[0]
            }
        }
        return null
    }

    getNextLessonReviewData()
    {
        if(this.getStudentLessonReview() || this.getNextLessonReview())
        {
            return {
                nextLesson: this.getNextLessonReview() || null,
                fromChapter: this.getNextLessonReview()?.from_chapter || 0,
                toChapter: this.getNextLessonReview()?.to_chapter || 0,
                fromPage: this.getNextLessonReview()?.from_page == null ? null : this.getNextLessonReview().from_page,
                toPage: this.getNextLessonReview()?.to_page == null ? null : this.getNextLessonReview().to_page,
                id: this.getNextLessonReview()?.id || null,
                lastChapter: this.getStudentLessonReview()?.last_chapter_finished || 0,
                finishPercentage: this.getStudentLessonReview()?.percentage || 0,
                finished: this.getStudentLessonReview()?.finished || false,
                lastPage: this.getStudentLessonReview()?.last_page_finished || 0
            }
        }

        return {
            nextLesson: null,
            fromChapter: 0,
            toChapter: 0,
            fromPage: null,
            toPage: null,
            id: null,
            lastChapter: 0,
            finishPercentage: 0,
            finished: false,
            lastPage: 0
        }
    }
}