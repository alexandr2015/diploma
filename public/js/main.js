function printChart(url)
{
    $.ajax({
        method: "POST",
        url: url,
        success: function (res) {

            var canvas = document.querySelector('#graph');
            var context = canvas.getContext('2d');
            context.restore();
            var data = {
                labels: ["A", "Гнучкисть", "B", "Зовнишний", "C", "Контроль", "D", "Внутришний"],
                datasets: [
                    {
                        label: 'Now',
                        backgroundColor: "rgba(179,181,198,0.2)",
                        borderColor: "rgba(179,181,198,1)",
                        pointBackgroundColor: "rgba(179,181,198,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(179,181,198,1)",
                        data: [res.now_a, res.now_a_b ,res.now_b, res.now_b_c, res.now_c, res.now_c_d, res.now_d, res.now_d_a]
                    },
                    {
                        label: 'Future',
                        backgroundColor: "rgba(255,99,132,0.2)",
                        borderColor: "rgba(255,99,132,1)",
                        pointBackgroundColor: "rgba(255,99,132,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(255,99,132,1)",
                        data: [res.future_a, res.future_a_b, res.future_b, res.future_b_c,  res.future_c, res.future_c_d,  res.future_d, res.future_d_a]
                    }
                ]
            };
            var options = {
                scale: {
                    ticks: {
                        beginAtZero: true,
                        scaleOverride:true,
                        scaleSteps : 10,
                        scaleStepWidth : 50,
                        scaleStartValue : 0,
                        max: 100
                    }
                }
            };
            myRadarChart = new Chart(context, {
                type: 'radar',
                data: data,
                options: options
            });
        }
    });
}