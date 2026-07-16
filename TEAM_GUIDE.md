# 🚀 Group Activity - Modular Architecture Guide

Welcome to the new Modular Architecture for our Laravel Project! This guide will explain how the new structure works, why it's better for teamwork, and how you can add your own features without causing merge conflicts.

---

## 🎯 Why Did We Change the Structure?

When working as a team in standard Laravel, everyone edits the same files (`routes/web.php`, `sidebar.blade.php`, etc.). This causes **Merge Conflicts** when uploading to GitHub. 

To solve this, we implemented a **Modular Architecture**. Now, every team member gets their own folder (their own "kahon") inside the `app/Modules/` directory. You only code inside your module, and the system automatically loads your routes, views, and sidebar menus!

---

## 📁 The New Folder Structure

Here is how the project looks now:

```text
laravel-project/
├── app/
│   ├── Helpers/
│   │   └── SidebarHelper.php          # ⚙️ Helper class to collect all sidebar tabs
│   │
│   ├── Modules/                       # 🏠 THE TEAM WORKSPACE
│   │   │
│   │   ├── HotelManagement/           # 🏨 ALLYSSA'S MODULE
│   │   │   ├── Controllers/
│   │   │   │   └── RoomController.php # Controllers go here
│   │   │   ├── Routes/
│   │   │   │   └── web.php            # Allyssa's routes only
│   │   │   ├── Sidebar/
│   │   │   │   └── register.php       # Registers Allyssa's tab to the global sidebar
│   │   │   └── Views/
│   │   │       ├── index.blade.php    # Blade files specific to Hotel
│   │   │       └── rooms.blade.php
│   │   │
│   │   └── MedicineInventory/         # 💊 RACHEL'S MODULE
│   │       ├── ... (Same structure as above)
│   │
│   └── Providers/
│       └── ModuleServiceProvider.php  # 🧠 "The Engine": Auto-loads everything inside Modules/
│
├── bootstrap/
│   └── providers.php                  # ModuleServiceProvider is registered here (Laravel 11)
│
└── resources/
    └── views/
        └── layouts/
            ├── app.blade.php          # Main layout updated to include the sidebar
            └── sidebar.blade.php      # Dynamically renders tabs from SidebarHelper
```

---

## 🛠️ How to Add a New Module (For Other Members)

If you are a new member (e.g., Rendell doing the "Blog System"), follow these simple steps to set up your workspace:

### Step 1: Create Your Module Folder
Create a new folder inside `app/Modules/` for your feature.
Example: `app/Modules/BlogSystem/`

Inside it, create these 4 folders:
- `Controllers/`
- `Routes/`
- `Sidebar/`
- `Views/`

### Step 2: Create Your Routes
Create `web.php` inside your `Routes/` folder (`app/Modules/BlogSystem/Routes/web.php`).
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Modules\BlogSystem\Controllers\BlogController;

// Always give your route a unique prefix and name!
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
```

### Step 3: Create Your Controller
Create your controller inside `Controllers/` (`app/Modules/BlogSystem/Controllers/BlogController.php`).
```php
<?php

namespace App\Modules\BlogSystem\Controllers;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        // Notice the double colon '::'. This tells Laravel to look in YOUR module's Views folder!
        return view('BlogSystem::index'); 
    }
}
```

### Step 4: Create Your View
Create your blade file inside `Views/` (`app/Modules/BlogSystem/Views/index.blade.php`).
```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog System Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                Welcome to Rendell's Blog System!
            </div>
        </div>
    </div>
</x-app-layout>
```

### Step 5: Register Your Menu to the Global Sidebar
Create `register.php` inside your `Sidebar/` folder (`app/Modules/BlogSystem/Sidebar/register.php`).
```php
<?php

use App\Helpers\SidebarHelper;

SidebarHelper::registerTab(
    'BlogSystem',             // Module Name
    'Blog Management',        // The text that will appear on the sidebar
    'blog.index',             // Your route name
    'bi-pencil-square'        // (Optional) Icon class
);
```

### 🎉 You're Done!
Refresh your browser. Your route will automatically work, your view will load, and your tab will magically appear on the left sidebar in the Dashboard! 

---

## ⚠️ Important Rules for the Team
1. **Never edit `resources/views/layouts/sidebar.blade.php` manually.** If you want a new link, use your module's `Sidebar/register.php`.
2. **Never edit the main `routes/web.php` for your personal features.** Only put your routes inside your own `Modules/YourFeature/Routes/web.php`.
3. **Keep your namespaces correct.** Your controllers must start with `namespace App\Modules\YourModuleName\Controllers;`.
4. **Returning Views:** When returning a view from your module controller, always use the syntax: `view('YourModuleName::blade-file-name')`.

Happy Coding! 💻
