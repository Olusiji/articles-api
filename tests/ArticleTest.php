<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;
use Laravel\Passport\Passport;
use App\Article;
use App\Classes\Articles;

class ArticleTest extends TestCase
{
    use DatabaseTransactions;

    protected function headers($user = null)
    {
        $headers = ['Accept' => 'application/json'];

        if (!is_null($user)) {
            $token = $user->createToken('Token Name')->accessToken;
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        return $headers;
    }

    public function testCreateArticle()
    {
        $user = factory(User::class)->create();

        $parameters = [
            "title"=> "Blue Moon",
            "author"=> "Chimamanda Nigeria",
            "content"=> "This is the beginning of a long interesting post",
            "status"=> "draft",
            "user_id"=> "1",
            "rating"=> 0
        ];
        $this->post("/api/v1/articles", $parameters, $this->headers($user));
        $this->seeStatusCode(200);
        $this->seeInDatabase('articles', ['title' => 'Blue Moon', "author"=> "Chimamanda Nigeria"]); 
    }

    public function testGetArticleById()
    {
        $this->json('GET', '/api/v1/articles/1');
        $this->seeStatusCode(200);
        $this->seeJson([
            'id' => 1,
        ]);
        $this->seeJsonStructure(
            [
                'id',
                'user_id',
                'created_at',
                'updated_at',
                'title',
                'author',
                'content',
                'rating',
                'status'
            ]      
        );
    }

    public function testArticleDelete()
    {
        $user = factory(User::class)->create();
        
        $this->delete("/api/v1/articles/1", [], $this->headers($user));
        $this->seeStatusCode(200);
        $this->notSeeInDatabase('articles', ['id' => 1]); 

    }
}