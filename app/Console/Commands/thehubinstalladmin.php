<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Hash;

class thehubinstalladmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thehub:install-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create first admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('What is the email?');
        $password = $this->secret('What is the password?');
        DB::table('admin_users')
        ->where('email', 'administrator@brackets.sk')
        ->update([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        return 0;
    }
}
