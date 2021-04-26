@extends('layouts.app')

@section('content')

<style type="text/css">

    .highcharts-figure-solid .chart-container-solid {
    width: 300px;
    height: 200px;
   
}

::selection{
    background: #F22F46;
    color: #fff;
}



</style>
<div class="container">
<div class="row">


    @if(!empty($kannel_tps))

    <div class="col-md-6">
        <figure class="highcharts-figure">
        <div class="card">
  <div style="background-color: #fcf4a7;" class="card-body">
                    <div id="kannel_tps">
                        
                    </div>
  </div>
        </div>
        </figure>
    </div>

  
    @endif
   
    <div class="col-md-6">
         <figure class="highcharts-figure">
         <div class="card">
  <div style="background-color: #fcf4a7;" class="card-body">
                    <div id="kannel_queue">
                        
                    </div>
  </div>
         </div>
        </figure>
    </div>


      <div class="col-md-6">
         <figure class="highcharts-figure">
         <div class="card">
  <div class="card-body">
                    <div id="redis_stat">
                        
                    </div>
  </div>
         </div>
        </figure>
    </div>

    <div class="col-md-6">
         <figure class="highcharts-figure">
         <div class="card">
  <div class="card-body">
                    <div id="mysql_seconds_behind">
                        
                    </div>
  </div>
         </div>
        </figure>
    </div>

 


    <div class="col-md-12">
        <figure class="highcharts-figure">
        <div class="card">
  <div style="background-color: #fcf4a7;" class="card-body">
                   <div id="sinch_stats">
                       
                   </div>
  </div>
        </div>
       </figure>
   </div>

   <div class="col-md-12">
    <figure class="highcharts-figure">
    <div class="card">
  <div class="card-body">
               <div id="sinch_hourly_stats">
                   
               </div>
  </div>
    </div>
   </figure>
</div>



    
</div>

</div>

<script>
//get notifications
function load_unseen_notification(view = '')
    {
     $.ajax({
      url: "{{route('noti')}}",
      method:"GET",
      dataType:"json",
      success:function(data)
      {
          console.log(data);
       $('.noti').html(data.notification);
       if(data.unseen_notification > 0)
       {
        $('.count').html(data.unseen_notification);
       }
      }
     });
    }
    load_unseen_notification();
    setInterval(load_unseen_notification, 5000);

    //updating notification seen status
    function updatenotificationcount(view = '')
    {
     $.ajax({
      url: "{{route('readnoti')}}",
      method:"GET",
      dataType:"json",
      success:function(data)
      {
          console.log(data);
          $('.count').html('');
          load_unseen_notification();
      }
     });
    }
window.onload = function() { mysql_second_behind_test(); redis_test(); kannel_tps_test(); kannel_queue_test(); sinch_stats_update();}

var global1 = new Array();
var global2 = new Array();
var global3 = new Array();

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


var values_undelivered = new Array();
var temp_delivered = []
var keys_delivered_test = []
var values_delivered_test = []
var keys_total_test = []
var values_total_test = []


for(let i=0; i<sinch_stats.DELIVERED.length; i++){ 

   this.keys_delivered_test.push(Object.keys(sinch_stats.DELIVERED[i]));
   this.values_delivered_test.push(Object.values(sinch_stats.DELIVERED[i]));
  
}
for(let i=0; i<sinch_stats.TOTAL.length; i++){
    
   
    this.keys_total_test.push(Object.keys(sinch_stats.TOTAL[i]));
    this.values_total_test.push(Object.values(sinch_stats.TOTAL[i]));
    
 }



for(let i=0; i<keys_delivered_test.length; i++) {
    var temp = values_total_test[i] - values_delivered_test[i];
    this.values_undelivered.push(temp);
}



var values_total = [];
values_total_test.forEach(element => {

    values_total.push(parseInt(element))

});
var values_delivered = [];
values_delivered_test.forEach(element => {

    values_delivered.push(parseInt(element))

});




function sinch_stats_update(){
    setInterval(function(){    $.ajax({
        url: '{{route('sinch_stats')}}',
        type: 'GET',
        dataType: 'json',
        success: function(sinch_stats) {
 
            var values_undelivered = new Array();
var temp_delivered = []
var keys_delivered_test = []
var values_delivered_test = []
var keys_total_test = []
var values_total_test = []


for(let i=0; i<sinch_stats.DELIVERED.length; i++){ 

   keys_delivered_test.push(Object.keys(sinch_stats.DELIVERED[i]));
   values_delivered_test.push(Object.values(sinch_stats.DELIVERED[i]));

}
for(let i=0; i<sinch_stats.TOTAL.length; i++){
    
   
    keys_total_test.push(Object.keys(sinch_stats.TOTAL[i]));
    values_total_test.push(Object.values(sinch_stats.TOTAL[i]));
 
 }





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





 

    sinch_stats_graph.xAxis[0].setCategories(keys_total_test);
    sinch_stats_graph.series[0].setData(values_total)
    sinch_stats_graph.series[1].setData(values_delivered)
    sinch_stats_graph.series[2].setData(values_undelivered)


   

        },
      error: function (request, status, error) {

      }
    }); }, 1000 * 60 * 60 * 24);
}

console.log(this.keys_total_test)

