<?php
namespace Gab\DatesFr;
 
use Illuminate\Support\Facades\Facade;
 
class DatesFrFacade extends Facade {
 
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'datesfr'; }
 
}