<?php

namespace App\Http\Controllers;

use App\Classes\Articles;
use App\Article;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articles;

    public function __construct(Article $article)
    {
        $this->articles = new Articles($article);
    }

    public function list()
    {
        return Response::create($this->articles->getArticles(),'200');
    }

    public function create(Request $request)
    {
        $details = $request->all();
        return Response::create($this->articles->createArticle($details),'200');
    }

    public function get($id)
    {
        return Response::create($this->articles->getArticleBy($id),'200');
    }

    public function update(Request $request, $id)
    {
        return Response::create($this->articles->updateArticleBy($request, $id),'200');
    }

    public function delete($id)
    {
        return Response::create($this->articles->deleteArticle($id),'200');
    }

    public function search()
    {
        //return Response::create($this->articles->getArticleBy($id),'200');
    }

    public function rate()
    {
        //return Response::create($this->articles->getArticleBy($id),'200');
    }
}
