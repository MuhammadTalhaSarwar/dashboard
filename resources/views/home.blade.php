@extends('layouts.app')

@section('content')

<style type="text/css">
    .highcharts-figure-solid .chart-container-solid {
    width: 300px;
    height: 200px;
   
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

    <div class="col-md-6">
         <figure class="highcharts-figure">
                    <div id="mysql_seconds_behind">
                        
                    </div>
        </figure>
    </div>

 


    <div class="col-md-6">
        <figure class="highcharts-figure">
                   <div id="sinch_counts">
                       
                   </div>
       </figure>
   </div>



    
</div>


<table class="table table-bordered">
    <thead>
      <tr>
        <th>Api Link</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="row"><div class="card">
         <figure class="highcharts-figure-solid">
    <div id="api_links" class="chart-container-solid"></div>
        </figure></div></div></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Kannel Smppbox Port Check</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="row">
            <?php foreach ($kannel_smppbox_port_check as $key => $value) {        ?>
       
            <div class="card">
                <figure class="highcharts-figure-solid">
                    <div id="<?php echo($key);?>" class="chart-container-solid"></div>
                    </figure>
             
            </div>
          
             <?php   }    ?>
        </div></td>
      </tr>
    </tbody>
  </table>


  <table class="table table-bordered">
    <thead>
      <tr>
        <th>SMPP Links</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><div class="row">
            <?php foreach ($smpp_links as $key => $value) {        ?>
        
          
            <div class="card">
             
                <figure class="highcharts-figure-solid">
                    <div id="<?php echo('smpp'.$key);?>" class="chart-container-solid"></div>
                    </figure>
         
          </div>
             <?php   }    ?>
        </div></td>
      </tr>
    </tbody>
  </table>



  <table class="table table-bordered">
    <thead>
      <tr>
        <th>USSD1 LINK STATUS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>  <div class="row">
  
            <?php foreach ($linksStatus as $key => $value) {    ?>
      
            <div class="card">
      
                <figure class="highcharts-figure-solid">
                    <div id="<?php echo ('ussd'.$key);?>" class="chart-container-solid"></div>
                    </figure>
          
          </div>
             <?php   }  ?>
        </div></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>USSD1 Point Codes Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>  <div class="row">
  
            <?php foreach ($pointCodesStatus as $key => $value) {     ?>
        
         
            <div class="card">
        
              
                <figure class="highcharts-figure-solid">
                    <div id="<?php echo ('code'.$key);?>" class="chart-container-solid"></div>
                    </figure>
         
          </div>
             <?php   }  ?>
        </div></td>
      </tr>
    </tbody>
  </table>


  <table class="table table-bordered">
    <thead>
      <tr>
        <th>USSD2 LINK STATUS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
            <div class="row">
            
                <?php foreach ($linksStatus2 as $key => $value) { ?>
           
                <div class="card">
               
               
                    <figure class="highcharts-figure-solid">
                        <div id="<?php echo ('ussd2'.$key);?>" class="chart-container-solid"></div>
                        </figure>
              
              </div>
                 <?php   } ?>
             </div></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>USSD2 Point Codes Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          
  <div class="row">
  
    <?php foreach ($pointCodesStatus2 as $key => $value) {?>


    <div class="card">
    
     
        <figure class="highcharts-figure-solid">
            <div id="<?php echo ('code2'.$key);?>" class="chart-container-solid"></div>
            </figure>
 
  </div>
     <?php   } ?>
</div></td>
      </tr>
    </tbody>
  </table>



</div>

<script>

window.onload = function() { mysql_second_behind_test(); redis_test(); kannel_tps_test(); kannel_queue_test(); smpp_testing(); linksStatus(); linksStatus2(); pointCodesStatus(); pointCodesStatus2();kannel_smpp_port_check();api_links_test();}


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



















 var sinch_counts = <?php echo json_encode($sinch_counts);?> ;
    // Create the chart

    ////console.log(sinch_counts)
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
        success: function(res) { //console.log('running1')
      ////console.log('kannel ajax')
      //console.//console.log(res)
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
            // //console.log(res);
            // //console.//console.log(redis_stat_test.series[d])
            kannel_graph_tps.series[0].setData(this.kannel_tps_data);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        //console.log(request.responseText);
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
        success: function(res) { //console.log('running2')
      ////console.log('kannel queue ajax')
      //console.//console.log(res)
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
            // //console.log(res);
            // //console.//console.log(redis_stat_test.series[d])
            kannel_graph_queue.series[0].setData(this.kannel_queue_data);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        //console.log(request.responseText);
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


 ////console.log(mysql_seconds_behind)

 function mysql_second_behind_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('mysql_behind')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running3')
            ////console.log('danish sql')
            //console.//console.log(res);
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
            // //console.log(res);
            // //console.//console.log(redis_stat_test.series[d])
            mysql_second_test.series[0].setData(this.data_mysql_seconds_behind);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        //console.log(request.responseText);
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


 //console.//console.log(redis_stats)



 function redis_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('redis_stats')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running4')
            ////console.log('danish')
            //console.//console.log(res);
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
            // //console.log(res);
            // //console.//console.log(redis_stat_test.series[d])
            redis_stat_test.series[0].setData(this.data_redis);
            //redis_stat_test.update();
        },
      error: function (request, status, error) {
        //console.log(request.responseText);
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


function api_links_test(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('api_link')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running10')
        // this.api_link_result = "Down";
          
    if (res.RESULT == "UP") {
    this.guage_api_link = [1];
}
   else {
    this.guage_api_link = [0];  
}

     api_links.series[0].setData(this.guage_api_link);
    // pointCodesStatus_array[index].series[0].
        


        },
      error: function (request, status, error) {
        //console.log(request.responseText);

      }
    }); }, 2000);
    
 
}


