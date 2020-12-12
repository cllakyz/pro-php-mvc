<?php


namespace Cakyuz\App\Controllers;


/**
 * Class ArticlesController
 * @package Cakyuz\App\Controllers
 */
class ArticlesController
{
    /**
     * @return string
     */
    public function index(): string
    {
        $articleModel = model('article');
        $articles = $articleModel->getAll();

        return view('articles', [
            'articles' => $articles
        ]);
    }

    /**
     * @param string $url
     * @return string
     */
    public function show(string $url): string
    {
        $articleModel = model('article');
        $article = $articleModel->find($url);

        return view('article-detail', [
            'article' => $article
        ]);
    }
}