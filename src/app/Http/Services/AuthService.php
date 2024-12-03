<?php

namespace App\Http\Services;

use App\Exceptions\Auth\LoginException;
use App\Repositories\LineRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class AuthService extends BaseService
{
    protected UserRepositoryInterface $userRepository;

    protected LineRepositoryInterface $lineRpository;

    public function __construct(UserRepositoryInterface $userRepository, LineRepositoryInterface $lineRpository)
    {
        $this->userRepository = $userRepository;
        $this->lineRpository = $lineRpository;
    }

    /**
     * ログイン処理
     *
     * @throws LoginException
     */
    public function login(array $request): void
    {
        $lineProfile = $this->lineRpository->verifyIdToken($request['idToken']);

        $user = $this->userRepository->findForLineID($lineProfile->getProperty('user_id'));

        if (! $user) {
            $user = $this->userRepository->insert($lineProfile->getProperty('user_id'), $lineProfile->getProperty('name'));
        }
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request): void
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
