<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserStatus extends Enum implements LocalizedEnum
{
    const ACTIVE = 1; // Đang hoạt động
    const ACCOUNT_LOCKED = 0; // Đã khóa tài khoản
}
