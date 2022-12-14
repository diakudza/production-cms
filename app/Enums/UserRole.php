<?php

namespace App\Enums;

enum UserRole : string {
    case USER = 'Пользователь';
    case ADMIN = 'Администратор';
    case GUEST = 'Гость';
    case SERVICE = 'Сервис';
}
