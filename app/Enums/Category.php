<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Category: int implements HasLabel
{
    case A = 1;
    case B = 2;

    case C = 3;

    case D = 4;

    case E = 5;

    //
    public function getLabel(): ?string
    {
        return $this->name;
    }
}
