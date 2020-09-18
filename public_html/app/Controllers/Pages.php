<?php

namespace VFramework\Controllers;

use VFramework\Helpers\UrlHelper;
use VFramework\Libraries\Controller;

class Pages extends Controller
{
    public function index(): void
    {

        if (isLoggedIn()) {
            UrlHelper::redirect('posts');
        }

        $this->view('pages/index', [
            'title' => 'Share Posts',
            'description' => 'Simple social network built on the Custom MVC PHP framework'
        ]);

    }

    public function about(): void
    {
        $this->view('pages/about', [
            'title' => 'About page',
            'description' => 'App to share posts with other users'
        ]);
    }

    public function dashboard(): void
    {
        $this->view('pages/dashboard');
    }

    public function countries(): void
    {
        $this->view('pages/countries');
    }
}
