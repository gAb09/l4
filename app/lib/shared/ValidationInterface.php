<?php namespace Lib\Validations;
 
interface ValidationInterface {
 
    public function validate(array $inputs, array $modes);
 
}