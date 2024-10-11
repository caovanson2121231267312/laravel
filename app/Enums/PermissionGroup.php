<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PermissionGroup extends Enum implements LocalizedEnum
{
    const ADMIN_PAGE = 0; // TRANG CHỦ
    const USER_MANAGEMENT = 1; // QUẢN LÝ NGƯỜI DÙNG
    const REPORT = 2; // BÁO CÁO
}
