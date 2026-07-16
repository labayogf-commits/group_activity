<?php

use App\Helpers\SidebarHelper;

SidebarHelper::registerTab(
    'MedicineInventory',
    'Medicine Inventory',
    route('medicine.index'),
    'medicine-icon'
);

SidebarHelper::registerTab(
    'MedicineInventory',
    'Add Medicine',
    route('medicine.create'),
    'medicine-icon'
);
