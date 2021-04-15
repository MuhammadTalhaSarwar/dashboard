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
<div class="container-fluid">
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
                   <div id="sinch_counts">
                       
                   </div>
       </figure>
   </div>



    
</div>
//usama code
<div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">API LINKS</h5>
          <figure class="highcharts-figure-solid">
              <div id="container-speed" class="chart-container-solid"></div>
          </figure>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
      <?php foreach ($kannel_smppbox_port_check as $key => $value) {        ?>
  
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Kannel Smppbox Port Check</h5>
          <figure class="highcharts-figure-solid">
              <div id="<?php echo($key);?>" class="chart-container-solid"></div>
              </figure>
        </div>
      </div>
    </div>
       <?php   }    ?>
  </div>
  <div class="row">
      <?php foreach ($smpp_links as $key => $value) {        ?>
  
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">SMPP Links</h5>
          <figure class="highcharts-figure-solid">
              <div id="<?php echo('smpp'.$key);?>" class="chart-container-solid"></div>
              </figure>
        </div>
      </div>
    </div>
       <?php   }    ?>
  </div>
  <div class="row">
  
      <?php foreach ($linksStatus as $key => $value) {    ?>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">USSD1 LINK STATUS</h5>
          <figure class="highcharts-figure-solid">
              <div id="<?php echo ('ussd'.$key);?>" class="chart-container-solid"></div>
              </figure>
        </div>
      </div>
    </div>
       <?php   }  ?>
  </div>
  <div class="row">
  
      <?php foreach ($pointCodesStatus as $key => $value) {     ?>
  
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">USSD1 Point Codes Status</h5>
          <figure class="highcharts-figure-solid">
              <div id="<?php echo ('code'.$key);?>" class="chart-container-solid"></div>
              </figure>
        </div>
      </div>
    </div>
       <?php   }  ?>
  </div>
  <div class="row">
  
      <?php foreach ($linksStatus2 as $key => $value) { ?>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">USSD2 LINK STATUS</h5>
          <figure class="highcharts-figure-solid">
              <div id="<?php echo ('ussd2'.$key);?>" class="chart-container-solid"></div>
              </figure>
        </div>
      </div>
    </div>
       <?php   } ?>
   </div>
  <div class="row">
  
      <?php foreach ($pointCodesStatus2 as $key => $value) {?>
  
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">USSD2 Point Codes Status</h5>
          <figure class="highcharts-figure-solid">
              <div id="<?php echo ('code2'.$key);?>" class="chart-container-solid"></div>
              </figure>
        </div>
      </div>
    </div>
       <?php   } ?>
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

// $(document).ready(function(){
//   $("button").click(function(){
//     $("p").slideToggle();
//   });
// });







var kannel_tps = <?php echo json_encode($kannel_tps);?> ;

var kannel_tps_data = [];


var keys = Object.keys(kannel_tps);
var values = Object.values(kannel_tps);


for (index = 0; index < keys.length; index++) {
  
    var object =  {
                    name: keys[index],
                    y: parseFloat(values[index]),
                    drilldown: null
                } 
                
         this.kannel_tps_data.push(object);       
}


function kannel_tps_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('kannel_tps')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
      console.log('kannel ajax')
      console.log(res)
            data = []
            var keys = Object.keys(res);
            var values = Object.values(res);


        for (index = 0; index < keys.length; index++) {
  
                    var object =  {
                    name: keys[index],
                    y: parseFloat(values[index]),
                    drilldown: null
                } 
                
         data.push(object);       
}
    this.kannel_tps_data = data;
            // alert(res);
            // console.log(redis_stat_test.series[d])
            kannel_graph_tps.series[0].setData(this.kannel_tps_data);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        alert(request.responseText);
      }
    }); }, 2000);
    
 
}

    // Create the chart
var kannel_graph_tps = Highcharts.chart('kannel_tps', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Kannel Tps'
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
            data: kannel_tps_data
        }
    ],
});

 var kannel_queue = <?php echo json_encode($kannel_queue);?> ;

 var kannel_queue_data = [];


var keys = Object.keys(kannel_queue);
var values = Object.values(kannel_queue);


for (index = 0; index < keys.length; index++) {
  
    var object =  {
                    name: keys[index],
                    y: parseFloat(values[index]),
                    drilldown: null
                } 
                
         this.kannel_queue_data.push(object);       
}


function kannel_queue_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('kannel_queue')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
      console.log('kannel queue ajax')
      console.log(res)
            data = []
            var keys = Object.keys(res);
            var values = Object.values(res);


        for (index = 0; index < keys.length; index++) {
  
                    var object =  {
                    name: keys[index],
                    y: parseFloat(values[index]),
                    drilldown: null
                } 
                
         data.push(object);       
}
    this.kannel_queue_data = data;
            // alert(res);
            // console.log(redis_stat_test.series[d])
            kannel_graph_queue.series[0].setData(this.kannel_queue_data);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        alert(request.responseText);
      }
    }); }, 2000);
    
 
}










var kannel_graph_queue = Highcharts.chart('kannel_queue', {
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
            data: kannel_queue_data
        }
    ],
});





var mysql_seconds_behind = <?php echo json_encode($mysql_seconds_behind);?> ;

 var data_mysql_seconds_behind = [];


