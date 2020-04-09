<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserCreatesuperuserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:createsuperuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new superuser';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $firstName = $this->ask('firstName');
        $lastName = $this->ask('lastName');
        $email = $this->ask('email');
        $password = $this->secret('password');

        $user = User::create([
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'password' => Hash::make($password),
            'cellphone' => '12132132'
        ]);
        $user->globaladmin = 1;
        $user->save();
    }
}
