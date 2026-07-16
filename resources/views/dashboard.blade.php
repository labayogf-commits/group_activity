<x-app-layout>
    <style>
        /* Pin the sidebar and apply the Light Theme styling */
        .group-act-sidebar {
            background-color: #ffffff; /* Clean white canvas background */
            position: fixed;
            top: 65px; /* Offset to clear the fixed top navbar */
            left: 0;
            bottom: 0;
            width: 260px;
            border-right: 1px solid #e2e8f0; /* Soft border matching default Breeze */
            z-index: 40;
            overflow-y: auto;
        }

        /* Sidebar navigational links updated for light mode text */
        .sidebar-link {
            color: #4a5568; /* Slate gray text */
            text-decoration: none;
            display: block;
            padding: 0.75rem 1.2rem;
            transition: all 0.2s;
            border-radius: 6px;
            font-weight: 500;
        }

        /* Hover and active states using a soft gray background and gold accent text */
        .sidebar-link:hover, .sidebar-link.active {
            background-color: #f7fafc; 
            color: #d97706 !important; /* Rich amber gold for clear contrast on white */
        }

        /* Light-theme styled logo element */
        .sidebar-logo {
            background: linear-gradient(135deg, #d97706, #fbbf24);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff; 
            font-weight: bold;
            font-size: 1rem;
            border-radius: 4px;
        }

        /* Fixed structural setup: keeps main viewport locked so only the inner content panel scrolls */
        @media (min-width: 768px) {
            html, body {
                overflow: hidden; /* Prevents the main page/navbar from scrolling */
            }
            .dashboard-content-wrapper {
                margin-left: 260px;
                height: calc(100vh - 65px); /* Matches viewport space exactly below navbar */
                overflow-y: auto; /* Restricts scrolling solely to the active layout content workspace */
            }
        }

        /* Responsive stack styling for smaller mobile displays */
        @media (max-width: 767.98px) {
            .group-act-sidebar {
                position: relative;
                top: 0;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <nav class="group-act-sidebar p-3 d-flex flex-column align-items-stretch">
        <div class="d-flex align-items-center gap-2 mb-4 px-2">
            <div class="sidebar-logo">G</div>
            <span class="fs-5 fw-bold text-gray-800 font-semibold">Group Act</span>
        </div>

        <div class="mb-2 px-2">
            <small class="text-uppercase tracking-wider text-gray-400 font-bold text-xs">Team Workspaces</small>
        </div>

        <div class="d-flex flex-column gap-1">
            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Rendell/Blog System
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Arnold/Appointment
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Anthony/HSM
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Christian/BarberArban

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Allen Cabagnot
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Patricia/Exp Tracker           
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Julius
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Fatrick/Announcement
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Rachelle/Travel
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Rows/Hotel
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Allaysah/Medicine
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Sayreese/To Do List
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Ahbbyy/Reservation
            </a>

            <a href="#" class="sidebar-link">
                <i class="bi bi-person-workspace me-2"></i> Romualdoz
            </a>
        </div>
    </nav>

    <div class="dashboard-content-wrapper bg-gray-100">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-2 text-gray-800">Welcome to your Group Act Dashboard!</h3>
                        <p class="text-gray-600">
                            {{ __("You're logged in!") }} Click on any team member's name in the sidebar to visit their specific section.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>