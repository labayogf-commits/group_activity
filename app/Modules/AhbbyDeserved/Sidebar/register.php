<?php

use App\Helpers\SidebarHelper;

SidebarHelper::registerTab(
    'HotelManagement',
    'Hotel Dashboard',
    'hotel.index',
    'hotel-icon'
);

SidebarHelper::registerTab(
    'HotelManagement',
    'Hotel Rooms',
    'hotel.rooms',
    'hotel-icon'
);
