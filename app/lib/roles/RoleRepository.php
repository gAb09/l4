<?php

class RoleRepository {

	public function listRolesForSelect()
	{
		return Role::listForInputSelect('etiquette');
	}

}