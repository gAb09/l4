<?php

class MenuRepository {

	public function listRolesForSelect()
	{
		return Role::listForInputSelect('etiquette');
	}

}