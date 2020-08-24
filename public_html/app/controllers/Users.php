<?php

    class Users extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User');
            $this->validator = new Validator();
        }

        // REGISTER
        public function register() {

            // IF POST METHOD
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password'])
                ];
                // Validations
                $validateData = [
                    'name' => ['minLen'],
                    'email' => ['required', 'taken'],
                    'password' => ['required', 'minLen'],
                    'confirm_password' => ['passMatch']
                ];


                // IF POST VALIDATION SUCCESSFUL
                $validated = $this->validator->validate($data, $validateData);
                $errors = $this->validator->errors;

                if ($validated) {
                    // Validated
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    // Register user
                    if($this->userModel->register($data)) {
                        flash('register_success', 'You are registered and can log in');
                        redirect ('users/login');
                    }
                }
                // IF POST VALIDATION FAILS
                $this->view('users/register', $data, $errors);
            }


            // IF NOT A POST METHOD SHOW AN EMPTY FORM
            else {
                // SHow the form is else
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                ];
                // Load view
                $this->view('users/register', $data);
                }
            }


        // LOGIN
        public function login() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password'])
                ];
                // Validations
                $validateData = [
                    'email' => ['required', 'exists'],
                    'password' => ['required']
                ];

                // IF POST VALIDATION SUCCESSFUL
                $validated = $this->validator->validate($data, $validateData);

                if ($validated) {
                    // Check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    // Create Session
                    $this->createUserSession($loggedInUser);
                }
                // If validation failed load view with errors
                $errors = $this->validator->errors;
                $this->view('users/login', $data, $errors);
            }


            // IF NOT A POST METHOD SHOW AN EMPTY FORM
            $data = [
                'email' => '',
                'password' => ''
            ];
            // Load view
            $this->view('users/login', $data);
            }

            public function createUserSession($user) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_name'] = $user->name;
                redirect('posts');
            }

            public function logout() {
                unset($_SESSION['user_id']);
                unset($_SESSION['user_email']);
                unset($_SESSION['user_name']);
                session_destroy();
                redirect('users/login');
            }
        }
