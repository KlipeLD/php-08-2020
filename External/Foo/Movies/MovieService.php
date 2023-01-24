<?php

namespace External\Foo\Movies;

use External\Foo\Exceptions\ServiceUnavailableException;

class MovieService
{
    /**
     * @throws ServiceUnavailableException
     *
     * @return array
     */
    public function getTitles(): array
    {
        if (rand(0, 20) === 0) {
            throw new ServiceUnavailableException();
        }

        return [
            "Attack of the 50 Foot Woman",
            "The Fish That Saved Pittsburgh",
            "Army of Darkness",
        ];
    }
}