for (index = 0; index < mysql_seconds_behind.length; index++) {
    var object =  {
                    name: mysql_seconds_behind[index].SLAVE_IP,
                    y: parseInt(mysql_seconds_behind[index].RESULT),
                    drilldown: null
                } 

         this.data_mysql_seconds_behind.push(object);       
}


 console.log(mysql_seconds_behind)

 function mysql_second_behind_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('mysql_behind')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log('danish sql')
            console.log(res);
            data = []
            for (index = 0; index < res.length; index++) {
    var obj =  {
                    name: res[index].SLAVE_IP,
                    y: parseInt(res[index].RESULT),
                    drilldown: null
                } 

         data.push(obj);       
}
    this.data_mysql_seconds_behind = data;
            // alert(res);
            // console.log(redis_stat_test.series[d])
            mysql_second_test.series[0].setData(this.data_mysql_seconds_behind);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        alert(request.responseText);
      }
    }); }, 2000);
    
 
}


var mysql_second_test = Highcharts.chart('mysql_seconds_behind', {
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


for (index = 0; index < redis_stats.length; index++) {
    var object =  {
                    name: redis_stats[index].REDIS_IP,
                    y: parseInt(redis_stats[index].TPS),
                    drilldown: null
                } 

         this.data_redis.push(object);       
}


 console.log(redis_stats)



 function redis_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('redis_stats')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log('danish')
            console.log(res);
            data = []
            for (index = 0; index < res.length; index++) {
    var obj =  {
                    name: res[index].REDIS_IP,
                    y: parseInt(res[index].TPS),
                    drilldown: null
                } 

         data.push(obj);       
}
    this.data_redis = data;
            // alert(res);
            // console.log(redis_stat_test.series[d])
            redis_stat_test.series[0].setData(this.data_redis);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        alert(request.responseText);
      }
    }); }, 2000);
    
 
}



var redis_stat_test = Highcharts.chart('redis_stat', {
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

//the smpp guages
var kannel_smppbox_port_checkk = <?php echo json_encode($kannel_smppbox_port_check);?> ;

 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < kannel_smppbox_port_checkk.length; index++) {
    value = 0;
    link = "Down";
    if((kannel_smppbox_port_checkk[index].RESULT) == true)
    {
        value = 1;
        link = "UP";
    }
    console.log(value);

    var chartSpeed = Highcharts.chart(''+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'Redis IP :' + kannel_smppbox_port_checkk[index].REDIS_IP,
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [value],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">'+link+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));
}

//ussd
var ussd = <?php echo json_encode($linksStatus);?> ;

 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < ussd.length; index++) {
    value = 0;
    link = "Down";
    if((ussd[index].status) == "UP")
    {
        value = 1;
        link = "UP";
    }
    console.log(value);

    var chartSpeed = Highcharts.chart('ussd'+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'LINK STATUS IP :' + ussd[index].ip +' Port :'+ ussd[index].port +'<br>' ,
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [value],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">'+link+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));
}

//code
var code = <?php echo json_encode($pointCodesStatus);?> ;

 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < code.length; index++) {
    value = 0;
    link = "INACCESSIBLE";
    if((code[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = 1;
        link = "ACCESSIBLE";
    }
    console.log(value);

    var chartSpeed = Highcharts.chart('code'+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'Point Code :' + code[index].pointCode ,
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [value],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">'+link+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));
}

//ussd2
var ussd2 = <?php echo json_encode($linksStatus2);?> ;

 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < ussd2.length; index++) {
    value = 0;
    link = "Down";
    if((ussd2[index].status) == "UP")
    {
        value = 1;
        link = "UP";
    }
    console.log(value);

    var chartSpeed = Highcharts.chart('ussd2'+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'LINK STATUS IP :' + ussd2[index].ip +' Port :'+ ussd2[index].port +'<br>' ,
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [value],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">'+link+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));
}

//code
var code2 = <?php echo json_encode($pointCodesStatus2);?> ;

 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < code2.length; index++) {
    value = 0;
    link = "INACCESIBBLE";
    if((code2[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = 1;
        link = "ACCESSIBLE";
    }
    console.log(value);

    var chartSpeed = Highcharts.chart('code2'+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'Point Code :' + code2[index].pointCode ,
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [value],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">'+link+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));
}

//smpp_links
var smpp = <?php echo json_encode($smpp_links);?> ;

 // var data_kannel_smppbox_port_check = [];

 function smpp_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('smpp_links')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log('smppdanish')
            console.log(res);
            data = []
            for (index = 0; index < res.length; index++) {
             
    value = [0];
    link = "DOWN";
    if((res[index].RESULT) == "UP")
    {
        value = [1];
        link = "UP";
    }


    smpp_test[index].series[0].setData(value);
        
}

        },
      error: function (request, status, error) {
        alert(request.responseText);
      }
    }); }, 2000);
    
 
}

window.onload = function() { mysql_second_behind_test(); redis_test(); kannel_tps_test(); kannel_queue_test(); smpp_test(); }
 //
 var smpp_test = new Array();
 for (index = 0; index < smpp.length; index++) {
    value = 0;
    link = "DOWN";
    if((smpp[index].RESULT) == "UP")
    {
        value = 1;
        link = "UP";
    }
    console.log(value);
    
    
    smpp_test[index] = Highcharts.chart('smpp'+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'LA NAME :' + smpp[index].LA_Name +'PORT :'+smpp[index].IP_Port ,
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [value],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">'+link+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));


}



</script>
@endsection
