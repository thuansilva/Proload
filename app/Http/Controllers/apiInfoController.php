<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class apiInfoController extends Controller
{

    public  function LerArquivo(){


        $file = fopen("../Information.txt",'r');
        $arquivo = "../Information.txt";
        if (!filesize($arquivo)>0 ||$file == NULL ){
            return 'Daqui a alguns instantes você recebera uma notícia.';
        };
        $info = fread($file, filesize($arquivo));
        fclose($file);
        return $info;
        function LerArquivo(){
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
            echo $response->getStatusCode();

    }

    public function getDadosBd (){
        $users =DB::select('SELECT *
        FROM `tags`
        where `status` = "Ativo"');

        $count = DB::table('tags')->select('*')->where('status', "Ativo")->count('*');

        for ($i=0; $i< $count;$i++){
           $item[$i]=[
                'phone' => $users[$i]->telefone,
                'message'=> '*'.$users[$i]->name.'*'.', olha esssa isso: '.$this->LerArquivo().'- <https://g1.globo.com>',
                'test_mode'=> true
            ];

        }
        return $item;
    }

}

