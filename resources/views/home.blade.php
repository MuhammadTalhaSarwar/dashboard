@extends('layouts.app')

@section('content')

<style type="text/css">
    .highcharts-figure-solid .chart-container-solid {
    width: 300px;
    height: 200px;
    float: left;
}

.highcharts-figure-solid, .highcharts-data-table table {
    width: 600px;
    margin: 0 auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

@media (max-width: 600px) {
    .highcharts-figure-solid, .highcharts-data-table table {
        width: 100%;
    }
    .highcharts-figure-solid .chart-container-solid {
        width: 300px;
        float: none;
        margin: 0 auto;
    }

}

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<div class="row">
    <div class="col-md-5">
        <figure class="highcharts-figure">
                    <div id="kannel_tps">
                        
                    </div>
        </figure>
    </div>
    <div class="col-md-5">
         <figure class="highcharts-figure">
                    <div id="kannel_queue">
                        
                    </div>
        </figure>
    </div>
    <div class="col-md-2">
        <figure class="highcharts-figure-solid">
            <div id="container-speed" class="chart-container-solid"></div>
        </figure>
    </div>

    <div class="col-md-2">
        <figure class="highcharts-figure-solid">
            <div id="container-speed-2" class="chart-container-solid"></div>
        </figure>
    </div>
    
</div>


<script>
 var kannel_tps = <?php echo json_encode($kannel_tps);?> ;
    // Create the chart
Highcharts.chart('kannel_tps', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Kannel Tps'
    },
    // subtitle: {
    //     text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    // },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Value'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.2f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: [
                {
                    name: "JAZZCASH",
                    y: parseFloat(kannel_tps.JAZZCASH),
                    drilldown: null
                },
                {
                    name: "CSMS1",
                    y: parseFloat(kannel_tps.CSMS1),
                    drilldown: null
                },
                {
                    name: "AQO_INTL",
                    y: parseFloat(kannel_tps.AQO_INTL),
                    drilldown: null
                },
                {
                    name: "AAQOOCMS2",
                    y: parseFloat(kannel_tps.AAQOOCMS2),
                    drilldown: null
                },
                {
                    name: "WARID LA",
                    y: parseFloat(kannel_tps.WARID_LA),
                    drilldown: null
                },
                {
                    name: "WARID LO",
                    y: parseFloat(kannel_tps.WARID_LO),
                    drilldown: null
                },
                {
                    name: "AAQOO SINCH",
                    y: parseFloat(kannel_tps.Aaqoo_Sinch),
                    drilldown: null
                },
                {
                    name: "AAQOO CMS3",
                    y: parseFloat(kannel_tps.AAQOOCMS3),
                    drilldown: null
                },
                {
                    name: "CMT AQOO",
                    y: parseFloat(kannel_tps.CMT_AQOO),
                    drilldown: null
                },
                {
                    name: "SC 7005",
                    y: parseFloat(kannel_tps.SC_7005),
                    drilldown: null
                }
            ]
        }
    ],
});

 var kannel_queue = <?php echo json_encode($kannel_queue);?> ;

Highcharts.chart('kannel_queue', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Kannel Queue'
    },
    // subtitle: {
    //     text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    // },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Value'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.2f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: [
                {
                    name: "JAZZCASH",
                    y: parseFloat(kannel_queue.JAZZCASH),
                    drilldown: null
                },
                {
                    name: "CSMS1",
                    y: parseFloat(kannel_queue.CSMS1),
                    drilldown: null
                },
                {
                    name: "AQO_INTL",
                    y: parseFloat(kannel_queue.AQO_INTL),
                    drilldown: null
                },
                {
                    name: "AAQOOCMS2",
                    y: parseFloat(kannel_queue.AAQOOCMS2),
                    drilldown: null
                },
                {
                    name: "WARID LA",
                    y: parseFloat(kannel_queue.WARID_LA),
                    drilldown: null
                },
                {
                    name: "WARID LO",
                    y: parseFloat(kannel_queue.WARID_LO),
                    drilldown: null
                },
                {
                    name: "AAQOO SINCH",
                    y: parseFloat(kannel_queue.Aaqoo_Sinch),
                    drilldown: null
                },
                {
                    name: "AAQOO CMS3",
                    y: parseFloat(kannel_queue.AAQOOCMS3),
                    drilldown: null
                },
                {
                    name: "CMT AQOO",
                    y: parseFloat(kannel_queue.CMT_AQOO),
                    drilldown: null
                },
                {
                    name: "SC 7005",
                    y: parseFloat(kannel_queue.SC_7005),
                    drilldown: null
                }
            ]
        }
    ],
});

var gaugeOptions = {
    chart: {
        type: 'solidgauge'
    },

    title: null,

    pane: {
        center: ['50%', '85%'],
        size: '140%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    exporting: {
        enabled: false
    },

    tooltip: {
        enabled: false
    },

    // the value axis
    yAxis: {
        stops: [
            [0.1, '#55BF3B'], // green
            [0.5, '#DDDF0D'], // yellow
            [0.9, '#DF5353'] // red
        ],
        lineWidth: 0,
        tickWidth: 0,
        minorTickInterval: null,
        tickAmount: 2,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
};

// The speed gauge
var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 200,
        title: {
            text: 'Speed'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [80],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y}</span><br/>' +
                '<span style="font-size:12px;opacity:0.4">km/h</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

}));

// The speed gauge
var chartSpeed = Highcharts.chart('container-speed-2', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 200,
        title: {
            text: 'Speed'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [80],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y}</span><br/>' +
                '<span style="font-size:12px;opacity:0.4">km/h</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

}));

</script>
@endsection
