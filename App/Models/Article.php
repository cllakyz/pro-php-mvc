<?php


namespace Cakyuz\App\Models;


use Cakyuz\Core\Database;

/**
 * Class Article
 * @package Cakyuz\App\Models
 */
class Article
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        return Database::table('posts')->get();
    }

    /**
     * @param $url
     * @return object
     */
    public function find($url): object
    {
        return Database::table('posts')->where('post_sef', $url)->first();
    }
}