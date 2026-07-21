<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('render_opening_hours', [$this, 'renderOpeningHours'], [
                'is_safe' => ['html']
            ]),
        ];
    }

    public function renderOpeningHours(array $openingHours): string
    {
        $today = (int) (new \DateTimeImmutable('today'))->format('N');

        $days = [
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche',
        ];

        $html = '';

        foreach ($openingHours as $openingHour) {

            $class = $openingHour->getDay() === $today ? 'today' : '';

            $html .= '<tr class="' . $class . '">';

            $html .= '<td>'
                . $days[$openingHour->getDay()]
                . '</td>';

            if (!$openingHour->getOpening() || !$openingHour->getClosing()) {
                $html .= '<td class="hours">Fermé</td>';
            } else {
                $html .= '<td class="hours">'
                    . $openingHour->getOpening()->format('G\h')
                    . ' - '
                    . $openingHour->getClosing()->format('G\h')
                    . '</td>';
            }

            $html .= '</tr>';
        }

        return $html;
    }
}