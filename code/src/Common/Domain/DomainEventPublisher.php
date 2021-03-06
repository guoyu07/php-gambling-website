<?php

namespace Gambling\Common\Domain;

final class DomainEventPublisher
{
    /**
     * @var DomainEventSubscriber[]
     */
    private $subscribers;

    /**
     * Add subscriber.
     *
     * @param DomainEventSubscriber $subscriber
     */
    public function subscribe(DomainEventSubscriber $subscriber): void
    {
        $this->subscribers[] = $subscriber;
    }

    /**
     * Publish the given domain events.
     *
     * @param DomainEvent[] $domainEvents
     */
    public function publish(array $domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $this->publishSingle($domainEvent);
        }
    }

    /**
     * Publish the given domain event.
     *
     * @param DomainEvent $domainEvent
     */
    private function publishSingle(DomainEvent $domainEvent): void
    {
        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($domainEvent)) {
                $subscriber->handle($domainEvent);
            }
        }
    }
}
