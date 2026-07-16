<?php

use App\Helpers\SidebarHelper;

SidebarHelper::registerTab(
    'ChristianPagupitan',
    'Barber Shop Dashboard',
    'barber.index', // Points perfectly to the route defined in Step 3
    'bi-scissors'
);