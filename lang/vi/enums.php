<?php declare(strict_types=1);

use App\Enums\UserStatus;
use App\Enums\PermissionGroup;

return [

    PermissionGroup::class => [
        // PermissionGroup::OptionOne => 'Administrator',
    ],

    UserStatus::class => [
        UserStatus::ACTIVE => 'Đang hoạt động',
        UserStatus::ACCOUNT_LOCKED => 'Đã khóa tài khoản',
    ]

];
