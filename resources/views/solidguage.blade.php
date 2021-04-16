@extends('layouts.app')

@section('content')

<style type="text/css">
    .highcharts-figure-solid .chart-container-solid {
    width: 300px;
    height: 200px;
   
}




</style>
<div class="container-fluid">


    <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">Api Link</th>
            <th class="text-center">My Sql Repl Check</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div class="row"><div class="card">
             <figure class="highcharts-figure-solid">
        <div id="api_links" class="chart-container-solid"></div>
            </figure></div></div></td>
            <td>
            <div class="row">
                <?php foreach ($mysql_repl_check as $key => $value) {        ?>
           
                <div class="card">
                    <figure class="highcharts-figure-solid">
                        <div id="<?php echo('repl_check'.$key);?>" class="chart-container-solid"></div>
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
        <th class="text-center">Kannel Smppbox Port Check</th>
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
        <th class="text-center">SMPP Links</th>
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
        <th class="text-center">USSD1 LINK STATUS</th>
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
        <th class="text-center">USSD1 Point Codes Status</th>
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
        <th class="text-center">USSD2 LINK STATUS</th>
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
        <th class="text-center">USSD2 Point Codes Status</th>
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

window.onload = function() { smpp_testing(); linksStatus(); linksStatus2(); pointCodesStatus(); pointCodesStatus2();kannel_smpp_port_check();api_links_test(); my_sql_repl_check();}


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


var mysql_repl_checkk = <?php echo json_encode($mysql_repl_check);?> ;

function my_sql_repl_check(){
    
    setInterval(function(){    $.ajax({
        url: '{{route('repl_check')}}',
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) { //console.log('running11')
        //console.log(res[0].RESULT)
            data = []
            for (index = 0; index < res.length; index++) {
             
    value = [0];
    link = "Down";
    document.getElementById("repl_check_status"+index).innerHTML = "<span id='repl_check_status'+index+'' style='position:relative;right:20px;text-align:center';>DOWN</span>";
    if((mysql_repl_checkk[index].RESULT) == "UP")
    {
        value = [1];
        link = "UP";
        document.getElementById("repl_check_status"+index).innerHTML = "<span id='repl_check_status'+index+''>UP</span>";
    }

    console.log('reply'+value);

    mysql_repl_checkk_array[index].series[0].setData(value);
    // pointCodesStatus_array[index].series[0].
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);

      }
    }); }, 5000);
    
 
}



