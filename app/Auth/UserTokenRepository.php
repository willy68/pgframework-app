<?php

namespace App\Auth;

use App\Auth\Models\UserToken;
use Framework\Auth\TokenInterface;
use Framework\Auth\Repository\TokenRepositoryInterface;

class UserTokenRepository implements TokenRepositoryInterface
{
    /**
     * 
     * @var UserToken
     */
    protected $model = UserToken::class;
    /**
     * get cookie token from database with ActiveRecord library
     * 
     * use user credential (ex. username or email)
     *
     * @param string $credential
     * @return TokenInterface|null
     */
    public function getToken(string $credential): ?TokenInterface
    {
        try {
            $token = $this->model::find(['conditions' => ["credential = ?", $credential]]);
        } catch(\Exception $e) {
            return null;
        }
        if ($token) {
            return $token;
        }
        return null;
    }
}
