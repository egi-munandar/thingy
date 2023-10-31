<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrNew(['id' => 1]);
        $admin->email = env('ADMIN_EMAIL', 'admin@thingy.app');
        $admin->password = bcrypt(env('ADMIN_PASSWORD', 'pleasechangeme'));
        $admin->name = env('ADMIN_NAME', 'Thingy Admin');
        $admin->email_verified_at = now();
        $admin->save();
        $admin->givePermissionTo('Admin');
    }
}
