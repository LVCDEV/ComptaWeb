<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Setting;
use App\Models\Admin\TransactionType;
use App\Models\Admin\UserType;
use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        UserType::factory()->create(['name' => 'admin']);
        UserType::factory()->create(['name' => 'user']);

        User::factory()->create([
            'name' => 'admin',
            'firstName' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Lefebvre-v.76'),
            'user_type_id' => UserType::where('id', 1)->value('id'),
        ]);

        User::factory()->create([
            'name' => 'Lefebvre',
            'firstName' => 'Vincent',
            'email' => 'lefebvre-v@laposte.net',
            'password' => Hash::make('Lefebvre-v.76'),
            'user_type_id' => UserType::where('id', 1)->value('id'),
        ]);

        TransactionType::factory()->create([
           'name' => 'Carte bancaire',
            'coef' => -1,
        ]);

        TransactionType::factory()->create([
            'name' => 'Prélèvement',
            'coef' => -1,
        ]);

        TransactionType::factory()->create([
            'name' => 'Virement',
            'coef' => -1,
        ]);

        TransactionType::factory()->create([
            'name' => 'Retrait espèces',
            'coef' => -1,
        ]);

        Setting::factory()->create([
            'name' => 'max_gauge',
            'value' => 5000,
        ]);

        Setting::factory()->create([
            'name' => 'min_gauge',
            'value' => -500,
        ]);
    }
}
