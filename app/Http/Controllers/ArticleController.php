<?php

namespace App\Http\Controllers;

use App\Events\ArticleViewed;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Traits\RespondsWithHttpStatus;
use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    use RespondsWithHttpStatus;

    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index(Request $request): Response
    {
        $filters = $request->all();
        $paginateBy = $request->get('limit', 50);
        $articles = $this->articleRepository->all($filters, $paginateBy);

        return $this->success('Articles Retrieved Successfully', ArticleResource::collection($articles));
    }

    public function store(CreateArticleRequest $createArticleRequest): Response
    {
        $validatedData = $createArticleRequest->validated();
        $article = $this->articleRepository->create($validatedData['title'], $validatedData['body'], $validatedData['categories']);

        return $this->success('Article Saved Successfully', new ArticleResource($article));
    }


    public function show(Article $article): Response
    {
        ArticleViewed::dispatch($article->id, request()->ip());

        return $this->success('Article Retrieved Successfully', new ArticleResource($article));
    }
}
