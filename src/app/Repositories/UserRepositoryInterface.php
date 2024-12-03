<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findForLineID($line_id);

    public function insert(string $line_id, string $name);
}
