import {renderTeacherStatistics} from "./partials/statistics.js";
import {renderTeacherExperiences} from "./partials/experience.js"
import {renderTeacherGroups} from "./partials/group.js"

    let href = $('#showTeacherAjaxContainer').data('href')
    $.ajax({ // admin.teacher.getTeacherShowDataAjax', $teacher->id
        url: href,
        success: function (response) {

            renderTeacherStatistics(response.statistics);

            renderTeacherExperiences(response.experiences)

            renderTeacherGroups(response.groups , response.words)

            invoiceListClickEvents()

            initEditeExperienceModal()
        },
        error: function () {
        }
    })