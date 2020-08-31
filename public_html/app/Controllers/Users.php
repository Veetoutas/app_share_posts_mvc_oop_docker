<?php

namespace VFramework\Controllers;

use VFramework\Helpers\UrlHelper;
use VFramework\Libraries\Controller;
use VFramework\Models\User;
use VFramework\Tools\Request;
use VFramework\Tools\Validator;


class Users extends Controller {

    /**
     * @var mixed
     */
    private $model;
    /**
     * @var Validator
     */
    public $validator;
    /**
     * @var Request
     */
    private $request;


    /**
     * Users constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator) {
        $this->validator = $validator;
        $this->model = new User(new Validator());
        $this->request = new Request();
    }

    public function index()
    {
        return $this->view('users/register');
    }

    // REGISTER
    public function add() {

        // IF POST METHOD
        if ($this->request->requested('POST')) {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password'])
            ];

            // IF POST VALIDATION SUCCESSFUL
            $validated = $this->validator->validate($data, REG_RULES);
            $errors = $this->validator->errors;

            if ($validated) {
                // Validated
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // Register user
                if($this->model->add($data)) {
                    flash('register_success', 'You are registered and can log in');
                    UrlHelper::redirect('users/login');
                }
            }
            // IF POST VALIDATION FAILS
            $this->view('users/register', $data, $errors);
        }
        $this->view('users/register');
    }


    // LOGIN
    public function login() {
        // IF POST METHOD
        if ($this->request->requested('POST')) {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password'])
            ];

            // IF POST VALIDATION SUCCESSFUL
            $validated = $this->validator->validate($data, LOGIN_RULES);

            if ($validated) {
                // Check and set logged in user
                $loggedInUser = $this->model->login($data['email'], $data['password']);
                // Create Session
                $this->createUserSession($loggedInUser);
            }
            // If validation failed load view with errors
            $errors = $this->validator->errors;
            $this->view('users/login', $data, $errors);
        }


        // IF NOT A POST METHOD SHOW AN EMPTY FORM
        $this->view('users/login');
        }

        /**
         * @param $user
         */
        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            UrlHelper::redirect('posts');
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            UrlHelper::redirect('users/login');
        }
    }
