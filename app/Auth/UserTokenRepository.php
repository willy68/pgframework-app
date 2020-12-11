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

    public function saveToken(array $token): ?TokenInterface
    {
        if (!empty($token)) {
            return null;
        }
        /** @var UserToken */
        $tokenModel = new $this->model();
        $tokenModel->create($this->getParams($token));
        return $tokenModel;
    }

    protected function getParams(array $params): array
    {
        $params = array_filter($params, function ($key) {
            return in_array($key, ['credential', 'random_password', 'expiration_date', 'is_expired']);
        }, ARRAY_FILTER_USE_KEY);
        /*return array_merge($params, [
            'updated_at' => date('Y-m-d H:i:s')
        ]);*/
        return $params;
    }
}
