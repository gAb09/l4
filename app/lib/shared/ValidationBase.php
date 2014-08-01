<?php namespace Lib\Validations;

use Illuminate\Validation\Factory as Validator;


/* aFa Voir pourquoi le snippet suivant eest nécessaire par rapport au tuto de BestMomo 
http://laravel.sl-creation.org/laravel-4-chapitre-32-organiser-son-code/*/
\App::bind('Symfony\Component\Translation\TranslatorInterface', function($app) {
   return $app['translator']; 
});

abstract class ValidationBase implements ValidationInterface
{

    protected $liste_base;

    protected $messages;

    protected $validator;

    public function __construct(Validator $validator)
    {
        /* aFa Voir pourquoi le snippet suivant est nécessaire par rapport au tuto de BestMomo */
        $this->validator = \App::make('validator'); 
    }


    /**
     * Effectuer les validations de formulaires.
     *
     * @param  array  $input
     * @param  array  $modes
     * Tableau indexés contenant des $mode = ($param => $value)
     * @return true|$messages
     */
    public function validate(array $inputs, array $modes)
    {
        var_dump('assemblerListes');
        // Composer la liste finale en fonction du(des) mode(s)
        $rules = $this->assemblerListes($modes);

        // Parser chaque règle pour y détecter des constantes et les remplacer par leur valeur
        $rules = $this->parserListePourConstantes($rules);
// dd($rules);
        // Faire la validation via les fonctions de Laravel
        $v = $this->validator->make($inputs, $rules, $this->messages);

        if ($v->passes()) {
            return true;
        } else {
            return $v->messages();
        }
    }


    /**
     * Composer la liste finale.
     * À partir de la liste de base, ajouter les listes de règles de chaque mode.
     *
     * @param  array  $modes
     * @return array    $liste
     */
    private function assemblerListes($modes)
    {
        // D'abord la liste de base
        $liste = $this->liste_base;

        // Obtenir la liste de règles pour chaque mode et l'ajouter à la liste de base
        if (!is_null($modes)) {
            foreach ($modes as $mode => $params) {

        // Composer le nom de la liste spécifique
                $nom_liste = "liste_{$mode}";

        // Obtenir la liste spécifique et l'ajouter à la liste globale
                $liste = $liste + $this->getListeDuMode($nom_liste, $params);
            }
        }
        return $liste;
    }


    /**
     * Pour chaque mode, composer le nom de sa liste spécifique,
     * et le cas échéant remplacer les paramètres par leur valeur.
     *
     * @param  string|array  $mode
     * 
     * @return array    $liste
     */
    private function getListeDuMode($nom_liste, $params)
    {
        $liste_mode = $this->$nom_liste;

        foreach ($liste_mode as $attr => $ligne) {
            $liste_mode[$attr] = $this->parserRules($ligne, $params); 
        }
        return $liste_mode;

    }

    /**
     * Parser les règles pour y détecter d'éventuelles constantes.
     *
     * @param  array  $rules
     * 
     * @return array  $rules
     */
    private function parserRules($ligne, $params)
    {
        foreach ($params as $parametre => $valeur) {
            $ligne = str_replace("<$parametre>", $valeur, $ligne);
        }
        return $ligne;  }


    /**
     * Parser les règles pour y détecter d'éventuelles constantes.
     *
     * @param  array  $rules
     * 
     * @return array  $rules
     */
    private function parserListePourConstantes($rules)
    {
        // // dd($rules);
        foreach ($rules as $key => &$rule)
        {
            $rule = (is_string($rule)) ? explode('|', $rule) : $rule;

            foreach ($rule as $key => $value) {
                $rule[$key] = $this->parseRuleForConstantes($value);
            }
        }
        return $rules;
    }











    protected function parseRuleForConstantes($rule)
    {
        $parameters = array();

        if (strpos($rule, ':') !== false)
        {
            list($regle, $parameters) = explode(':', $rule, 2);

            $parameters = $this->parseParametersForConstantes($parameters);
            $rule = $regle.':'.implode(',', $parameters);
        }

        return $rule;
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



}