var guage_api_link = 0;
var api_link_result = '';

if (api_link.RESULT == "UP") {
this.guage_api_link = 1;
}
else {
  this.guage_api_link = 0;  
}
this.api_link_result = api_link.RESULT;
// The speed gauge
var api_links = Highcharts.chart('api_links', Highcharts.merge(gaugeOptions, {
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
                '<span style="font-size:25px">'+this.api_link_result+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));

//the smpp guages kannel_smpp_port_check


var kannel_smppbox_port_checkk = <?php echo json_encode($kannel_smppbox_port_check);?> ;

function kannel_smpp_port_check(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('kannel_smpp_port_check')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running11')
        //console.log(res[0].RESULT)
            data = []
            for (index = 0; index < res.length; index++) {
             
    value = [0];
    link = "Down";
    if((res[index].RESULT) == true)
    {
        value = [1];
        link = "UP";
    }


    kannel_smpp_port_check_array[index].series[0].setData(value);
    // pointCodesStatus_array[index].series[0].
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);

      }
    }); }, 2000);
    
 
}



var kannel_smpp_port_check_array =  new Array();





 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < kannel_smppbox_port_checkk.length; index++) {
    value = 0;
    link = "Down";
    if((kannel_smppbox_port_checkk[index].RESULT) == true)
    {
        value = 1;
        link = "UP";
    }
    ////console.log(value);

    kannel_smpp_port_check_array[index] = Highcharts.chart(''+index+'', Highcharts.merge(gaugeOptions, {
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

function linksStatus(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('linksStatus')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running5')

            data = []
            for (index = 0; index < res.length; index++) {
             
    value = [0];
    link = "Down";
    if((res[index].status) == "UP")
    {
        value = [1];
        link = "UP";
    }


    linksStatus_array[index].series[0].setData(value);
    // pointCodesStatus_array[index].series[0].
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);

      }
    }); }, 2000);
    
 
}



var linksStatus_array =  new Array();

 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < ussd.length; index++) {
    value = 0;
    link = "Down";
    if((ussd[index].status) == "UP")
    {
        value = 1;
        link = "UP";
    }
    ////console.log(value);

    linksStatus_array[index] = Highcharts.chart('ussd'+index+'', Highcharts.merge(gaugeOptions, {
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


function pointCodesStatus(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('pointCodesStatus')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running6')
            ////console.log('running')
            data = []
            for (index = 0; index < res.length; index++) {
             
    value = [0];
    link = "INACCESSIBLE";
    if((res[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = [1];
        link = "ACCESSIBLE";
    }


    pointCodesStatus_array[index].series[0].setData(value);
    // pointCodesStatus_array[index].series[0].
        
}

        },
      error: function (request, status, error) {
        // //console.log(request.responseText);
        //console.log(request.responseText)
      }
    }); }, 2000);
    
 
}



var pointCodesStatus_array =  new Array();




 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < code.length; index++) {
    value = 0;
    link = "INACCESSIBLE";
    if((code[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = 1;
        link = "ACCESSIBLE";
    }
    ////console.log(value);

    pointCodesStatus_array[index] = Highcharts.chart('code'+index+'', Highcharts.merge(gaugeOptions, {
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


function linksStatus2(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('linksStatus2')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running7')

            data = []
            for (index = 0; index < res.length; index++) {
             
    value = [0];
    link = "Down";
    if((res[index].status) == "UP")
    {
        value = [1];
        link = "UP";
    }


    linksStatus2_array[index].series[0].setData(value);
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);
      }
    }); }, 2000);
    
 
}



var linksStatus2_array =  new Array();



 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < ussd2.length; index++) {
    value = 0;
    link = "Down";
    if((ussd2[index].status) == "UP")
    {
        value = 1;
        link = "UP";
    }
    ////console.log(value);

    linksStatus2_array[index] = Highcharts.chart('ussd2'+index+'', Highcharts.merge(gaugeOptions, {
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


function pointCodesStatus2(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('pointCodesStatus2')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running8')

            data = []
            for (index = 0; index < res.length; index++) {
             
    value = [0];
    link = "INACCESIBBLE";
    if((res[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = [1];
        link = "ACCESSIBLE";
    }


    pointCodesStatus2_array[index].series[0].setData(value);
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);
      }
    }); }, 2000);
    
 
}



var pointCodesStatus2_array =  new Array();


 // var data_kannel_smppbox_port_check = [];
 for (index = 0; index < code2.length; index++) {
    value = 0;
    link = "INACCESIBBLE";
    if((code2[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = 1;
        link = "ACCESSIBLE";
    }
    ////console.log(value);


    pointCodesStatus2_array[index] = Highcharts.chart('code2'+index+'', Highcharts.merge(gaugeOptions, {
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

 function smpp_testing(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('smpp_links')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running9')

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
        //console.log(request.responseText);
      }
    }); }, 2000);
    
 
}


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
    ////console.log(value);
    
    
    smpp_test[index] = Highcharts.chart('smpp'+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: smpp[index].LA_Name +'  PORT :'+smpp[index].IP_Port ,
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
