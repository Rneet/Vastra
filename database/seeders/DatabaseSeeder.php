<?php
namespace Database\Seeders;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}