var mysql_repl_checkk_array =  new Array();






 for (index = 0; index < mysql_repl_checkk.length; index++) {
    value = 0;
    link = "Down";
    if((mysql_repl_checkk[index].RESULT) == "UP")
    {
        value = 1;
        link = "UP";
    }
    ////console.log(value);

    mysql_repl_checkk_array[index] = Highcharts.chart('repl_check'+index+'', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 1,
        title: {
            text: 'Slave IP :' + mysql_repl_checkk[index].SLAVE_IP,
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
                    '<span  id="repl_check_status'+index+'" style="font-size:25px">'+link+'</span><br/>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: 'Status'
        }
    }]

}));
}










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
    document.getElementById("api_link_status").innerHTML = "<span id='api_link_status'>UP</span>";
    
}
   else {
    this.guage_api_link = [0];  
    document.getElementById("api_link_status").innerHTML = "<span id='api_link_status' style='position:relative;right:20px;text-align:center';>DOWN</span>";
}

     api_links.series[0].setData(this.guage_api_link);
    // pointCodesStatus_array[index].series[0].
        


        },
      error: function (request, status, error) {
        //console.log(request.responseText);

      }
    }); }, 5000);
    
 
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
                    '<span  id="api_link_status" style="font-size:25px">'+api_link.RESULT+'</span><br/>' +
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
    document.getElementById("kannel_smpp_status"+index).innerHTML = "<span id='kannel_smpp_status'+index+'' style='position:relative;right:20px;text-align:center';>DOWN</span>";
    if((res[index].RESULT) == true)
    {
        value = [1];
        link = "UP";
        document.getElementById("kannel_smpp_status"+index).innerHTML = "<span id='kannel_smpp_status'+index+''>UP</span>";
  
    }


    kannel_smpp_port_check_array[index].series[0].setData(value);
    // pointCodesStatus_array[index].series[0].
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);

      }
    }); }, 5000);
    
 
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
                    '<span  id="kannel_smpp_status'+index+'" style="font-size:25px">'+link+'</span><br/>' +
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
    document.getElementById("linkstatuss"+index).innerHTML = "<span id='linkstatuss'+index+'' style='position:relative;right:20px;text-align:center';>DOWN</span>";
    if((res[index].status) == "UP")
    {
        value = [1];
        link = "UP";
        document.getElementById("linkstatuss"+index).innerHTML = "<span id='linkstatuss'+index+''>UP</span>";
    }


    linksStatus_array[index].series[0].setData(value);
    // pointCodesStatus_array[index].series[0].
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);

      }
    }); }, 5000);
    
 
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
                '<span  id="linkstatuss'+index+'" style="font-size:25px">'+link+'</span><br/>' +
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
    document.getElementById("pointcodein"+index).innerHTML = "<span id='pointcodein'+index+'' style='position:relative;right:0px;text-align:center';>INACCESIBBLE</span>";
    if((res[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = [1];
        link = "ACCESSIBLE";
        document.getElementById("pointcodein"+index).innerHTML = "<span id='pointcodein'+index+'' style='position:relative;right:0px;text-align:center';>ACCESSIBLE</span>";
    }


    pointCodesStatus_array[index].series[0].setData(value);
    // pointCodesStatus_array[index].series[0].
        
}

        },
      error: function (request, status, error) {
        // //console.log(request.responseText);
        //console.log(request.responseText)
      }
    }); }, 5000);
    
 
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
                    '<span id="pointcodein'+index+'" style="font-size:25px">'+link+'</span><br/>' +
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
    document.getElementById("linkstatus"+index).innerHTML = "<span id='linkstatus'+index+'' style='position:relative;right:20px;text-align:center';>DOWN</span>";
    if((res[index].status) == "UP")
    {
        value = [1];
        link = "UP";
        document.getElementById("linkstatus"+index).innerHTML = "<span id='linkstatus'+index+''>UP</span>";
    }


    linksStatus2_array[index].series[0].setData(value);
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);
      }
    }); }, 5000);
    
 
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
                    '<span id="linkstatus'+index+'" style="font-size:25px">'+link+'</span><br/>' +
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
    document.getElementById("codein"+index).innerHTML = "<span id='codein'+index+'' style='position:relative;right:0px;text-align:center';>INACCESIBBLE</span>";
    if((res[index].signallingPointStatus) == "ACCESSIBLE")
    {
        value = [1];
        link = "ACCESSIBLE";
        document.getElementById("codein"+index).innerHTML = "<span id='codein'+index+'' style='position:relative;right:0px;text-align:center';>ACCESSIBLE</span>";
    }


    pointCodesStatus2_array[index].series[0].setData(value);
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);
      }
    }); }, 5000);
    
 
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
                    '<span id="codein'+index+'" style="  font-size:25px">'+link+'</span><br/>' +
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
    document.getElementById("smppp"+index).innerHTML = "<span id='smppp'+index+'' style='position:relative;right:20px;text-align:center';>DOWN</span>";
    link = "DOWN";
    if((res[index].RESULT) == "UP")
    {
        value = [1];
        link = "UP";
        document.getElementById("smppp"+index).innerHTML = "<span id='smppp'+index+''>UP</span>";
    }


    smpp_test[index].series[0].setData(value);
        
}

        },
      error: function (request, status, error) {
        //console.log(request.responseText);
      }
    }); }, 5000);
    
 
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
                '<span id="smppp'+index+'"   style=" text-align:center; font-size:25px">'+link+'</span><br/>' +
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