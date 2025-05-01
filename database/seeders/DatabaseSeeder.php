<?php

namespace Database\Seeders;

use App\Models\{
    Brand,
    Manufacturer,
    Model,
    RentalHistory,
    TransactionHistory,
    User,
    Vehicle,
};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Manufacturer::factory(5)->create()->each(function ($manufacturer) {
            Brand::factory(2)->create(['manufacturer_id' => $manufacturer->id])->each(function ($brand) {
                $models = Model::factory(2)->create(['brand_id' => $brand->id]);

                foreach ($models as $model) {
                    Vehicle::factory(3)->create(['model_id' => $model->id]);
                }
            });
        });

        User::factory(10)->create()->each(function ($user) {
            TransactionHistory::factory(3)->create(['renter_id' => $user->id]);
        });

        User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ])->each(function ($user) {
            TransactionHistory::factory(3)->create(['renter_id' => $user->id]);
        });

        $vehicles = Vehicle::all();
        $users = User::all();

        RentalHistory::factory(10)->create([
            'renter_id' => $users->random()->id,
            'vehicle_id' => $vehicles->random()->id,
        ]);
    }
}
