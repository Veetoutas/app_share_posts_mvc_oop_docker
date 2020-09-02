<?php

namespace VFramework\Tools;

use VFramework\Libraries\Controller;
use VFramework\Models\AbstractModel;
use VFramework\Models\User;

class Validator
// tipo i sitos klases funkcija sita
{
    public $errors = [];
    public function __construct(AbstractModel $model = null)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @param array $validateData
     * @return bool
     */
    public function validate($data, $validateData = [])
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
    public function passes($value, $rules, $fieldName)
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
    public function required($value, $fieldName)
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
    public function minLen($value, $fieldName)
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
    public function passwordsMatch(): bool {
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
    public function exists($value, $fieldName): bool {
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
    public function emailIsUnique($value, $fieldName): bool {
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
    public function rightPassword($data)
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
