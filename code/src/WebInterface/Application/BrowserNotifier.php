<?php

namespace Gambling\WebInterface\Application;

interface BrowserNotifier
{
    /**
     * Publish the message.
     *
     * @param string $channel
     * @param string $message
     */
    public function publish(string $channel, string $message): void;
}
