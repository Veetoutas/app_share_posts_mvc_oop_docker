<?php
    class Posts extends Controller {

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }
            $this->postModel = $this->model('Post');
            $this->validator = new Validator();
        }

        public function index(){
            // Get posts
            $posts = $this->postModel->getPosts();

            $data = [
                'posts' => $posts
            ];

            $this->view('posts/index', $data);
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id']
                ];
                // Validations
                $validateData = [
                    'title' => ['required'],
                    'body' => ['required']
                ];

                // IF POST VALIDATION SUCCESSFUL
                $validated = $this->validator->validate($data, $validateData);
                $errors = $this->validator->errors;

                if ($validated) {
                    // Check if posting was successful
                    $posted = $this->postModel->addPost($data);
                    if($posted){
                        flash('post_message', 'Post Added');
                        redirect('posts');
                    }
                }
                // IF POST VALIDATION FAILS
                $this->view('posts/add', $data, $errors);
            }

            // IF NOT A POST METHOD SHOW AN EMPTY POST FORM
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->view('posts/add', $data);
        }

        public function show($id){
            $post = $this->postModel->getPostById($id);

            $data = [
                'post' => $post
            ];

            $this->view('posts/show', $data);
        }
    }
