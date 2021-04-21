@extends('layouts.app')

@section('content')

<style type="text/css">
    .highcharts-figure-solid .chart-container-solid {
    width: 300px;
    height: 200px;
   
}




</style>
<div class="container">
<div class="row">


    @if(!empty($kannel_tps))
    <div class="col-md-6">
        <figure class="highcharts-figure">
                    <div id="kannel_tps">
                        
                    </div>
        </figure>
    </div>

  
    @endif
   
    <div class="col-md-6">
         <figure class="highcharts-figure">
                    <div id="kannel_queue">
                        
                    </div>
        </figure>
    </div>


      <div class="col-md-6">
         <figure class="highcharts-figure">
                    <div id="redis_stat">
                        
                    </div>
        </figure>
    </div>

    <div class="col-md-6">
         <figure class="highcharts-figure">
                    <div id="mysql_seconds_behind">
                        
                    </div>
        </figure>
    </div>

 


    <div class="col-md-12">
        <figure class="highcharts-figure">
                   <div id="sinch_stats">
                       
                   </div>
       </figure>
   </div>



    
</div>

</div>

<script>

window.onload = function() { mysql_second_behind_test(); redis_test(); kannel_tps_test(); kannel_queue_test(); sinch_stats_update();}


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
                Highcharts.defaultOptions.legend.backgroundColor || '#DF5353',
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
            [0, '#DF5353'], // green
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

 var sinch_stats = <?php echo json_encode($sinch_stats);?>;
console.log('danish');
// console.log(sinch_stats.DELIVERED)

var values_undelivered = new Array();
var temp_delivered = []
var keys_delivered_test = []
var values_delivered_test = []
var keys_total_test = []
var values_total_test = []


for(let i=0; i<sinch_stats.DELIVERED.length; i++){ 
//    console.log(sinch_stats.DELIVERED[i])
   this.keys_delivered_test.push(Object.keys(sinch_stats.DELIVERED[i]));
   this.values_delivered_test.push(Object.values(sinch_stats.DELIVERED[i]));
    // this.values_undelivered.push(temp);
}
for(let i=0; i<sinch_stats.TOTAL.length; i++){
    
    // console.log(sinch_stats.TOTAL[i])
    this.keys_total_test.push(Object.keys(sinch_stats.TOTAL[i]));
    this.values_total_test.push(Object.values(sinch_stats.TOTAL[i]));
     // this.values_undelivered.push(temp);
 }



// var keys_delivered = Object.keys(temp_delivered);
// var values_delivered = Object.values(temp_delivered);
// var keys_total = Object.keys(sinch_stats.TOTAL);
// var values_total = Object.values(sinch_stats.TOTAL);

for(let i=0; i<keys_delivered_test.length; i++) {
    var temp = values_total_test[i] - values_delivered_test[i];
    this.values_undelivered.push(temp);
}



var values_total = [];
values_total_test.forEach(element => {
    // console.log(parseInt(element))
    values_total.push(parseInt(element))

});
var values_delivered = [];
values_delivered_test.forEach(element => {
    // console.log(parseInt(element))
    values_delivered.push(parseInt(element))

});

