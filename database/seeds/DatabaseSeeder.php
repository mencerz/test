<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'client']);

        $email = $this->command->ask('Enter email', 'admin@admin.com');
        $password = $this->command->ask('Enter password', 'admin');

        $user = factory(App\User::class)->create([
            'password' => Hash::make($password),
            'email' => $email
        ]);
        $user->assignRole(App\User::ROLE_MANAGER);

        echo "Credentials:\n";
        print_r(['email' => $user->email, 'password' => $password]);
    }
}
