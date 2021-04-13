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
       
        
        // $response = $client->get('http://172.27.108.45/mysql_repl_check.php');
        // $body = $response->getBody()->getContents();
        // $mysql_repl_check = json_decode($body);

        // dd($mysql_repl_check);
        
        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $api_link = json_decode($body);
        //dd($api_link);
        

        
        return view('home',compact('kannel_tps','kannel_queue','redis_stats','api_link','mysql_seconds_behind','kannel_smppbox_port_check'));
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
