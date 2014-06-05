<?php namespace Lib\Validations;

use Illuminate\Validation\Factory as Validator;


/* aFa Voir pourquoi le snippet suivant eest nécessaire par rapport au tuto de BestMomo 
http://laravel.sl-creation.org/laravel-4-chapitre-32-organiser-son-code/*/
\App::bind('Symfony\Component\Translation\TranslatorInterface', function($app) {
   return $app['translator']; 
});

abstract class ValidationBase implements ValidationInterface
{

    protected $rules;

    protected $messages;

    protected $validator;

    public function __construct(Validator $validator)
    {
        /* aFa Voir pourquoi le snippet suivant est nécessaire par rapport au tuto de BestMomo */
        $this->validator = \App::make('validator'); 
    }

    public function validate(array $inputs, $rules_sup = array())
    {

        $rules = $rules_sup+$this->rules;

        $v = $this->validator->make($inputs, $rules, $this->messages);

        if ($v->passes()) {
           return true;
       } else {
        return $v->messages();
    }
}

}