<?php

namespace App\Enums;

enum LivewireEvent: string
{
    // modal events
    CASE MODAL_CLOSE = 'modal-close';
    CASE MODAL_OPEN = 'modal-open';
    CASE MODAL_CLEAR = 'modal-clear';

    // bookings
    CASE REFRESH_BOOKINGS = 'refresh-bookings';

    // dogs
    CASE REFRESH_DOGS = 'refresh-dogs';
}
