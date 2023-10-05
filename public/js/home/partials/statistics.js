export function statisticsRun()
{
    $.ajax({
        url: $('#homeTopStatisticsCon').data('href'),
        success: function (response) {
            response.statistics.forEach(function(statistic, index){
                $('#homeTopStatisticsCon').append(`
                    <div class="counter-container">
                        ${statistic.icon}
                
                        <div class="counter-content bg-white">
                            <h1 class="ico-counter${index} ico-counter">${statistic.count}</h1>
                        </div>
                
                        <p class="ico-counter-text">${statistic.title}</p>
                    </div>
                `)
            })
        },
        error: function () {
        }
    }).then(function(response){

        var cSpeed = 2000;
        response.statistics.forEach(function(statistic, index){
            var value = $(`.ico-counter${index}`).text();
            $(`.ico-counter${index}`).countTo({
                from: 0,
                to: value,
                speed: cSpeed,
                formatter: function (value, options) {
                    return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                }
            });
        })

    })


    
}
