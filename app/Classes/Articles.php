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

    public function searchForArticles()
    {

    }
}
