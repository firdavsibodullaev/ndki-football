<?php

namespace App\Enums;

enum GamePlayerStatus: string
{
    case SUBSTITUTE = 'substitute';
    case ON_PITCH = 'on-pitch';
    case TO_SUBSTITUTE = 'to-substitute';
}
