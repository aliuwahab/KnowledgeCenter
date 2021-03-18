<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;

class ArticleController extends Controller
{
    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->all();

//        TODO::
    }

    public function store()
    {
        $article = $this->articleRepository->create();
    }

    public function show()
    {
        $article = $this->articleRepository->find();
    }
}
