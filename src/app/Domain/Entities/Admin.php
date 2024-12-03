<?php

namespace App\Domain\Entities;

class Admin extends Base
{
    protected int $id;

    protected string $name;

    protected ?string $password = null;

    protected static array $required_params = ['id', 'name'];

    public function toArray()
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'password' => $this->password,
        ];
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }
}
