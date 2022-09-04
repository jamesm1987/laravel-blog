<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::Factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $subscriber = User::Factory()->create([
            'name' => 'Subscriber',
            'email' => 'subscriber@subscriber.com',
        ]);        

        $admin->assignRole('admin');
        $subscriber->assignRole('subscriber');
    }
}
