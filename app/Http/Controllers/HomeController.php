<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = new Client();
        //api 1
        $response = $client->get('http://172.27.108.45/kannel_tps.php');
        $body = $response->getBody()->getContents();
        $kannel_tps = json_decode($body);

        $response = $client->get('http://172.27.108.45/kannel_queue.php');
        $body = $response->getBody()->getContents();
        $kannel_queue = json_decode($body);

        $response = $client->get('http://172.27.108.45/redis_stats.php');
        $body = $response->getBody()->getContents();
        $redis_stats = json_decode($body);

        $response = $client->get('http://172.27.108.45/mysql_seconds_behind.php');
        $body = $response->getBody()->getContents();
        $mysql_seconds_behind = json_decode($body);

        $response = $client->get('http://172.27.108.45/kannel_smppbox_port_check.php');
        $body = $response->getBody()->getContents();
        $kannel_smppbox_port_check = json_decode($body);
        
        $response = $client->get('http://172.27.108.45/smpp_links.php');
        $body = $response->getBody()->getContents();
        $smpp_links = json_decode($body);
       
        
        // $response = $client->get('http://172.27.108.45/mysql_repl_check.php');
        // $body = $response->getBody()->getContents();
        // $mysql_repl_check = json_decode($body);

        // dd($mysql_repl_check);

        

        // $response = $client->get('http://172.27.108.45/sinch_counts.php');
        // $body = $response->getBody()->getContents();
        $body = '{"SINCH_DELIVERED_TODAY":"628201","SINCH_UNDELIVERED_TODAY":"11121","SINCH_EXPIRED_TODAY":"8240","SINCH_DELIVERED_YESTERDAY":"1335780","SINCH_UNDELIVERED_YESTERDAY":"25650","SINCH_EXPIRED_YESTERDAY":"16074"}';
        $sinch_counts = json_decode($body);
        
        
        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $api_link = json_decode($body);

        $response = $client->get('http://172.27.108.45/smpp_links.php');
        $body = $response->getBody()->getContents();
        $smpp_links = json_decode($body);
        
        $response = $client->get('http://172.27.108.45/ussd1_link_status.php');
        $body = $response->getBody()->getContents();
        
        $ussd1_link_status = json_decode($body);
        $linksStatus = $ussd1_link_status->linksStatus;
        $pointCodesStatus = $ussd1_link_status->pointCodesStatus;

        $response = $client->get('http://172.27.108.45/ussd2_link_status.php');
        $body = $response->getBody()->getContents();
        
        $ussd2_link_status = json_decode($body);
        $linksStatus2 = $ussd2_link_status->linksStatus;
        $pointCodesStatus2 = $ussd2_link_status->pointCodesStatus;
        //dd($api_link);
        


        return view('home',compact('kannel_tps','kannel_queue','redis_stats','api_link','mysql_seconds_behind','kannel_smppbox_port_check','sinch_counts','smpp_links','ussd1_link_status','linksStatus','pointCodesStatus','linksStatus2','pointCodesStatus2'));
    }

    public function api_link(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $api_link = json_decode($body);
        return response()->json($api_link);
        
    }

    public function kannel_tps(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/kannel_tps.php');
        $body = $response->getBody()->getContents();
        $kannel_tps = json_decode($body);
        return response()->json($kannel_tps);
        
    }

    public function sinch_count(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/sinch_counts.php');
        $body = $response->getBody()->getContents();
        // $body = '{"SINCH_DELIVERED_TODAY":"628201","SINCH_UNDELIVERED_TODAY":"11121","SINCH_EXPIRED_TODAY":"8240","SINCH_DELIVERED_YESTERDAY":"1335780","SINCH_UNDELIVERED_YESTERDAY":"25650","SINCH_EXPIRED_YESTERDAY":"16074"}';
        $sinch_counts = json_decode($body);
        return response()->json($sinch_counts);
        
    }

    public function smpp_links(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/smpp_links.php');
        $body = $response->getBody()->getContents();
        $smpp_links = json_decode($body);
        return response()->json($smpp_links);
        
    }

    public function kannel_smpp_port_check(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/kannel_smppbox_port_check.php');
        $body = $response->getBody()->getContents();
        $kannel_smppbox_port_check = json_decode($body);
        return response()->json($kannel_smppbox_port_check);
        
    }

    public function mysql_seconds_behind(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/mysql_seconds_behind.php');
        $body = $response->getBody()->getContents();
        $mysql_seconds_behind = json_decode($body);
        return response()->json($mysql_seconds_behind);
        
    }

    public function redis_stats(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/redis_stats.php');
        $body = $response->getBody()->getContents();
        $redis_stats = json_decode($body);
        return response()->json($redis_stats);
        
    }
    
    public function kannel_queue(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/kannel_queue.php');
        $body = $response->getBody()->getContents();
        $kannel_queue = json_decode($body);
        return response()->json($kannel_queue);
        
    }

    public function guzzle(){
        
        $client = new Client();
        //api 1
        $response = $client->get('http://172.27.108.45/kannel_tps.php');
        $body = $response->getBody()->getContents();
        $project = json_decode($body);
        dd($project);

        $client = new Client(['base_uri' => 'https://reqres.in/']);
        $response = $client->request('GET', '/api/users?page=1');
    }
}
