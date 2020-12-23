let payments_month = document.getElementById('payments_month').value;
    payments_month = JSON.parse(payments_month);
    payments_month.reverse();
    let months = [];
    let nums = [];
    for (let item of payments_month){
        months.push(item.month + '-' + item.year);
        nums.push(item.total);
    }
    Highcharts.chart('chartByMonth', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Booking Number (Month)'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            ...months
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
        data: [...nums]
    }, ]
});