function sinch_stats_update(){
    setInterval(function(){    $.ajax({
        url: '{{route('sinch_stats')}}',
        type: 'GET',
        dataType: 'json',
        success: function(sinch_stats) {
            // console.log(sinch_stats) 
            var values_undelivered = new Array();
var temp_delivered = []
var keys_delivered_test = []
var values_delivered_test = []
var keys_total_test = []
var values_total_test = []


for(let i=0; i<sinch_stats.DELIVERED.length; i++){ 
//    console.log(sinch_stats.DELIVERED[i])
   keys_delivered_test.push(Object.keys(sinch_stats.DELIVERED[i]));
   values_delivered_test.push(Object.values(sinch_stats.DELIVERED[i]));
    // this.values_undelivered.push(temp);
}
for(let i=0; i<sinch_stats.TOTAL.length; i++){
    
    // console.log(sinch_stats.TOTAL[i])
    keys_total_test.push(Object.keys(sinch_stats.TOTAL[i]));
    values_total_test.push(Object.values(sinch_stats.TOTAL[i]));
     // this.values_undelivered.push(temp);
 }



// var keys_delivered = Object.keys(temp_delivered);
// var values_delivered = Object.values(temp_delivered);
// var keys_total = Object.keys(sinch_stats.TOTAL);
// var values_total = Object.values(sinch_stats.TOTAL);

for(let i=0; i<keys_delivered_test.length; i++) {
    var temp = values_total_test[i] - values_delivered_test[i];
    values_undelivered.push(temp);
}



var values_total = [];
values_total_test.forEach(element => {
    // console.log(parseInt(element))
    values_total.push(parseInt(element))

});
var values_delivered = [];
values_delivered_test.forEach(element => {
    // console.log(parseInt(element))
    values_delivered.push(parseInt(element))

});
    sinch_stats_data = [];
    var object3 =  {
        name: 'Total',
        data: values_total

    }
    var object1 = {
        name: 'Delivered',
        data: values_delivered

    }
    var object2 =  {
        name: 'Un-delivered',
        data: values_undelivered

    }


    console.log(values_total)
    console.log(values_undelivered)
    console.log(values_delivered)
    sinch_stats_data.push(object3)
    sinch_stats_data.push(object1)
    sinch_stats_data.push(object2)


    // console.log(keys_total_test)
    // console.log(sinch_stats_data)

    sinch_stats_graph.xAxis[0].setCategories(keys_total_test);
    sinch_stats_graph.series[0].setData(this.sinch_stats_data);
   

        },
      error: function (request, status, error) {

      }
    }); }, 5000);
}

var sinch_stats_graph = Highcharts.chart('sinch_stats', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Sinch Stats'
    },
    xAxis: {
        categories: this.keys_total_test,
        crosshair: true,
        scrollbar: {
      enabled: true
    }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Values (per day)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Total',
        data: values_total

    }, {
        name: 'Delivered',
        data: values_delivered

    }, {
        name: 'Un-delivered',
        data: values_undelivered

    }]
});






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
        dataType: 'json',
        success: function(res) { 

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

            kannel_graph_tps.series[0].setData(this.kannel_tps_data);

        },
      error: function (request, status, error) {

      }
    }); }, 5000);
    
 
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
        dataType: 'json', 
        success: function(res) { 

            data = []
            var keys = Object.keys(res);
            var values = Object.values(res);


        for (index = 0; index < keys.length; index++) {
  
                    var object = {
                    name: keys[index],
                    y: parseFloat(values[index]),
                    drilldown: null
                } 
                
         data.push(object);       
}
    this.kannel_queue_data = data;
            kannel_graph_queue.series[0].setData(this.kannel_queue_data);
        },
      error: function (request, status, error) {

      }
    }); }, 5000);
    
 
}


var kannel_graph_queue = Highcharts.chart('kannel_queue', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Kannel Queue'
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

 function mysql_second_behind_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('mysql_behind')}}',
        type: 'GET',
        dataType: 'json',
        success: function(res) { 

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
            mysql_second_test.series[0].setData(this.data_mysql_seconds_behind);

        },
      error: function (request, status, error) {
      }
    }); }, 5000);
    
 
}


var mysql_second_test = Highcharts.chart('mysql_seconds_behind', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Mysql Seconds Behind'
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
 function redis_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('redis_stats')}}',
        type: 'GET',
        dataType: 'json',
        success: function(res) { 

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
            redis_stat_test.series[0].setData(this.data_redis);
        },
      error: function (request, status, error) {
      }
    }); }, 5000);
    
 
}



var redis_stat_test = Highcharts.chart('redis_stat', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Redis Stats'
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


</script>
@endsection
