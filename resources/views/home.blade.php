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
    <div class="col-md-4">
        <figure class="highcharts-figure">
                    <div id="kannel_tps">
                        
                    </div>
        </figure>
    </div>
    <div class="col-md-4">
         <figure class="highcharts-figure">
                    <div id="kannel_queue">
                        
                    </div>
        </figure>
    </div>


      <div class="col-md-4">
         <figure class="highcharts-figure">
                    <div id="redis_stat">
                        
                    </div>
        </figure>
    </div>

    <div class="col-md-4">
         <figure class="highcharts-figure">
                    <div id="mysql_seconds_behind">
                        
                    </div>
        </figure>
    </div>

    <div class="col-md-4">
         <figure class="highcharts-figure">
                    <div id="kannel_smppbox_port_check">
                        
                    </div>
        </figure>
    </div>


    <div class="col-md-4">
        <figure class="highcharts-figure">
                   <div id="sinch_counts">
                       
                   </div>
       </figure>
   </div>

    <div class="col-md-4">
         <figure class="highcharts-figure">
                    <div id="smpp_links">
                        
                    </div>
        </figure>
    </div>

    <div class="col-md-4">
        <figure class="highcharts-figure-solid">
            <div id="container-speed" class="chart-container-solid"></div>
        </figure>
    </div>

    <div class="col-md-4">
        <figure class="highcharts-figure-solid">
            <div id="container-speed-2" class="chart-container-solid"></div>
        </figure>
    </div>
    
</div>


<script>
 var sinch_counts = <?php echo json_encode($sinch_counts);?> ;
    // Create the chart

    console.log(sinch_counts)
Highcharts.chart('sinch_counts', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Sinch Counts'
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
            text: 'Counts'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    series: [
        {
            name: "Sinch",
            colorByPoint: true,
            data: [
                {
                    name: "SINCH DELIVERED TODAY",
                    y: parseInt(sinch_counts.SINCH_DELIVERED_TODAY),
                    drilldown: null
                },
                {
                    name: "SINCH UNDELIVERED TODAY",
                    y: parseInt(sinch_counts.SINCH_UNDELIVERED_TODAY),
                    drilldown: null
                },
                {
                    name: "SINCH EXPIRED TODAY",
                    y: parseInt(sinch_counts.SINCH_EXPIRED_TODAY),
                    drilldown: null
                },
                {
                    name: "SINCH DELIVERED YESTERDAY",
                    y: parseInt(sinch_counts.SINCH_DELIVERED_YESTERDAY),
                    drilldown: null
                },
                {
                    name: "SINCH UN-DELIVERED YESTERDAY",
                    y: parseInt(sinch_counts.SINCH_UNDELIVERED_YESTERDAY),
                    drilldown: null
                },
                {
                    name: "SINCH EXPIRED YESTERDAY",
                    y: parseInt(sinch_counts.SINCH_EXPIRED_YESTERDAY),
                    drilldown: null
                }
                
            ]
        }
    ],
});

    // window.location.reload(true);
    // setTimeout(function () {
    //     location.reload()
    // }, 5000);
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
            name: "Kannels Tps",
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
            name: "Kannels Queue",
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

var smpp_links = <?php echo json_encode($smpp_links);?> ;

 var data_smpp_links = [];


for (index = 0; index < smpp_links.length; ++index) {
    value = 0;
    if((smpp_links[index].RESULT) == 'UP')
    {
        value = 1;
    }
    var object =  {
                    name: smpp_links[index].LA_Name+'<br>'+smpp_links[index].IP_Port,
                    y: value,
                    drilldown: null
                } 
                
         this.data_smpp_links.push(object);       
}


 console.log(smpp_links)

Highcharts.chart('smpp_links', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'SMPP Links'
    },
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
            text: 'RESULT'
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
            }
        }
    },
    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: data_smpp_links
        }
    ],
});

var kannel_smppbox_port_check = <?php echo json_encode($kannel_smppbox_port_check);?> ;

 var data_kannel_smppbox_port_check = [];


for (index = 0; index < kannel_smppbox_port_check.length; ++index) {
    value = 0;
    if((kannel_smppbox_port_check[index].RESULT) == true)
    {
        value = 1;
    }
    var object =  {
                    name: kannel_smppbox_port_check[index].REDIS_IP,
                    y: value,
                    drilldown: null
                } 
                
         this.data_kannel_smppbox_port_check.push(object);       
}


 console.log(kannel_smppbox_port_check)

Highcharts.chart('kannel_smppbox_port_check', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Kannel Smppbox Port Check'
    },
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
            text: 'RESULT'
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
            }
        }
    },
    series: [
        {
            name: "Kannels SMPP",
            colorByPoint: true,
            data: data_kannel_smppbox_port_check
        }
    ],
});


var mysql_seconds_behind = <?php echo json_encode($mysql_seconds_behind);?> ;

 var data_mysql_seconds_behind = [];


for (index = 0; index < mysql_seconds_behind.length; ++index) {
    var object =  {
                    name: mysql_seconds_behind[index].SLAVE_IP,
                    y: parseInt(mysql_seconds_behind[index].RESULT),
                    drilldown: null
                } 

         this.data_mysql_seconds_behind.push(object);       
}


 console.log(mysql_seconds_behind)

Highcharts.chart('mysql_seconds_behind', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Mysql Seconds Behind'
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
            text: 'RESULT'
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
            name: "Mysql Seconds Behind",
            colorByPoint: true,
            data: data_mysql_seconds_behind
        }
    ],
});

 var redis_stats = <?php echo json_encode($redis_stats);?> ;

 var data_redis = [];


for (index = 0; index < redis_stats.length; ++index) {
    var object =  {
                    name: redis_stats[index].REDIS_IP,
                    y: parseInt(redis_stats[index].TPS),
                    drilldown: null
                } 

         this.data_redis.push(object);       
}


 console.log(redis_stats)

Highcharts.chart('redis_stat', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Redis Stats'
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
            text: 'TPS'
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
            name: "Redis Stats",
            colorByPoint: true,
            data: data_redis
        }
    ],
});


var api_link = JSON.parse('<?php echo json_encode($api_link);?>');


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
            [0, '#EEE'], // green
            [1, '#55BF3B']
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

var guage_api_link = 0;

if (api_link.RESULT == "UP") {
this.guage_api_link = 1;
}
else {
  this.guage_api_link = 0;  
}

// The speed gauge
var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'Api Link :' + api_link.IP_Port
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [this.guage_api_link],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">'+api_link.RESULT+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));

// The speed gauge
var chartSpeed = Highcharts.chart('container-speed-2', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
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
