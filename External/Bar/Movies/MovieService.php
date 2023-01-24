<?php

namespace External\Bar\Movies;

use External\Bar\Exceptions\ServiceUnavailableException;

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
                [
                    'title' => "Star Wars: Episode IV - A New Hope",
                    'summary' => "After Princess Leia, the leader of the Rebel Alliance, is held hostage by Darth Vader, Luke and Han Solo must free her and destroy the powerful weapon created by the Galactic Empire."
                ],
                [
                    'title' => "The Devil and Miss Jones",
                    'summary' => "John P Merrick, the world's richest man, is annoyed to hear workers at one of his stores are trying to form a union. Getting a menial job, he's determined to root out the troublemakers ..."
                ],
            ]
        ];
    }
}
