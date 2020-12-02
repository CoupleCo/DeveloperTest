<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Exception;

abstract class Entity extends Model
{
    protected $validationRules = [];
    protected $validator;

    public function isValid()
    {
        $rules = $this->validationRules();

        if ( ! isset($rules)) {
            throw new Exception('no validation rule array defined in class ' . get_called_class());
        }
        $this->validator = Validator::make($this->getAttributes(), $this->validationRules());

        return $this->validator->passes();
    }

    public function getErrors()
    {
        if ( ! $this->validator) {
            throw new Exception("No validator instantiated");
        }

        return $this->validator->errors();
    }

    public function save(array $options = [])
    {
        if ( ! $this->isValid()) {
            return false;
        }
        return parent::save($options);
    }

}
