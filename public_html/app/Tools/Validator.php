<?php

namespace VFramework\Tools;

use VFramework\Libraries\Controller;
use VFramework\Models\AbstractModel;
use VFramework\Models\User;

class Validator
{
    /**
     * @var array
     */
    public $errors = [];

    /**
     * Validator constructor.
     * @param AbstractModel|null $model
     */
    public function __construct(AbstractModel $model = null)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @param array $validateData
     * @return bool
     */
    public function validate(array $data, $validateData = []): bool
    {
        foreach ($validateData as $item => $rules) {
            $this->passes($data[$item], $rules, $item);
        }
        // If errors[] consist of empty errors ' ', return true
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @param $rules
     * @param $fieldName
     */
    public function passes(string $value, array $rules, string $fieldName): void
    {
        foreach ($rules as $rule) {
            $result = $this->{$rule}($value, $fieldName);

            if ($result) {
                continue;
            }
            $errors = $this->errors;
        }
    }

    /**
     * @param $value
     * @param $fieldName
     * @return bool
     */
    public function required(string $value, string $fieldName): bool
    {
        if (empty($value)) {
             $this->errors[] = '- ' . ucfirst($fieldName) . ' is empty' . '<br>';
             return false;
        }
             return true;
    }

    /**
     * @param $value
     * @param $fieldName
     * @return bool
     */
    public function minLen(string $value, string $fieldName): bool
    {
        if (strlen($value) < 6) {
            $this->errors[] = '- ' . ucfirst($fieldName) . ' must consist of at least 6 characters' . '<br>';
            return false;
        }
            return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public function passwordsMatch(): bool
    {
        if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
            $this->errors[] = '- Passwords do not match' . '<br>';
            return false;
        }
            return true;
    }

    /**
     * @param $value
     * @param $fieldName
     * @return bool
     */
    public function exists(string $value, string $fieldName): bool
    {
        if (!$this->model->findByEmail($value)) {
            $this->errors[] = '- User with that ' . $fieldName . ' does not exist' . '<br>';
            return false;
        }
        return true;
    }

    /**
     * @param $value
     * @param $fieldName
     * @return bool
     */
    public function emailIsUnique(string $value, string $fieldName): bool
    {
        if ($this->model->findByEmail($value)) {
            $this->errors[] = '- User with that ' . $fieldName . ' is already taken' . '<br>';
            return false;
        }
        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function rightPassword(array $data): bool
    {
        $email = $data['email'];
        $pass = $this->model->findByEmail($email);
        if(password_verify($data['password'], $pass->password)) {
            return true;
        }
        $this->errors[] = 'Password is incorrect'  . '<br>';
        return false;
    }
}
