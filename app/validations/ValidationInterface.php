<?php namespace Lib\Validations;
 
interface ValidationInterface {
 
    public function validate(array $inputs, $rules_sup = array());
 
}