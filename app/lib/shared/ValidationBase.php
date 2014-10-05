<?php
namespace Lib\Validations;

use Illuminate\Validation\Factory as Factory;
use Illuminate\Validation\Validator as Validator;
use Symfony\Component\Translation\TranslatorInterface;

    // aFa : Voir pourquoi il faut binder le translator alors que ce n'est pas le cas dans le tuto de BestMomo
\App::bind('Symfony\Component\Translation\TranslatorInterface', function($app) {
   return $app['translator'];
});


abstract class ValidationBase implements ValidationInterface
{

    protected $rules;

    protected $messages;

    protected $factory;

    public function __construct(Factory $factory){
        $this->factory = $factory;
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
        $this->rules = $this->parserRules($this->rules);

        $validateur = \Validator::make($this->data, $this->rules, $this->messages);

        // Faire la validation via Laravel

                                    // echo "this->rules : ";var_dump($this->rules);
                                    // echo "this->messages : ";var_dump($this->messages);
                                    // echo "validateur : ";var_dump($validateur);
                                    // dd('valider'); // CTRL

        if ($validateur->passes()) {
            return true;
        } else {
            return $validateur->messages();
        }
    }



    /**
     * Parser les règles pour y détecter d'éventuelles constantes,
     * et effectuer leur remplacement par les chaînes paramétrées.
     *
     * @param  array  $rules
     * 
     * @return array  $rules
     */
    private function parserRules($rules)
    {
        // Parcourir $rules et extraire chaque regles_attribut
        foreach ($rules as $attribut => $regles_attribut)
        {
            if (strpos($regles_attribut, '|') !== false){
                $regles_attribut =  $this->parserReglesAttribut($regles_attribut);  // Si plusieurs regles_attribut
                $rules[$attribut] = $regles_attribut;
            }else{
                $regles_attribut =  $this->parserRegle($regles_attribut); // Si une seule
                $rules[$attribut] = $regles_attribut;
            }
        }
        return $rules;
    }





    /**
     * Décomposer regles_attribut en règle.
     *
     * @param  string
     * 
     * @return string
     */
    private function parserReglesAttribut($regles_attribut)
    {
        $string = '';

        $regles_attribut = explode('|', $regles_attribut); // on décompose en regle

        foreach ($regles_attribut as $regle)
        {
            $regle =  $this->parserRegle($regle);
            $string .= $regle.'|';
        }
        return rtrim($string, '|');
    }



    /**
     * Extraire les paramètres d'une règle.
     *
     * @param  string
     * 
     * @return string
     */
    private function parserRegle($regle)
    {
        if (strpos($regle, ':') !== false) {
            list($nomregle, $parameters) = explode(':', $regle, 2);   // On extrait les paramètres s'ils existent

            $parameters = $this->detecterConstante($parameters);

            return $nomregle.':'.$parameters;
        }
        return $regle;
    }


    private function detecterConstante($parameters)
    {
        $string ='';

        if (strpos($parameters, ',') !== false) {  // Si plusieurs parametres

            $parameters = str_getcsv($parameters);  // on décompose

            foreach ($parameters as $parameter) {
                if (defined($parameter)){
                    $parameter = constant($parameter);
                }
                    $string .= $parameter.',';  // on traite et on recompose
                }
            }else{
                if (defined($parameters))
                {
                    $parameters = constant($parameters);
                }
                $string = $parameters;
            }
            return rtrim($string, ',');
        }
    }