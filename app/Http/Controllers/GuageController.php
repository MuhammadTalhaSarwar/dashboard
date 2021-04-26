<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Events\LinkStatus;
use App\Models\Api_Check;
use App\Models\Notification;


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
        Api_Check::truncate();
        $client = new Client();
        $api_data_to_db = new Api_Check;

        $response = $client->get('http://172.27.108.45/kannel_smppbox_port_check.php');
        $body = $response->getBody()->getContents();
        $kannel_smppbox_port_check = json_decode($body);
        foreach ($kannel_smppbox_port_check as $port) {
            $api_data_to_db             = new Api_Check;
            $api_data_to_db->IP_Address = ($port->REDIS_IP);
            $api_data_to_db->Status     = ($port->RESULT);
            $api_data_to_db->api_name   = 'Kannel SmppBox Port Check';
            $api_data_to_db->save();
        }

        $response = $client->get('http://172.27.108.45/smpp_links.php');
        $body = $response->getBody()->getContents();
        $smpp_links = json_decode($body);
        foreach ($smpp_links as $port) {
            $api_data_to_db             = new Api_Check;
            $api_data_to_db->IP_Address = ($port->IP_Port);
            $api_data_to_db->Status     = ($port->RESULT);
            $api_data_to_db->api_name   = 'SMPP LINKS';
            $api_data_to_db->save();
        }

        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $api_link = json_decode($body);
        $api_data_to_db             = new Api_Check;
        $api_data_to_db->IP_Address = ($api_link->IP_Port);
        $api_data_to_db->Status     = ($api_link->RESULT);
        $api_data_to_db->api_name   = 'API LINK';
        $api_data_to_db->save();

        $response = $client->get('http://172.27.108.45/ussd1_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd1_link_status = json_decode($body);
        // echo"<pre>";
        // print_r($ussd1_link_status);
        // exit();
        $linksStatus = $ussd1_link_status->linksStatus;
        foreach ($linksStatus as $port) {
            $api_data_to_db             = new Api_Check;
            $api_data_to_db->IP_Address = ($port->port) . ($port->ip);
            $api_data_to_db->Status     = ($port->status);
            $api_data_to_db->api_name   = 'LINKS STATUS 1';
            $api_data_to_db->save();
        }

        $pointCodesStatus = $ussd1_link_status->pointCodesStatus;
        foreach ($pointCodesStatus as $port) {
            $api_data_to_db             = new Api_Check;
            $api_data_to_db->IP_Address = ($port->pointCode);
            $api_data_to_db->Status     = ($port->signallingPointStatus);
            $api_data_to_db->api_name   = 'POINT CODE STATUS 1';
            $api_data_to_db->save();
        }

        $response = $client->get('http://172.27.108.45/ussd2_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd2_link_status = json_decode($body);

        $linksStatus2 = $ussd2_link_status->linksStatus;
        foreach ($linksStatus2 as $port) {
            $api_data_to_db             = new Api_Check;
            $api_data_to_db->IP_Address = ($port->port) . ($port->ip);
            $api_data_to_db->Status     = ($port->status);
            $api_data_to_db->api_name   = 'LINKS STATUS 2';
            $api_data_to_db->save();
        }

        $pointCodesStatus2 = $ussd2_link_status->pointCodesStatus;
        foreach ($pointCodesStatus2 as $port) {
            $api_data_to_db             = new Api_Check;
            $api_data_to_db->IP_Address = ($port->pointCode) . '2';
            $api_data_to_db->Status     = ($port->signallingPointStatus);
            $api_data_to_db->api_name   = 'POINT CODE STATUS 2';
            $api_data_to_db->save();
        }

        $response = $client->get('http://172.27.108.45/mysql_repl_check.php');
        $body = $response->getBody()->getContents();
        $body = substr($body, 2);
        $mysql_repl_check = json_decode($body);
        foreach ($mysql_repl_check as $port) {
            $api_data_to_db             = new Api_Check;
            $api_data_to_db->IP_Address = ($port->SLAVE_IP);
            $api_data_to_db->Status     = ($port->RESULT);
            $api_data_to_db->api_name   = 'MY SQL REPL CHECK';
            $api_data_to_db->save();
        }

        return view('solidguage', compact('mysql_repl_check', 'api_link', 'kannel_smppbox_port_check', 'smpp_links', 'ussd1_link_status', 'linksStatus', 'pointCodesStatus', 'linksStatus2', 'pointCodesStatus2'));
    }

    public function api_link()
    {

        $client = new Client();
        $response = $client->get('http://172.27.108.45/API_link.php');
        $body = $response->getBody()->getContents();
        $api_link = json_decode($body);
        $api_read_status = Api_Check::where('IP_Address', "=", $api_link->IP_Port)->first();
        if (!empty($api_read_status)) {
            if ($api_link->RESULT == true) {
                $api_read_status->alert_status = 1;
                $api_read_status->save();
            } else {
                if ($api_read_status->alert_status != 2) {
                    $api_read_status->alert_status = 2;
                    $api_read_status->save();
                    $text = 'API LINK PORT ' . $api_link->IP_Port . ' IS DOWN';
                    $generating_notification = new Notification();
                    $generating_notification->text = $text;
                    $generating_notification->save();
                    event(new LinkStatus($text));
                }
            }
        }
        // if($api_link->RESULT == "UP")
        // {
        //     $text = 'API LINK IS UP';
        //     event(new LinkStatus($text));
        // }
        // echo"<pre>";
        // print_r($api_link->RESULT);
        // exit();

        return response()->json($api_link);
    }

    public function repl_check()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/mysql_repl_check.php');
        $body = $response->getBody()->getContents();
        $body = substr($body, 2);
        $mysql_repl_check = json_decode($body);
        foreach ($mysql_repl_check as $port) {
            $api_read_status = Api_Check::where('IP_Address', "=", $port->SLAVE_IP)->first();
            if (!empty($api_read_status)) {
                if ($port->RESULT == "UP") {
                    $api_read_status->alert_status = 1;
                    $api_read_status->save();
                } else {
                    if ($api_read_status->alert_status != 2) {
                        $api_read_status->alert_status = 2;
                        $api_read_status->save();
                        $text = 'MY SQL REPL CHECK ' . $port->SLAVE_IP . ' IS DOWN';
                        $generating_notification = new Notification();
                        $generating_notification->text = $text;
                        $generating_notification->save();
                        event(new LinkStatus($text));
                    }
                }
            }
        }
        return response()->json($mysql_repl_check);
    }



    public function smpp_links()
    {

        $client = new Client();
        $response = $client->get('http://172.27.108.45/smpp_links.php');
        $body = $response->getBody()->getContents();
        $smpp_links = json_decode($body);
        foreach ($smpp_links as $port) {
            $api_read_status = Api_Check::where('IP_Address', "=", $port->IP_Port)->first();
            if (!empty($api_read_status)) {
                if ($port->RESULT == true) {
                    $api_read_status->alert_status = 1;
                    $api_read_status->save();
                } else {
                    if ($api_read_status->alert_status != 2) {
                        $api_read_status->alert_status = 2;
                        $api_read_status->save();
                        $text = 'SMPP LINKS ' . $port->IP_Port . ' IS DOWN';
                        $generating_notification = new Notification();
                        $generating_notification->text = $text;
                        $generating_notification->save();
                        event(new LinkStatus($text));
                    }
                }
            }
        }
        return response()->json($smpp_links);
    }

    public function kannel_smpp_port_check()
    {

        $client = new Client();
        $response = $client->get('http://172.27.108.45/kannel_smppbox_port_check.php');
        $body = $response->getBody()->getContents();
        $kannel_smppbox_port_check = json_decode($body);
        foreach ($kannel_smppbox_port_check as $port) {
            $api_read_status = Api_Check::where('IP_Address', "=", $port->REDIS_IP)->first();
            if (!empty($api_read_status)) {
                if ($port->RESULT == true) {
                    $api_read_status->alert_status = 1;
                    $api_read_status->save();
                } else {
                    if ($api_read_status->alert_status != 2) {
                        $api_read_status->alert_status = 2;
                        $api_read_status->save();
                        $text = 'KANNEL SMPP PORT CHECK ' . $port->REDIS_IP . ' IS DOWN';
                        $generating_notification = new Notification();
                        $generating_notification->text = $text;
                        $generating_notification->save();
                        event(new LinkStatus($text));
                    }
                }
            }
        }

        return response()->json($kannel_smppbox_port_check);
    }

    public function linksStatus()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd1_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd1_link_status = json_decode($body);
        $linksStatus = $ussd1_link_status->linksStatus;
        foreach ($linksStatus as $port) {
            $api_read_status = Api_Check::where('IP_Address', "=", ($port->port) . ($port->ip))->first();
            // dd($api_read_status);
            if (!empty($api_read_status)) {
                if ($port->status == "UP") {
                    $api_read_status->alert_status = 1;
                    $api_read_status->save();
                } else {
                    if ($api_read_status->alert_status != 2) {
                        $api_read_status->alert_status = 2;
                        $api_read_status->save();
                        $text = 'USSD1 LINK STATUS ' . ($port->port) . ($port->ip) . ' IS DOWN';
                        $generating_notification = new Notification();
                        $generating_notification->text = $text;
                        $generating_notification->save();
                        event(new LinkStatus($text));
                    }
                }
            }
        }
        return response()->json($linksStatus);
    }
    public function pointCodesStatus()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd1_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd1_link_status = json_decode($body);
        $pointCodesStatus = $ussd1_link_status->pointCodesStatus;
        foreach ($pointCodesStatus as $port) {
            $api_read_status = Api_Check::where('IP_Address', "=", $port->pointCode)->first();
            if (!empty($api_read_status)) {
                if ($port->signallingPointStatus == "ACCESSIBLE") {
                    $api_read_status->alert_status = 1;
                    $api_read_status->save();
                } else {
                    if ($api_read_status->alert_status != 2) {
                        $api_read_status->alert_status = 2;
                        $api_read_status->save();
                        $text = 'USSD1 POINT CODE STATUS ' . $port->pointCode . ' IS INACCESSIBLE';
                        $generating_notification = new Notification();
                        $generating_notification->text = $text;
                        $generating_notification->save();
                        event(new LinkStatus($text));
                    }
                }
            }
        }
        return response()->json($pointCodesStatus);
    }

    public function linksStatus2()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd2_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd2_link_status = json_decode($body);
        $linksStatus2 = $ussd2_link_status->linksStatus;
        foreach ($linksStatus2 as $port) {
            $api_read_status = Api_Check::where('IP_Address', "=", ($port->port) . ($port->ip))->first();
            // dd($api_read_status);
            if (!empty($api_read_status)) {
                if ($port->status == "UP") {
                    $api_read_status->alert_status = 1;
                    $api_read_status->save();
                } else {
                    if ($api_read_status->alert_status != 2) {
                        $api_read_status->alert_status = 2;
                        $api_read_status->save();
                        $text = 'USSD2 LINK STATUS '.($port->port).':'.($port->ip).' IS DOWN';
                        $generating_notification = new Notification();
                        $generating_notification->text = $text;
                        $generating_notification->save();
                        event(new LinkStatus($text));
                    }
                }
            }
        }

        return response()->json($linksStatus2);
    }
    public function pointCodesStatus2()
    {
        $client = new Client();
        $response = $client->get('http://172.27.108.45/ussd2_link_status.php');
        $body = $response->getBody()->getContents();
        $ussd2_link_status = json_decode($body);
        $pointCodesStatus2 = $ussd2_link_status->pointCodesStatus;
        foreach ($pointCodesStatus2 as $port) {
            $api_read_status = Api_Check::where('IP_Address', "=", $port->pointCode . '2')->first();
            // dd($api_read_status);
            if (!empty($api_read_status)) {
                if ($port->signallingPointStatus == "ACCESSIBLE") {
                    $api_read_status->alert_status = 1;
                    $api_read_status->save();
                } else {
                    if ($api_read_status->alert_status != 2) {
                        $api_read_status->alert_status = 2;
                        $api_read_status->save();
                        $text = 'USSD2 POINT CODE STATUS ' . $port->pointCode . ' IS INACCESSIBLE';
                        $generating_notification = new Notification();
                        $generating_notification->text = $text;
                        $generating_notification->save();
                        event(new LinkStatus($text));
                    }
                }
            }
        }
        return response()->json($pointCodesStatus2);
    }

    public function guzzle()
    {

        $client = new Client();
        //api 1
        $response = $client->get('http://172.27.108.45/kannel_tps.php');
        $body = $response->getBody()->getContents();
        $project = json_decode($body);
        dd($project);

        $client = new Client(['base_uri' => 'https://reqres.in/']);
        $response = $client->request('GET', '/api/users?page=1');
    }

    public function noti()
    {
        $count = Notification::where('status', "=", 0)->count();
        // dd($count);
        $notifi = Notification::latest()->take(5)->get();
        $output = '';

        if (!empty($notifi)) {
            foreach ($notifi as $notified) {
                $output .= '<li><a href="#"><strong>' . $notified->text . '</strong><br /></a></li>';
            }
        } else {
            $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
        }
        $data = array(
            'notification' => $output,
            'unseen_notification'  => $count
        );
        // echo "<pre>";
        // print_r($data);
        // exit();

        echo json_encode($data);
        // return view('noti')->with('notified', $notified);
        // return view('noti');
    }

    public function readnoti()
    {
        Notification::where('status', 0)
            ->update([
           'status' => 1
        ]);
        $count = Notification::where('status', "=", 0)->count();
        $data = array(
            'unseen_notification'  => $count
        );
        echo json_encode($data);
    }
}
