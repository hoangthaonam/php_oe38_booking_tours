let payments_year = document.getElementById('payments_year').value;
    payments_year = JSON.parse(payments_year);
    payments_year.reverse();
    let year = [];
    let nums_year = [];
    for (let item of payments_year){
        year.push(item.year);
        nums_year.push(item.total);
    }
    Highcharts.chart('chartByYear', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Booking Number (Year))'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            ...year
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Booking (times)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:1f} time(s)</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Booking Number',
        data: [...nums_year]
    }, ]
});
