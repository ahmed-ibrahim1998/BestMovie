<?php

use App\Models\Movie;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($handle = fopen(database_path('movie.csv'), 'r')) !== FALSE) {
            $num = 0; // skip the first row i.e the header
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($num == 0){
                    $num++;
                }
                else{
                Movie::create([
                    'field_2022' => $data[1],
                    'field_2023' => $data[2],
                    'title' => $data[3],
                    'director' => $data[4],
                    'year' => $data[5],
                    'country' => $data[6],
                    'length_of_film' => $data[7],
                    'genre' => $data[8],
                    'colour' => $data[9],
                    'tmdb_id' =>rand(1, 1000), // Generate a random number between 1 and 1000
                ]);
                }
            }
            fclose($handle);
        }
    }
}
