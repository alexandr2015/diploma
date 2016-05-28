<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <canvas id="graphLine" width="400" height="400" style="border:1px solid"></canvas>
        <canvas id="graphBar" width="400" height="400" style="border:1px solid"></canvas>
        <canvas id="graphRadar" width="400" height="400" style="border:1px solid"></canvas>
        <canvas id="graphPolarArea"></canvas>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
        <script>
            var data = {
                labels: ["January", "February", "March", "April"],
                datasets: [
                    {
                        fillColor : "rgba(100,220,100, 0.7",
                        strokeColor : "rgba(220,220,220, 0.1",
                        pointColor : "rgba(220,220,220, 1",
                        pointStrokeColor : "#fff",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(220,220,220,1)",
                        data: [30, 122, 90, 54]
                    },
                    {
                        fillColor : "rgba(0,220,220, 0.2",
                        strokeColor : "rgba(220,220,220, 0.1",
                        pointColor : "rgba(220,220,220, 1",
                        pointStrokeColor : "#fff",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(220,220,220,1)",
                        data: [70, 152, 160, 74]
                    }
                ]
            };
            var contextLine = document.querySelector('#graphLine').getContext('2d');
            var contextBar = document.querySelector('#graphBar').getContext('2d');
            var contextRadar = document.querySelector('#graphRadar').getContext('2d');
            var contextPolarArea = document.querySelector('#graphPolarArea').getContext('2d');

            new Chart(contextBar).Bar(data);
            new Chart(contextLine).Line(data);
            var dataPolar = {
                datasets: [{
                    data: [
                        11,
                        16,
                        7,
                        3,
                        14
                    ],
                    backgroundColor: [
                        "#FF6384",
                        "#4BC0C0",
                        "#FFCE56",
                        "#E7E9ED",
                        "#36A2EB"
                    ],
                    label: 'My dataset' // for legend
                }],
                labels: [
                    "Red",
                    "Green",
                    "Yellow",
                    "Grey",
                    "Blue"
                ]
            };
            new Chart(contextRadar).Radar(data);
        </script>
    </body>
</html>
