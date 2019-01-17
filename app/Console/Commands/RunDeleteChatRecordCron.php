<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;
use App\Providers\UserServiceProvider;
class RunDeleteChatRecordCron extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';
    protected $signature = 'rundeletechatrecordcron';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
            \Log::info("delete chat cron started"); 
            UserServiceProvider::deleteBlockedChat();
    }

}
