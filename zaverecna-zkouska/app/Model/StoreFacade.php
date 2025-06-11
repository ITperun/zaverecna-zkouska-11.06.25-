<?php

namespace App\Model;

use Nette\Database\Explorer;

class StoreFacade
{
	private Explorer $db;

	public function __construct(Explorer $db)
	{
		$this->db = $db;
	}

	public function getAll(): array
	{
		return $this->db->table('store')->fetchAll();
	}
}
