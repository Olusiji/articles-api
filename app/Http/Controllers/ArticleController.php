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
        $this->validate($request, [
            'title' => 'required|string',
            'author' => 'required|string',
            'content' => 'required|string',
            'status' => 'required',
            'user_id' => 'required|numeric',
            'rating' => 'numeric|max:5',
            'rating_count' => 'numeric|max:0'
        ]);

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

    public function search($title)
    {
        return Response::create($this->articles->searchArticlesByTitle($title),'200');
    }

    public function rate(Request $request, $id)
    {
        $this->validate($request, [
            'rating' => 'required|numeric',
        ]);
        return Response::create($this->articles->rateArticle($request->rating, $id),'200');
    }
}
