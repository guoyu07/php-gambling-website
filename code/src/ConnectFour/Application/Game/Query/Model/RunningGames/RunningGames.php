<?php

namespace Gambling\ConnectFour\Application\Game\Query\Model\RunningGames;

final class RunningGames
{
    /**
     * @var int
     */
    private $count;

    /**
     * RunningGames constructor.
     *
     * @param int $count
     */
    public function __construct(int $count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }
}
