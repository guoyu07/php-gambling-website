<?php

namespace Gambling\ConnectFour\Domain\Game\WinningRule;

use Gambling\ConnectFour\Domain\Game\Board\Board;
use Gambling\ConnectFour\Domain\Game\Board\Size;
use Gambling\ConnectFour\Domain\Game\Board\Stone;
use Gambling\ConnectFour\Domain\Game\Exception\InvalidNumberOfRequiredMatchesException;
use PHPUnit\Framework\TestCase;

class HorizontalWinningRuleTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfNumberOfRequiredMatchesIsLowerThanFour(): void
    {
        $this->expectException(InvalidNumberOfRequiredMatchesException::class);

        new HorizontalWinningRule(3);
    }

    /**
     * @test
     */
    public function itShouldCalculateForWin(): void
    {
        $size = new Size(7, 6);
        $board = Board::empty($size);
        $horizontalWinningRule = new HorizontalWinningRule(4);

        $this->assertFalse($horizontalWinningRule->calculate($board));

        $board = $board->dropStone(Stone::red(), 1);
        $board = $board->dropStone(Stone::red(), 2);
        $board = $board->dropStone(Stone::red(), 3);

        $this->assertFalse($horizontalWinningRule->calculate($board));

        $board = $board->dropStone(Stone::red(), 4);

        $this->assertTrue($horizontalWinningRule->calculate($board));
    }
}
