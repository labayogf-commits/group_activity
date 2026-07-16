<?php

use App\Helpers\SidebarHelper;

SidebarHelper::registerTab(
    'AllenJobPosting',    // The exact folder name (case-sensitive)
    'Job Posting',        // The name that will show in the sidebar
    '/jobs',              // The URL route
    'job-icon'            // Icon name
);