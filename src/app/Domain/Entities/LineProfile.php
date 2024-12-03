<?php

namespace App\Domain\Entities;

class LineProfile extends Base
{
    protected string $userId; //ユーザーID

    protected string $name; //ユーザー名

    protected string $channelId; //チャネルID

    protected int $expiresIn; //IDトークンの有効期限

    protected static array $required_params = ['user_id', 'name', 'channel_id', 'expires_in'];

    public function toArray()
    {

        return [];
    }
}
