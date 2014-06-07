<?php
/**
* 
*/
trait ModelTrait
{
	
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

	public  function fillFormForCreate(){
		foreach ($this->default_values_for_create as $key => $value) {
			$this->{$key} = $this->default_values_for_create[$key];
		}
		return $this;
	}

}
