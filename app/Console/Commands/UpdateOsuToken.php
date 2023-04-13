<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateOsuToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-osu-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update OAuth token daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            dump( 'here first', config('osu.access_token'));

            $response = Http::post("https://osu.ppy.sh/oauth/token", [
                'client_id' => env('OSU_CLIENT_ID', null),
                'client_secret' => env('OSU_CLIENT_SECRET', null),
                'grant_type' => 'client_credentials',
                'scope' => 'public'
            ]);

            $responseJSON = json_decode($response->getBody(), true);
            $val = $responseJSON['access_token'];

            config(['osu.access_token' => $val]);

            dump( 'after', config('osu.access_token'));
          
          } catch (\Exception $e) {
          
            error_log($e);
          }
    }
}
