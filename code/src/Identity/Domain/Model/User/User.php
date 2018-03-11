<?php

namespace Gambling\Identity\Domain\Model\User;

use Gambling\Common\Domain\AggregateRoot;
use Gambling\Common\Domain\IsAggregateRoot;
use Gambling\Identity\Domain\Model\User\Event\UserArrived;
use Gambling\Identity\Domain\Model\User\Event\UserSignedUp;
use Gambling\Identity\Domain\Model\User\Exception\UserAlreadySignedUpException;

class User implements AggregateRoot
{
    use IsAggregateRoot;

    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var bool
     */
    private $isSignedUp;

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * User constructor.
     *
     * @param UserId $userId
     */
    private function __construct(UserId $userId)
    {
        $this->userId = $userId;
        $this->isSignedUp = false;
    }

    /**
     * A new user arrives.
     *
     * @return User
     */
    public static function arrive(): User
    {
        $user = new self(
            UserId::generate()
        );

        $user->domainEvents[] = new UserArrived(
            $user->userId
        );

        return $user;
    }

    /**
     * The user signs up.
     *
     * @param Credentials $credentials
     *
     * @throws UserAlreadySignedUpException
     */
    public function signUp(Credentials $credentials): void
    {
        if ($this->isSignedUp) {
            throw new UserAlreadySignedUpException();
        }

        $this->isSignedUp = true;
        $this->credentials = $credentials;

        $this->domainEvents[] = new UserSignedUp(
            $this->userId,
            $this->credentials->username()
        );
    }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->userId;
    }

    /**
     * @return Credentials
     */
    public function credentials(): Credentials
    {
        return $this->credentials;
    }
}
