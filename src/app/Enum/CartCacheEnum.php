<?php

namespace App\Enum;

enum CartCacheEnum: string
{
    case AUTH_USER_CART = "stats_cart_auth";
    case GUEST_USER_CART = "stats_cart_guest";
}
