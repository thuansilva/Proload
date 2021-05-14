<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class apiInfoController extends Controller
{

    public  function index(){
        $response = Http::get("https://g1.globo.com/rss/g1/");
        $xml = simplexml_load_string($response);
        $data = $xml->channel->item->title[0];
        $file = fopen("Information.txt",'w');
        fwrite($file, $data);
        fclose($file);

        function LerArquivo(){
            $file = fopen("Information.txt",'r');
            $arquivo = "Information.txt";
            $info = fread($file, filesize($arquivo) );
            return $info;
        }
    }

    public function api (){
        $token = $_ENV['TOKEN_ZAPITO'];
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
        for ($i=0; $i< $count;$i++){
           $item[$i]=[
                'phone' => $users[$i]->telefone,
                'message'=> '*'.$users[$i]->name.'*'.', olha esssa isso: '.$this->index().LerArquivo(),
                'test_mode'=> true
            ];

        }
        return $item;
    }

}

