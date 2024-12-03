<?php

namespace App\Domain\Entities;

class User extends Base
{
    protected int $id;

    protected string $name;

    protected string $line_id;

    protected static array $required_params = ['id', 'name', 'line_id'];

    public function toArray()
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
