<?php

namespace App\EventListener;

use App\Event\AppointmentTakenEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: AppointmentTakenEvent::class)]
class AppointmentListener
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function __invoke(AppointmentTakenEvent $event): void
    {
        $appointment = $event->getAppointment();

        $this->logger->info(
            'Appointment created: ' .
            $appointment->getFirstName() . ' ' .
            $appointment->getLastName()
        );
    }
}