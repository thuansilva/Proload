<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;


class NewsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'News:cron';
    protected $description = 'Get data news G1';
    public function __construct()
    {
        parent::__construct();

    }

    public function handle(){
        $response = Http::get("https://g1.globo.com/rss/g1/");
        $xml = simplexml_load_string($response);
        $data = $xml->channel->item->title[0];
        $file = fopen("Information.txt",'w');
        fwrite($file, $data);
        fclose($file);
    }
}
