<?php

namespace VFramework\Controllers;

use VFramework\Helpers\UrlHelper;
use VFramework\Libraries\Controller;
use VFramework\Models\Post;
use VFramework\Tools\Request;
use VFramework\Tools\Validator;

class Posts extends Controller {

    /**
     * @var Post
     */
    private $model;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Validator
     */
    public $validator;


    /**
     * Posts constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        if(!isLoggedIn()){
            UrlHelper::redirect('users/login');
        }
        $this->validator = $validator;
        $this->model = new Post(new Validator());
        $this->request = new Request();
    }


    public function index()
    {
        // Get posts
        $posts = $this->model->getAll();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    // ADD POST TO THE DATABASE
    public function add()
    {
        if ($this->request->requested('POST'))
        {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id']
            ];

            // IF POST VALIDATION SUCCESSFUL
            $validated = $this->validator->validate($data, POST_RULES);
            $errors = $this->validator->errors;

            if ($validated)
            {
                // Check if posting was successful
                $posted = $this->model->add($data);
                if($posted){
                    flash('post_message', 'Post Added');
                    UrlHelper::redirect('posts');
                }
            }
            // IF POST VALIDATION FAILS
            $this->view('posts/add', $data, $errors);
        }

        // IF NOT A POST METHOD SHOW AN EMPTY POST FORM
        $this->view('posts/add');
    }

    // SHOW THE PAGE OF THE POST
    public function show($id)
    {
        $post = $this->model->getById($id);
        $data = [
            'post' => $post
        ];
        $this->view('posts/show', $data);
    }
}
