$(function () {
    //Widgets count
    $('.count-to').countTo();

    initDonutChart();
    initSparkline();

    setTimeout(function(){
        window.location.reload(1);
    }, 20000);
});

function initSparkline() {
    $(".sparkline").each(function () {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });
}

function initDonutChart() {
    Morris.Donut({
        element: 'donut_chart',
        data: [{
            label: 'Bandung Utara',
            value: jmlBandara
        }, {
            label: 'Bandung Timur',
            value: jmlTimur
        }, {
            label: 'Bandung Selatan 1',
            value: jmlSelatan1
        }, {
            label: 'Bandung Selatan 2',
            value: jmlSelatan2
        },
        {
            label: 'Bandung Barat',
            value: jmlBarat
        }],
        colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
        formatter: function (y) {
            var persentase = y / jmlTotal* 100;
            return persentase.toFixed(1) + '%'
        }
    });
}

var data = [], totalPoints = 110;
function getRandomData() {
    if (data.length > 0) data = data.slice(1);

    while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
        if (y < 0) { y = 0; } else if (y > 100) { y = 100; }

        data.push(y);
    }

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]]);
    }

    return res;
}