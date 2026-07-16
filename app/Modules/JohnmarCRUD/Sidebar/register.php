<?php

use App\Helpers\SidebarHelper;

/*
|--------------------------------------------------------------------------
| Sidebar Registration
|--------------------------------------------------------------------------
|
| This file is responsible for registering the JohnmarCRUD module 
| into the application's dynamic sidebar navigation.
|
*/

// Register the module tab with the SidebarHelper
SidebarHelper::registerTab(
    'JohnmarCRUD',    // Module Name (identifier)
    'Johnmar-CRUD',   // Display Label (what the user sees in the sidebar)
    '/johnmar-crud',  // URL Route/Path to navigate to when clicked
    null              // Icon or additional metadata (currently null)
);
