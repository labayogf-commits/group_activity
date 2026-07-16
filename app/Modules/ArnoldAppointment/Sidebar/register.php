<?php

use App\Helpers\SidebarHelper;
SidebarHelper::registerTab(
    'ArnoldAppointment',
    'Appointments',
    'arnold.appointments.index',
    'calendar-icon'
);

SidebarHelper::registerTab(
    'ArnoldAppointment',
    'Schedule Interview',
    'arnold.appointments.create',
    'calendar-plus-icon'
);
