<?php

namespace App\Http\Enum;

use Illuminate\Validation\Rules\Enum as RulesEnum;
use MadWeb\Enum\Enum;

/**
 * @method static UserStatus Active()
 * @method static UserStatus Pending()
 */

final class ServiceTypeEnum extends RulesEnum
{
    // Sebagai Defaultnya ketika anda membuat record maka akan menggunakan `Active`
    const __default = self::R_Ride;

    const R_Ride = 'R-Ride';
    const R_Shop = 'R-Shop';

    const R_Pickup = 'R-Pickup';
}
