<?php

namespace VFramework\Controllers;

use VFramework\Helpers\UrlHelper;
use VFramework\Libraries\Controller;
use VFramework\Models\Post;
use VFramework\Models\User;
use VFramework\Tools\Request;
use VFramework\Tools\Validator;

class Posts extends Controller
{

    /**
     * @var Post
     */
    private Post $model;
    /**
     * @var Request
     */
    private Request $request;
    /**
     * @var Validator
     */
    public Validator $validator;
    /**
     * @var User
     */

    public const RULES = [
        'title' => ['required'],
        'body' => ['required']
    ];

    /**
     * Posts constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        if (!isLoggedIn()) {
            UrlHelper::redirect('users/login');
        }
        $this->validator = $validator;
        $this->model = new Post(new Validator());
        $this->request = new Request();
    }

    public function index(): void
    {
        $this->view('posts/index', [
            'posts' => $this->model->getAll()
        ]);
    }


    // ADD POST TO THE DATABASE
    public function add(): void
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

    /**
     * @param $id
     */
    public function edit(int $id): void
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
        if ($post->user_id !== $_SESSION['user_id']) {
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
    /**
     * @param $id
     */
    public function show($id): void
    {
        $userModel = new User();
        $post = $this->model->getBy(['id' => $id]);
        $this->view('posts/show', [
            'post' => $post,
            'user' => $userModel->getBy(['id' => $post->user_id])
        ]);
    }

    /**
     * @param $id
     */
    public function delete($id): void
    {
        // If request method is 'POST'
        if ($this->request->requested('POST')) {
            // Try to delete the post and catch errors if something went wrond
            try {
                $this->model->delete(['id' => $id]);
                flash('post_message', 'Post deleted successfully');
                UrlHelper::redirect('posts');
            } catch (\Exception $exception) {
                flash('post_message', $exception->getMessage());
                UrlHelper::redirect('posts');
            }
        }
        // If request method is else but 'POST' just redirect to Posts page
        UrlHelper::redirect('posts');
    }
}
