<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class apiInfoController extends Controller
{
    public  function index(){
        $response = Http::get("https://g1.globo.com/rss/g1/");
        $xml = simplexml_load_string($response);
      $data = $xml->channel->item->title;
        return response()->json(['information:'=>$data]);
    }
}
