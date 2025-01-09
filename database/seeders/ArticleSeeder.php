<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $placeholders = json_decode(env('EXAMPLE_IMAGE_URLS', '["https://th.wallhaven.cc/lg/6d/6d6jk6.jpg","https://th.wallhaven.cc/lg/9d/9de96w.jpg","https://th.wallhaven.cc/lg/3l/3l2196.jpg","https://th.wallhaven.cc/lg/kx/kx8oed.jpg","https://th.wallhaven.cc/lg/rd/rdllkj.jpg"]'), true);

        $faker = Faker::create();
        for ($i = 0; $i < env('EXAMPLE_ARTICLE_COUNT', 20); $i++) {
            // Генерируем текст длиной от 200 до 500 символов
            $minLength = env('EXAMPLE_ARTICLE_MIN_TEXT_LENGTH', 200);
            $maxLength = env('EXAMPLE_ARTICLE_MAX_TEXT_LENGTH', 500);

            // Генерируем текст с максимальной длиной 5000 символов
            $text = $faker->text($maxLength);

            // Убедитесь, что текст имеет длину не менее 200 символов
            while (strlen($text) < $minLength) {
                // Если текст меньше 200 символов, добавляем дополнительные символы
                $text .= $faker->text($maxLength - strlen($text));
            }
            Article::create([
                'title' => $faker->sentence,
                'body' => $text,
                'image' => $placeholders[rand(1, count($placeholders)) - 1],
                'views' => 0,
                'likes' => 0,
            ]);

        }
    }
}
