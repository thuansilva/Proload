<?php

namespace App\Console\Commands;

use App\Http\Controllers\apiInfoController;
use Illuminate\Routing\Route;
use Illuminate\Console\Command;

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
          Route::get('/','App\Http\Controllers\apiInfoController@index');
    }
}
