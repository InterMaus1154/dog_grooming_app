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
    CASE DELETE_BOOKING = 'delete-booking';
    CASE DELETE_BOOKING_ON_LIST = 'delete-booking-on-list';

    // dogs
    CASE REFRESH_DOGS = 'refresh-dogs';

    // customer
    CASE CUSTOMER_DELETE = 'customer-delete';
    CASE REFRESH_CUSTOMERS = 'refresh-customers';

    // dog breed
    CASE BREED_DELETE = 'breed-delete';
    CASE REFRESH_BREEDS = 'refresh-breeds';
}
