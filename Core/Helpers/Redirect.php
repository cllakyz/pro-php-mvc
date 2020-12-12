<?php


namespace Cakyuz\Core\Helpers;


/**
 * Class Redirect
 * @package Cakyuz\Core\Helpers
 */
class Redirect
{
    /**
     * @param string $toUrl
     * @param int $status
     */
    public static function to(string $toUrl, int $status = 301): void
    {
        header('Location:' . getenv('SITE_URL') . $toUrl, true, $status);
        exit;
    }
}