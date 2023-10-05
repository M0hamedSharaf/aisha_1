export function renderTeacherExperiences(experiences)
{
    experiences.forEach(experience => {
        $('#experience_Content').append(`
            <tr>
                <td>${experience.id}</td>
                <td>${experience.title}</td>
                <td>${experience.from}</td>
                <td>${experience.to}</td>
                <td>
                    <a class="editExperienceButton title " data-title="${experience.title}"
                        data-from="${experience.from}"
                        data-to="${experience.to}"
                        data-teacherid="${experience.teacher_id}"
                        data-toggle="modal"
                        data-target="#editexperience"
                        data-href="/admin/experience/update/${experience.id}">
                        <i class="icon fa-solid fa-pen-to-square fa-xl"></i>
                    </a>
                </td>
                <td>
                    <a class="deleteButton" href="/admin/experience/delete/${experience.id}">
                        <i class="icon fa-solid fa-trash-can fa-xl"></i>
                    </a>
                </td>
            </tr>
        `
        )
    });
}