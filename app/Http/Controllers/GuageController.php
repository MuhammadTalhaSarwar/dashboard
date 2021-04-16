<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GuageController extends Controller
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
        
        $response = $client->get('http://172.27.108.45/kannel_smppbox_port_check.php');
        $body = $response->getBody()->getContents();
        $kannel_smppbox_port_check = json_decode($body);
        
        $response = $client->get('http://172.27.108.45/smpp_links.php');
        $body = $response->getBody()->getContents();
        $smpp_links = json_decode($body);

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

                
        $response = $client->get('http://172.27.108.45/mysql_repl_check.php');
        $body = $response->getBody()->getContents();
        $body = substr($body, 2);
        $mysql_repl_check = json_decode($body);
        

        return view('solidguage',compact('mysql_repl_check','api_link','kannel_smppbox_port_check','smpp_links','ussd1_link_status','linksStatus','pointCodesStatus','linksStatus2','pointCodesStatus2'));
    }

    public function api_link(){

        $client = new Client();
        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $api_link = json_decode($body);
        return response()->json($api_link);
        
    }

    public function repl_check(){
        $client = new Client();
        $response = $client->get('http://172.27.108.45/mysql_repl_check.php');
        $body = $response->getBody()->getContents();
        $body = substr($body, 2);
        $mysql_repl_check = json_decode($body);
        return response()->json($mysql_repl_check);
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

     public function linksStatus()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd1_link_status.php');
        $body = $response->getBody()->getContents();   
        $ussd1_link_status = json_decode($body);
        $linksStatus = $ussd1_link_status->linksStatus;
        return response()->json($linksStatus);
    }
    public function pointCodesStatus()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd1_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd1_link_status = json_decode($body);
        $pointCodesStatus = $ussd1_link_status->pointCodesStatus;
        return response()->json($pointCodesStatus);
    }

    public function linksStatus2()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd2_link_status.php');
        $body = $response->getBody()->getContents();   
        $ussd2_link_status = json_decode($body);
        $linksStatus2 = $ussd2_link_status->linksStatus;
        return response()->json($linksStatus2);
    }
    public function pointCodesStatus2()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd2_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd2_link_status = json_decode($body);
        $pointCodesStatus2 = $ussd2_link_status->pointCodesStatus;
        return response()->json($pointCodesStatus2);
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
