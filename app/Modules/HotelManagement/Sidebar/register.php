<?php

use App\Helpers\SidebarHelper;

SidebarHelper::registerTab(
    'HotelManagement',
    'Hotel Dashboard',
    route('hotel.index'),
    'hotel-icon'
);

SidebarHelper::registerTab(
    'HotelManagement',
    'Hotel Rooms',
    route('hotel.rooms'),
    'hotel-icon'
);
