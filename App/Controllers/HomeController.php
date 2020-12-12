<?php


namespace Cakyuz\App\Controllers;


/**
 * Class HomeController
 * @package Cakyuz\App\Controllers
 */
class HomeController
{
    /**
     * @return string
     */
    public function index(): string
    {
        return view('index', [
            'username' => 'celalakyuz'
        ]);
    }
}