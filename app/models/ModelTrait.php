<?php
/**
* 
*/
trait ModelTrait
{
	
	// public static function listForInputSelect()
	// {
	// 	$list[0] = 'Faire une sélection';
	// 	foreach(static::all() as $banque)
	// 	{
	// 		$list[$banque->id] = $banque->nom;
	// 	}
	// 	return dd($list);
	// }

	public static function listForInputSelect($attribut, $scope = null)
	{

		if ($scope !== null) {
			$scope = 'scope'.$scope;
			$list = static::$scope();

		}else{

			foreach(static::get(['id', $attribut]) as $item)
			{
				$list[$item->id] = $item->{$attribut};
			}
		}
		$list[0] = 'Faire une sélection';

		return $list;
	}

}
