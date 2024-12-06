<?php

namespace TallStackUi\Foundation\Support\Runtime\Components;

use Exception;
use InvalidArgumentException;
use TallStackUi\Facades\TallStackUi;
use TallStackUi\Foundation\Support\Runtime\AbstractRuntime;

class NumberRuntime extends AbstractRuntime
{
    /** @throws Exception */
    public function runtime(): array
    {
        $bind = $this->bind();
        $chevron = $this->data('chevron');

        [$left, $right] = [
            $chevron ? 'chevron-down' : 'minus',
            $chevron ? 'chevron-up' : 'plus',
        ];

        $data = [
            'property' => $property = $bind->get('property'),
            'error' => $bind->get('error'),
            'id' => $bind->get('id'),
            'entangle' => $bind->get('entangle'),
            'icons' => [
                'left' => TallStackUi::icon($left),
                'right' => TallStackUi::icon($right),
            ],
        ];

        $value = $this->value($property);

        if (filled($value)) {
            $this->validate($value);
        }

        return $data;
    }

    private function validate(mixed $value): void
    {
        $min = $this->data('min');
        $max = $this->data('max');

        if (($min && $max) && ($min > $max)) {
            throw new InvalidArgumentException('The [number] min value must be less than the max value.');
        }

        if (($min && $max) && ($max < $min)) {
            throw new InvalidArgumentException('The [number] max value must be greater than the min value.');
        }

        $label = $this->wireable() ? 'wire:model' : 'value';

        if ($value && $min && ((int) $value < $min)) {
            throw new InvalidArgumentException("The [number] min value must be greater than or equals to the defined in [$label] property.");
        }

        if ($value && $max && ((int) $value > $max)) {
            throw new InvalidArgumentException("The [number] max value must be less than or equals to the defined in [$label] property.");
        }
    }
}
