<?php


use App\Article;

use App\User;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        User::all()->each(function ($user) use ($faker) {
            foreach (range(1, 5) as $i) {
                Article::create([
                    'user_id' => $user->id,
                    'title'   => $faker->sentence,
                    'content' => $faker->paragraphs(3, true),
                ]);
            }
        });
    }
}