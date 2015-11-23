<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class ArticlesController extends Controller
{

    /**
     * Create a new articles controller instances.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only'=>'create']);
    }

    public function index()
    {
    	$articles = Article::latest('published_at')->published()->get();

    	return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
    	return view('articles.show', compact('article'));
    }

    /**
     * Show the page to create a new article.
     */
    public function create()
    {
        $tags=Tag::lists('name', 'id');

        return view('articles.create', compact('tags'));
    }

    /**
     * Save a new article.
     */
    public function store(ArticleRequest $request)
    {
        $this->createArticle($request);

        flash()->overlay('Your article has been successfully created!', 'Good Job!');

        return redirect('articles');
    }

    public function edit(Article $article)
    {
        $tags=Tag::lists('name', 'id');

        return view('articles.edit', compact('article', 'tags'));
    }

    /**
     * Update an article.
    */
    public function update(Article $article, ArticleRequest $request)
    {
        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));   

        return redirect('articles');
    }

    /**
     * Get a list of tag ids associated with the current article.
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }

    /**
     * Sync up the list of tags in the database.
     */
    private function syncTags(Article $article, array $tags )
    {
        $article->tags()->sync($tags);
    }

    /**
     * Save a new article.
     */
    private function createArticle(ArticleRequest $request)
    {
        $article= \Auth::user()->articles()->create($request->all());

        $article->tags()->attach($request->input('tag_list'));

        return $article;
    }
}    

