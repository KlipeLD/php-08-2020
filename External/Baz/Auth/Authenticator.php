<?php

namespace External\Baz\Auth;

use External\Baz\Auth\Responses\Failure;
use External\Baz\Auth\Responses\Success;
use External\Baz\Auth\Responses\IResponse;

class Authenticator
{
    /**
     * On success returns Success otherwise Failure.
     *
     * @param string $login
     * @param string $password
     *
     * @return IResponse
     */
    public function auth(string $login, string $password): IResponse
    {
        if (
            preg_match("/^BAZ_.*/", $login, $matches) &&
            $password === "foo-bar-baz"
        ) {
            return new Success();
        }

        return new Failure();
    }
}
