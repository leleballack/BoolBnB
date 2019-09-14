var Chart = require("chart.js");

// dati e grafico visualizzazioni singolo apt

var ctx = document.getElementById("myChart");
var risultati = [];
var gen = $("#gen").val();
var feb = $("#feb").val();
var mar = $("#mar").val();
var apr = $("#apr").val();
var mag = $("#mag").val();
var giu = $("#giu").val();
var lug = $("#lug").val();
var ago = $("#ago").val();
var set = $("#set").val();
var ott = $("#ott").val();
var nov = $("#nov").val();
var dic = $("#dic").val();
var myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "Gennaio",
            "Febbraio",
            "Marzo",
            "Aprile",
            "Maggio",
            "Giugno",
            "Luglio",
            "Agosto",
            "Settembre",
            "Ottobre",
            "Novembre",
            "Dicembre"
        ],
        datasets: [
            {
                label: "# of Votes",
                data: [
                    gen,
                    feb,
                    mar,
                    apr,
                    mag,
                    giu,
                    lug,
                    ago,
                    set,
                    ott,
                    nov,
                    dic
                ],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    // "rgba(255, 159, 64, 0.2)",
                    // "rgba(255, 159, 64, 0.2)",
                    // "rgba(255, 159, 64, 0.2)",
                    // "rgba(255, 159, 64, 0.2)",
                    // "rgba(255, 159, 64, 0.2)",
                    // "rgba(255, 159, 64, 0.2)",
                    // "rgba(255, 159, 64, 0.2)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true
                    }
                }
            ]
        }
    }
});

// dati e grafico messaggi singolo apt

var graficoMess = $("#messagesChart");
var gennaio = $("#gen_mes").val();
var febbraio = $("#feb_mes").val();
var marzo = $("#mar_mes").val();
var aprile = $("#apr_mes").val();
var maggio = $("#mag_mes").val();
var giugno = $("#giu_mes").val();
var luglio = $("#lug_mes").val();
var agosto = $("#ago_mes").val();
var settembre = $("#set_mes").val();
var ottobre = $("#ott_mes").val();
var novembre = $("#nov_mes").val();
var dicembre = $("#dic_mes").val();
var myChart = new Chart(graficoMess, {
    type: "line",
    data: {
        labels: [
            "Gennaio",
            "Febbraio",
            "Marzo",
            "Aprile",
            "Maggio",
            "Giugno",
            "Luglio",
            "Agosto",
            "Settembre",
            "Ottobre",
            "Novembre",
            "Dicembre"
        ],
        datasets: [
            {
                label: "Numero messaggi",
                data: [
                    gennaio,
                    febbraio,
                    marzo,
                    aprile,
                    maggio,
                    giugno,
                    luglio,
                    agosto,
                    settembre,
                    ottobre,
                    novembre,
                    dicembre
                ],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 159, 64, 0.2)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true
                    }
                }
            ]
        }
    }
});
