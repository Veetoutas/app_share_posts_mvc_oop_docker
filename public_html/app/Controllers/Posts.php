<?php

namespace VFramework\Controllers;

use VFramework\Helpers\UrlHelper;
use VFramework\Libraries\Controller;
use VFramework\Models\Post;
use VFramework\Models\User;
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
     * @var User
     */
    private $userModel;

    public const RULES = [
        'title' => ['required'],
        'body' => ['required']
    ];

    /**
     * Posts constructor.
     * @param Validator $validator
     * @param User $userModel
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
        $this->view('posts/index', [
            'posts' =>$this->model->getAll()
        ]);
    }


    // ADD POST TO THE DATABASE
    /**
     * @param array $data
     */
    public function add()
    {
        if ($this->request->requested('POST')) {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id']
            ];

            // IF POST VALIDATION SUCCESSFUL
            if ($this->validator->validate($data, self::RULES)) {
                // Check if posting was successful
                if ($this->model->add($data)) {
                    flash('post_message', 'Post Added');
                    UrlHelper::redirect('posts');
                }
            }
            // IF POST VALIDATION FAILS
            $this->view('posts/add', $data, $this->validator->errors);
        }

        // IF NOT A POST METHOD SHOW AN EMPTY POST FORM
        $this->view('posts/add');
    }


    public function edit($id)
    {
        if ($this->request->requested('POST')) {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id']
            ];

            // IF POST VALIDATION SUCCESSFUL
            if ($this->validator->validate($data, self::RULES)) {
                // Check if posting was successful
                if ($this->model->add($data)) {
                    flash('post_message', 'Post Added');
                    UrlHelper::redirect('posts');
                }
            }
            // IF POST VALIDATION FAILS
            $this->view('posts/add', $data, $this->validator->errors);
        }
        // Get existing post from model
        $post = $this->model->getBy(['id' => $id]);
        if ($post->user_id != $_SESSION['user_id']) {
            UrlHelper::redirect('posts');
        }
        // IF NOT A POST METHOD SHOW AN EMPTY POST FORM
        $this->view('posts/edit', [
            'id' => $id,
            'title' => $post->title,
            'body' => $post->body
        ]);
    }

    // SHOW A SINGLE PAGE OF THE POST
    public function show($id)
    {
        $this->userModel = new User();
        $post = $this->model->getBy(['id' => $id]);
        $this->view('posts/show', [
            'post' => $post,
            'user' => $this->userModel->getBy(['id' => $post->user_id])
        ]);
    }
}
