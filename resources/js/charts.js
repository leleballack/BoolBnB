var Chart = require('chart.js');




var ctx = document.getElementById('myChart');
var risultati = [];
var gen =  $('#gen').val();
var feb =  $('#feb').val();
var mar =  $('#mar').val();
var apr =  $('#apr').val();
var mag =  $('#mag').val();
var giu =  $('#giu').val();
var lug =  $('#lug').val();
var ago =  $('#ago').val();
var set=  $('#set').val();
var ott=  $('#ott').val();
var nov =  $('#nov').val();
var dic =  $('#dic').val();
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
        datasets: [{
            label: '# of Votes',
            data: [gen,feb,mar,apr,mag,giu,lug,ago,set,ott,nov,dic
],
            // backgroundColor: [
            //     // 'rgba(255, 99, 132, 0.2)',
            //     // 'rgba(54, 162, 235, 0.2)',
            //     // 'rgba(255, 206, 86, 0.2)',
            //     // 'rgba(75, 192, 192, 0.2)',
            //     // 'rgba(153, 102, 255, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)',
            //     // 'rgba(255, 159, 64, 0.2)'
            // ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
