<?php

namespace External\Baz\Movies;

use External\Baz\Exceptions\ServiceUnavailableException;

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
            'titles' => [
                "The Kentucky Fried Movie",
                "The Public Enemy",
                "Dog Day Afternoon",
            ]
        ];
    }
}
