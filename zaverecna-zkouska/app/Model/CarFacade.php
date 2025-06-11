<?php

namespace App\Model;

use Nette\Database\Explorer;

class CarFacade
{
    private Explorer $database;

    public function __construct(Explorer $database)
    {
        $this->database = $database;
    }

    public function getAll(): array
    {
        return $this->database
            ->table('car')
            ->order('id')
            ->fetchAll();
    }

    public function insert(array $data): void
    {
    $this->database->table('car')->insert([
        'name' => $data['name'],
        'description' => $data['description'],
        'performance' => $data['performance'],
        'store_id' => $data['store_id']
    ]);
    }


    public function update(int $id, array $data): void
    {
    $this->database->table('car')->where('id', $id)->update([
        'name' => $data['name'],
        'description' => $data['description'],
        'performance' => $data['performance'],
        'store_id' => $data['store_id']
    ]);
    }


    public function findById(int $id)
    {
        return $this->database->table('car')->get($id);
    }
}
