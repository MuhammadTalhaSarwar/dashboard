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
        
        return view('home',compact('kannel_tps','kannel_queue','redis_stats'));
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
