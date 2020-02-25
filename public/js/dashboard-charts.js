/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        title: {
            text: "" //Parcels Tracking Report
        },
        axisY: {
            title: "" //Number of Parcels
        },
        toolTip: {
            shared: true
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        data: [{
                type: "spline",
                name: "Call Courier",
                showInLegend: true,
                dataPoints: [
                    {label: "Monday", y: 44},
                    {label: "Tuesday", y: 37},
                    {label: "Wednesday", y: 36},
                    {label: "Thursday", y: 36},
                    {label: "Friday", y: 46},
                    {label: "Saturday", y: 46},
                    {label: "Sunday", y: 46}
                ]
            },
            {
                type: "spline",
                name: "TCS",
                showInLegend: true,
                dataPoints: [
                    {label: "Monday", y: 16},
                    {label: "Tuesday", y: 28},
                    {label: "Wednesday", y: 32},
                    {label: "Thursday", y: 48},
                    {label: "Friday", y: 38},
                    {label: "Saturday", y: 26},
                    {label: "Sunday", y: 26}
                ]
            },
            {
                type: "spline",
                name: "Leopards",
                showInLegend: true,
                dataPoints: [
                    {label: "Monday", y: 1},
                    {label: "Tuesday", y: 11},
                    {label: "Wednesday", y: 9},
                    {label: "Thursday", y: 19},
                    {label: "Friday", y: 29},
                    {label: "Saturday", y: 27}, 
                    {label: "Sunday", y: 27}
                ]
            },
//            {
//                type: "spline",
//                name: "Unsuccessful",
//                showInLegend: true,
//                dataPoints: [
//                    {label: "Monday", y: 26},
//                    {label: "Tuesday", y: 32},
//                    {label: "Wednesday", y: 28},
//                    {label: "Thursday", y: 22},
//                    {label: "Friday", y: 20},
//                    {label: "Saturday", y: 19},
//                    {label: "Sunday", y: 19}
//                ]
//            }
        ]
    });

    chart.render();

    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }

}