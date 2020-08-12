<?php

    class Pages extends Controller{

        private $postModel;

        public function __construct(){
            //  Sets postModel to current model
        }

        public function index() {
            // Get the post from DB

            $data = [
                'title' => 'Share Posts',
                'description' => 'Simple social network built on the Custom MVC PHP framework'
            ];
            // Pass data from DB to view and show it
            $this->view('pages/index', $data);

        }

        public function about() {
            $data = [
                'title' => 'About page',
                'description' => 'App to share posts with toher users'
            ];

            $this->view('pages/about', $data);
        }

        public function contact() {
            $data = [
                'title' => 'Contact page'
            ];

            $this->view('pages/contact');
        }
    }
