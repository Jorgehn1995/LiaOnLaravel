function cantidades() {
    $.ajax({
        //data: parametros,
        url: url,
        type: 'GET',
        beforeSend: function () {

        },
        success: function (response) {

        },
        error: function (data) {

        }
    });
}
function barchart(element, data, xkey, ykeys, labels, lineColors) {
    Morris.Bar({
        element: element,
        data: data,
        xkey: xkey,
        ykeys: ykeys,
        labels: labels,
        hideHover: 'auto',
        resize: true, //defaulted to true
        gridLineColor: '#eeeeee',
        barColors: lineColors
    });
}
function stackedchart(element, data, xkey, ykeys, labels, lineColors) {
    Morris.Bar({
        element: element,
        data: data,
        xkey: xkey,
        ykeys: ykeys,
        stacked: true,
        labels: labels,
        hideHover: 'auto',
        resize: true, //defaulted to true
        gridLineColor: '#eeeeee',
        barColors: lineColors
    });
}
