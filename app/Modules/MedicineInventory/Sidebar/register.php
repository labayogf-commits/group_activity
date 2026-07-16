<?php

use App\Helpers\SidebarHelper;

SidebarHelper::registerTab(
    'MedicineInventory',
    'Medicine Inventory',
    'medicine.index',
    'medicine-icon'
);

SidebarHelper::registerTab(
    'MedicineInventory',
    'Add Medicine',
    'medicine.create',
    'medicine-icon'
);