var sinch_stats_graph = Highcharts.chart('sinch_stats', {
    
    chart: {
        type: 'column',
        backgroundColor: '#fcf4a7'
    },
    credits: {
           text: '',
           href: ''
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
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

    series: [{
        name: 'Total',
        data: values_total,
        color: '#a30000'

    }, {
        name: 'Delivered',
        data: values_delivered,
        color: '#000000'


    }, {
        name: 'Un-delivered',
        data: values_undelivered,
        color: '#8f8f8f'


    }]
});

var sinch_hourly_stats = <?php echo json_encode($sinch_hourly_stats);?> ;
// console.log('sinch hourly')
console.log(sinch_hourly_stats)
var time = ["00:00:00","01:00:00","02:00:00","03:00:00","04:00:00","05:00:00","06:00:00","07:00:00","08:00:00","09:00:00","10:00:00","11:00:00","12:00:00","13:00:00","14:00:00","15:00:00","16:00:00","17:00:00","18:00:00","19:00:00","20:00:00","21:00:00","22:00:00","23:00:00"]
var keys = new Array()
var values1 = new Array()
var values2 = new Array()
var values3 = new Array()


// sinch_hourly_stats.forEach(element => {
//      console.log(element)
//     keys.push(Object.keys(element).toString());
//     // values.push(Object.values(element).toString());

// });

var day_date = '';
for (let x=0; x<24; x++){
    // console.log('here')
    // console.log(sinch_hourly_stats[x]);
    keys.push(Object.keys(sinch_hourly_stats[x]).toString());
    values1.push(parseInt(Object.values(sinch_hourly_stats[x])));
    // console.log('endhere')
    var strArray = keys[0].split(" ");
    day_date = strArray[0];
    console.log(day_date)
    }

    var object1 = {
    date: day_date,
    hours:  values1
    }

    for (let x=24; x<48; x++){
  
    this.keys = [];

    keys.push(Object.keys(sinch_hourly_stats[x]).toString());
    values2.push(parseInt(Object.values(sinch_hourly_stats[x])));

    var strArray = keys[0].split(" ");
    day_date = strArray[0];
    console.log(day_date)
    }

    var object2 = {
    date: day_date,
    hours:  values2
    }   

    for (let x=48; x<sinch_hourly_stats.length; x++){
        this.keys = [];

    keys.push(Object.keys(sinch_hourly_stats[x]).toString());
    values3.push(parseInt(Object.values(sinch_hourly_stats[x])));
    var strArray = keys[0].split(" ");
    day_date = strArray[0];
    console.log(day_date)
    }

    var object3 = {
    date: day_date,
    hours:  values3
    }   



// console.log(values1)
// console.log(keys)
// console.log(values)
// var strArray = keys[23].split(" ");
// console.log(strArray)
// var object1 = {
//     date: "21-04-2021",
//     hours:  [25116, 30250, 42777, 27261, 27017, 65024, 35299, 36509, 77349, 76485, 39219, 38413, 79025, 80168, 76897, 70095,85313, 95366, 87793, 83930, 67762, 50122, 37413, 29284]
//     }
// var object2 = {
//     date: "22-04-2021",
//     hours: [25116, 30250, 42777, 27261, 27017, 65024, 35299, 36509, 77349, 76485, 39219, 38413, 79025, 80168, 76897, 70095,85313, 95366, 87793, 83930, 67762, 50122, 37413, 29284]
// };
// var object3 = {
//     date: "23-04-2021",
//     hours:  [25116, 30250, 42777, 27261, 27017, 65024, 35299, 36509, 77349, 76485, 39219, 38413, 79025, 80168, 76897, 70095,85313, 95366, 87793]
// };

var data_testing = new Array();
 data_testing.push(object1)
data_testing.push(object2)
data_testing.push(object3)


var categorie = []
var new_hours = []

data_testing.forEach(element => {
    categorie.push(element.date)
    new_hours.push(element.hours)
});


series_array = []

var series_obj = {
        name: categorie[0],
        data: new_hours[0]
    }
    var series_obj1 = {
        name: categorie[1],
        data: new_hours[1]
    }
    var series_obj2 = {
        name: categorie[2],
        data: new_hours[2]
    }
series_array.push(series_obj)
series_array.push(series_obj1)
series_array.push(series_obj2)

console.log(series_array)

// sinch_hourly_stats.forEach(element => {
//      console.log(element)
//     keys.push(Object.keys(element).toString());
//     values.push(Object.values(element).toString());

// });
// console.log(keys)
// console.log(values)
// var strArray = keys[0].split(" ");
// console.log(strArray)




var sinch_stats_graph = Highcharts.chart('sinch_hourly_stats', {
    chart: {
        type: 'column'
    },
    credits: {
           text: '',
           href: ''
       },
    title: {
        text: 'Sinch Hourly Stats'
    },
    xAxis: {
        categories: time,
        crosshair: true,
        scrollbar: {
      enabled: true
    }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Values (per hour)'
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
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

    series: series_array
});


//sinch_hourly_stats_ends
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
    }); }, 30000);
    
 
}

    // Create the chart
var kannel_graph_tps = Highcharts.chart('kannel_tps', {
    chart: {
        type: 'column',
        backgroundColor: '#fcf4a7'

    },
    credits: {
           text: '',
           href: ''
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
    }); }, 30000);
    
 
}


var kannel_graph_queue = Highcharts.chart('kannel_queue', {
    chart: {
        type: 'column',
        backgroundColor: '#fcf4a7'

    },
    credits: {
           text: '',
           href: ''
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
    }); }, 30000);
    
 
}


var mysql_second_test = Highcharts.chart('mysql_seconds_behind', {
    chart: {
        type: 'column'
    },
    credits: {
           text: '',
           href: ''
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
    }); }, 30000);
    
 
}



var redis_stat_test = Highcharts.chart('redis_stat', {
    chart: {
        type: 'column'
    },
    credits: {
           text: '',
           href: ''
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
