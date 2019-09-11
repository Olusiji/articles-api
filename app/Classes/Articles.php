<?php
namespace App\Classes;

use App\Article;

class Articles {
    public $article_model;

    public function __construct(Article $article)
    {
        $this->article_model = $article;
    }

    public function getArticles()
    {
        return $this->article_model::all();
    }

    public function getArticleBy($id)
    {
        return $this->article_model::find($id);
    }

    public function createArticle($content)
    {
        return $this->article_model::create($content);
    }

    public function updateArticleBy($content, $id)
    {
        $article = $this->getArticleBy($id);
        $article->title = $content->title;
        $article->content = $content->content;
        $article->status = $content->status;
        $article->save();

        return $article;
    }

    public function deleteArticle($id)
    {
        $article = $this->getArticleBy($id);
        $article->delete();
        return "DELETED";
    }

    public function rateArticle($rating, $id)
    {
        $article = $this->getArticleBy($id);
        $total_rating = $article->rating * $article->rating_count;
        $new_rating_count = $article->rating_count + 1;
        $new_rating = round(($total_rating + $rating) / $new_rating_count, 1);

        $article->rating = $new_rating;
        $article->rating_count = $new_rating_count;
        $article->save();
        return $article->rating;
    }

    public function searchArticlesByTitle($title)
    {
        $article = $this->article_model->where('title', 'like', "%{$title}%")->paginate(10);
        return $article;
    }
}
