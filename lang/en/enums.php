<?php declare(strict_types=1);

use App\Enums\UserType;
use App\Enums\PermissionGroup;
use App\Enums\UserStatus;

return [
    PermissionGroup::class => [
        // PermissionGroup::OptionOne => 'Administrator',
    ],

    UserStatus::class => [
        UserStatus::ACTIVE => 'Active',
        UserStatus::ACCOUNT_LOCKED => 'Account locked',
    ]

];
