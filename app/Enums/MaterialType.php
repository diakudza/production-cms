<?php

namespace App\Enums;

enum MaterialType : string {
    case round = 'Круг';
    case hexagon = 'Шестигранник';
    case tube = 'Труба';
    case square = 'Квадрат';
}
