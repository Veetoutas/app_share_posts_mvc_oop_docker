<?php

namespace VFramework\Controllers;

use VFramework\Helpers\UrlHelper;
use VFramework\Libraries\Controller;

class Pages extends Controller{

    public function index()
    {

        if(isLoggedIn()) {
            UrlHelper::redirect('posts');
        }

        $this->view('pages/index', [
            'title' => 'Share Posts',
            'description' => 'Simple social network built on the Custom MVC PHP framework'
        ]);

    }

    public function about()
    {
        $this->view('pages/about', [
            'title' => 'About page',
            'description' => 'App to share posts with other users'
        ]);
    }
}
