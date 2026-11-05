<?php

namespace App\Console\Commands\Users;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AddUser extends Command
{
    protected $signature = 'user:add
                            {name : The user\'s name}
                            {email : The user\'s email}
                            {--admin : Assign admin role}';

    protected $description = 'Create a new user and optionally assign admin role';

    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');

        $password = $this->secret('Enter password');

        if (!$password) {
            $this->error('Password cannot be empty');
            return 1;
        }

        // Create user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("User created: {$user->id} ({$user->email})");

        // Assign default role
        DB::table('user_roles')->insert([
            'user_id' => $user->id,
            'role_id' => 2, // role_id 2 = "user"
        ]);

        $this->info("Assigned default user role");

        // Assign admin role if requested
        if ($this->option('admin')) {
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => 1, // role_id 1 = "admin"
            ]);

            $this->info("Assigned admin role");
        }

        return 0;
    }
}

