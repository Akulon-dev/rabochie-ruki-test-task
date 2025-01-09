<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = json_decode(env('EXAMPLE_TAGS','["Laravel", "PHP", "JavaScript", "HTML", "CSS"]'), true);

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }

        // Присваиваем теги статьям
        $articles = Article::all();
        foreach ($articles as $article) {
            $article->tags()->attach(rand(1, count($tags))); // Присваиваем случайный тег
        }
    }
}
