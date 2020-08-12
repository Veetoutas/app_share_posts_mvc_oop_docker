<?php

    class Pages extends Controller{

        private $postModel;

        public function __construct(){
            //  Sets postModel to current model
        }

        public function index() {
            // Get the post from DB

            $data = [
                'title' => 'Custom MVC framework template',
            ];
            // Pass data from DB to view and show it
            $this->view('pages/index', $data);

        }

        public function about() {
            $data = [
                'title' => 'About page'
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
