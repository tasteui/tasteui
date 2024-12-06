<?php

namespace TallStackUi\Foundation\Support\Runtime\Components;

use Exception;
use InvalidArgumentException;
use TallStackUi\Foundation\Support\Runtime\AbstractRuntime;

class SelectStyledRuntime extends AbstractRuntime
{
    /** @throws Exception */
    public function runtime(): array
    {
        $bind = $this->bind();

        $data = [
            'property' => $property = $bind->get('property'),
            'error' => $bind->get('error'),
            'id' => $bind->get('id'),
            'entangle' => $bind->get('entangle'),
            'value' => $value = $this->sanitize(),
            'change' => $this->change(),
            'disabled' => (bool) $this->data['attributes']->get('disabled', $this->data['attributes']->get('readonly', false)),
        ];

        $value = $this->value($property, $value);

        if (filled($value)) {
            $this->validate($value);
        }

        return $data;
    }

    private function validate(mixed $value): void
    {
        if (blank($value)) {
            return;
        }

        $label = $this->wireable() ? 'wire:model' : 'value';
        $multiple = $this->data('multiple');

        // TODO tests
        if ($multiple && ! is_array($value)) {
            throw new InvalidArgumentException("The [select.styled] [$label] must be an array when multiple is set.");
        }

        if (! $multiple && is_array($value)) {
            throw new InvalidArgumentException("The [select.styled] [$label] must not be an array when multiple is not set.");
        }
    }
}
