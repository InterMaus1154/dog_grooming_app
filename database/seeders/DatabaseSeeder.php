<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DogBreed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed dog breeds from an online api
     * Only runs if no breed is found - to prevent duplicates
     * @return void
     */
    private function seedBreeds(): void
    {
        Log::info("Starting to seed breeds");
        try {
            Log::info("Checking if breeds already exist");
            if (DogBreed::count() > 0){
                Log::info("Breeds already exist, cancelling seeds");
                return;
            }

            Log::info("No breeds found, starting seeding");

            $response = Http::get('https://dog.ceo/api/breeds/list/all');
            $breeds = $response->json()['message'];

            $names = [];
            foreach ($breeds as $breed => $subBreeds) {
                if (count($subBreeds) > 0) {
                    foreach ($subBreeds as $subBreed) {
                        $names[] = sprintf('%s %s', ucfirst($subBreed), ucfirst($breed));
                    }
                } else {
                    $names[] = ucfirst($breed);
                }
            }

            sort($names);

            Log::info("Starting inserting records");
            DB::beginTransaction();
            try {
                foreach ($names as $name) {
                    DogBreed::query()
                        ->create([
                            'name' => $name
                        ]);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Error at inserting records");
                Log::error($e->getMessage());
                return;
            }

            if (DogBreed::count() > 0) {
                Log::info(sprintf("Seeding successful, found %d records", DogBreed::count()));
            } else {
                Log::error("Seeding silently failed, no records found.");
            }


        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Seeding failed due to connection error");
            Log::error($e->getMessage());
        }
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->seedBreeds();

        if (!app()->isProduction()) {
            if (User::where('email', 'testadmin@mail.com')->exists()) return;
            User::create([
                'email' => 'testadmin@mail.com',
                'password' => 'password',
                'username' => 'testadmin'
            ]);
        }

    }
}
