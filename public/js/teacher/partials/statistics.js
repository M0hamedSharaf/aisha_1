export function renderTeacherStatistics(statistics)
{
    statistics.forEach(statistic => {
        $('#experiences_Container').append(`
            <div class="col-xl-6 col-lg-6 mb-3">
                <div class="card border-secondary">
                    <div class="card-body">
                        <h5 class="card-title text-primary text-center">
                            ${statistic.name}
                        </h5>
                        <p class="card-text text-primary text-center">
                        ${statistic.value}
                        </p>
                    </div>
                </div>
            </div>
        `)
    });
}