<?php

// $dotenv = Dotenv\Dotenv :: createImmutable (__DIR__);
// $dotenv -> load ();

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
class apiInfoController extends Controller
{
    public  function index(){
        $response = Http::get("https://g1.globo.com/rss/g1/");
        sleep(1);
        $xml = simplexml_load_string($response);
        $data = $xml->channel->item->title[0];
        return strval($data);
    }

    public function api (){
        $token ='25MjHjLY7fSu54HrILcExdrUba5h2UZZKwrQT6YSBRJjLtoyg7pg4iwL2tKY';
        $data = [
               'test_mode'=> true,
               'data'=>
                    $this->getDadosBd(),


        ];

        $response= Http::withHeaders([
            'Authorization' => 'Bearer '.$token,
            'accept' => 'application/json'])->post('https://zapito.com.br/api/messages',$data);
            echo $response->getBody();
            echo  $response->getStatusCode();
    }



    public function getDadosBd (){
        $users =(Array) DB::select('SELECT *
        FROM `tags`
        where `status` = "Ativo"');

        $count = DB::table('tags')->select('*')->where('status', "Ativo")->count('*');

        // print_r($count);

        for ($i=0; $i< $count;$i++){
           $item[$i]=[
                'phone' => $users[$i]->telefone,
                 'message'=> '*'.$users[$i]->name.'*'.', olha esssa isso: '.$this->index(),
                "test_mode"=> true
            ];

        }
        return $item;
        print_r($item);

    }

}

