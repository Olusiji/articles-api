<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $article1 = new Article();
        $article1->title = "Sample Title";
        $article1->author = "Nancy Drew";
        $article1->content = "Some random content that's both inspiring and mildly funny with a hint of sarcasm";
        $article1->rating = 4;
        $article1->rating_count = 1;
        $article1->status = "published";
        $article1->user_id = "1";
        $article1->save();
    }
}
