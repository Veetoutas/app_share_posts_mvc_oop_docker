<?php

class Validator
{

    public $errors = [];

    public function __construct()
    {
        $this->controller = new Controller();
        $this->userModel = $this->controller->model('User');
    }


    public function validate($data, $validateData = [])
    {
        foreach ($validateData as $item => $rules) {
            $this->passes($data[$item], $rules, $item);
        }

        // If errors[] consist of empty errors ' ', return true
        $noErrors = (count(array_unique($this->errors)) === 1);

        if ($noErrors) {
            return true;
        }
        return false;
    }


    public function passes($value, $rules, $fieldName)
    {
        foreach ($rules as $rule) {
            $result = $this->{$rule}($value, $fieldName);

            if ($result) {
                $this->errors[] = '';
            }
            $errors = $this->errors;
        }
    }


    public function required($value, $fieldName)
    {
         if(empty($value)) {
             $this->errors[] = '- ' . ucfirst($fieldName) . ' is empty' . '<br>';
             return false;
        }
             return true;
    }

    public function minLen($value, $fieldName)
    {
        if(strlen($value) < 6) {
            $this->errors[] = '- ' . ucfirst($fieldName) . ' must consist of at least 6 characters' . '<br>';
            return false;
        }
            return true;

    }

    public function taken($value, $fieldName){
        if($this->userModel->findByEmail($value)) {
            $this->errors[] = '- ' . ucfirst($fieldName) . ' is already taken' . '<br>';
            return false;
        }
            return true;
    }


    public function passMatch($value) {
        if(trim($_POST['password']) != trim($_POST['confirm_password'])) {
            $this->errors[] = '- Passwords do not match' . '<br>';
            return false;
        }
            return true;
    }

    public function exists($value, $fieldName) {
        if(!$this->userModel->findByEmail($value)) {
            $this->errors[] = '- User with that ' . $fieldName . ' does not exist' . '<br>';
            return false;
        }
        return true;
    }
}
?>
