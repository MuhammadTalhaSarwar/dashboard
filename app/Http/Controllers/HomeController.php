<?php

namespace App\Http\Controllers;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // return view('dashboard');
        $client = new Client();
        //api 1
        $response = $client->get('https://jsonplaceholder.typicode.com/todos/1');
        $body = $response->getBody()->getContents();
        $project = json_decode($body);
        //api 2
        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $project1 = json_decode($body);
        return view ('dashboard', compact('project','project1'));

    }
    public function guzzle()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $project = json_decode($body);
        print_r($project);
        exit();
        // return view('search2.results2', compact('Employees', 'Payments'));
        $client = new Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);
        // $response = $client->request('GET', '/todos/?id=1');
         $response = $client->request('GET', '/todos', ['query' => ['userId' => '1', "id" => 1]]);
        echo $response->getBody();
        exit();


        var_dump ('usaama here finally');
        die();
        return view('dashboard');
    }
    public function getApi(){

        $client = new Client();
        $response = $client->get('https://jsonplaceholder.typicode.com/todos/1');

        $body = $response->getBody()->getContents();
        $project = json_decode($body);

        return view ('response', compact('project'));


}
}
