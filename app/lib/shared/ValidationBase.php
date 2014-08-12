<?php namespace Lib\Validations;
use Illuminate\Validation\Factory as Factory;
use Illuminate\Validation\Validator as Validator;
use Symfony\Component\Translation\TranslatorInterface;

\App::bind('Symfony\Component\Translation\TranslatorInterface', function($app) {
           return $app['translator'];
       });

abstract class ValidationBase extends Validator implements ValidationInterface
{

    protected $rules;

    protected $messages;

    protected $factory;

    public function __construct(Factory $factory){
        $this->factory = $factory;
       //  $this->rules = $this->explodeRules($this->rules);
       // var_dump('validator instancié');

    }



    /**
     * Effectuer les validations de formulaires.
     *
     * @param  array  $input
     * @param  array  $modes ( => (Mode ( ParamDyn => Valeur ))
     * Tableau indexés contenant des $mode = ($param => $value)
     * @return true|$messages
     */
    public function valider(array $input)
    {
$this->data = $input;
        // Parser chaque règle pour y détecter des constantes et les remplacer par leur valeur
        $this->rules = $this->parserListePourConstantes($this->rules);

$validateur = \Validator::make($this->data, $this->rules, $this->messages);
        // Faire la validation via Laravel
        // dd('valider'); // CTRL
        // dd($this->rules);
        dd($this->messages);
        // dd($validateur);

        if ($validateur->passes()) {
            return true;
        } else {
            return $validateur->messages();
        }
    }



    /**
     * Parser les règles pour y détecter d'éventuelles constantes.
     *
     * @param  array  $rules
     * 
     * @return array  $rules
     */
    private function parserListePourConstantes(&$rules)
    {
        // echo 'parserListePourConstantes';var_dump($rules); // CTRL
        foreach ($rules as $attribut => $lignes)
        {
            // var_dump($attribut);var_dump($lignes); // CTRL
            if(is_array($lignes))
            {
                foreach ($lignes as $key => $ligne) {
                    $rules[$attribut][$key] = $this->parseLigneForConstantes($ligne);
                }
            }else{
                $rules[$attribut] = $this->parseLigneForConstantes($lignes);
            }
        }
        // echo 'constantes remplacées';var_dump($rules); // CTRL

        return $rules;
    }



    protected function parseLigneForConstantes($ligne)
    {
        $parameters = array();

        if (strpos($ligne, ':') !== false)
        {
            list($regle, $parameters) = explode(':', $ligne, 2);

            $parameters = $this->parseParametersForConstantes($parameters);
            $ligne = $regle.':'.implode(',', $parameters);
        }

        return $ligne;
    }

    protected function parseParametersForConstantes($parameters)
    {
        $parameters = str_getcsv($parameters);

        foreach ($parameters as $key => $value) {
            if (defined($value))
            {
                $parameters[$key] = constant($value);
            }
        }
        return $parameters;
    }

// Rules [ =>   Attribut [ NomRègle => DéfinitionRègle ] ]

// Messages [ => Attribut [ NomRègle => Message ] ]

}