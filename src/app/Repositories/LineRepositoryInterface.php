<?php

namespace App\Repositories;

interface LineRepositoryInterface
{
    public function verifyIdToken(string $token);
}
