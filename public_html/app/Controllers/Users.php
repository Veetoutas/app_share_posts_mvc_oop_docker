<?php

namespace VFramework\Controllers;

use VFramework\Helpers\UrlHelper;
use VFramework\Libraries\Controller;
use VFramework\Models\User;
use VFramework\Tools\Request;
use VFramework\Tools\Validator;


class Users extends Controller
{

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

    public const LOGIN_RULES = [
        'email' => [
        'required',
        'exists'
        ],
        'password' => [
        'required'
        ]
    ];

    public const REGISTRATION_RULES = [
        'email' => [
        'required',
        'emailIsUnique'
        ],
        'password' => ['required'],
        'confirm_password' => ['passwordsMatch']
    ];

    /**
     * Users constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
        $this->model = new User();
        $this->request = new Request();
    }

    public function index(): void
    {
        $this->view('users/register');
    }

    // REGISTER
    public function add(): void
    {
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
            $validated = $this->validator->validate($data, self::REGISTRATION_RULES);
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
    public function login(): void
    {
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
            $validated = $this->validator->validate($data, self::LOGIN_RULES);
            if ($validated) {
                // Check and set logged in user
                try {
                    $loggedInUser = $this->model->login($data['email'], $data['password']);

                } catch (\Exception $exception) {
                    $error = [$exception->getMessage()];
                    $this->view('users/login', $data, $error);
                }
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
    public function createUserSession($user): void
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        UrlHelper::redirect('posts');
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        UrlHelper::redirect('users/login');
    }
}
