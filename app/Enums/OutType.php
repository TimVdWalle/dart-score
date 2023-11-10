<?php

namespace App\Enums;

enum OutType: string {
    case DoubleExact = 'double_exact';
    case Exact = 'exact';
    case Any = 'any';
}
