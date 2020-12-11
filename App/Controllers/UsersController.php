<?php


namespace Cakyuz\App\Controllers;


/**
 * Class UsersController
 * @package Cakyuz\App\Controllers
 */
class UsersController
{
    /**
     * @param int $id
     * @return string
     */
    public function show(int $id): string
    {
        return 'User id: ' . $id;
    }
}