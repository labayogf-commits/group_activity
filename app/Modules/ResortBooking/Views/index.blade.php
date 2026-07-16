{{--
    bookings/index.blade.php

    Single-page Bookings gamit ang Breeze x-app-layout.
    Add/Edit ay nasa loob ng modal (plain CSS/JS, walang Bootstrap dependency
    dahil default Breeze lang / Tailwind ang naka-load).
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bookings
        </h2>
    </x-slot>

    <div class="page-header">
        <h1>Bookings</h1>
        <button type="button" class="btn-primary-action" data-open-modal="addBookingModal">
            <i class="fa-solid fa-plus"></i> Add Booking
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->client->name }}</td>
                        <td>{{ $booking->room->room_number }} — {{ $booking->room->type }}</td>
                        <td>{{ $booking->check_in->format('M d, Y') }}</td>
                        <td>{{ $booking->check_out->format('M d, Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($booking->status) }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="icon-btn icon-btn-edit"
                                    data-open-modal="editBookingModal{{ $booking->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Sigurado ka bang burahin ang booking na ito?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn icon-btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">Wala pang booking. I-click ang "Add Booking" para magsimula.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ================= ADD BOOKING MODAL ================= --}}
    <div class="modal-overlay" id="addBookingModal">
        <div class="modal-box">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_form" value="add">
                <div class="modal-header">
                    <h5>Add Booking</h5>
                    <button type="button" class="modal-close" data-close-modal>&times;</button>
                </div>
                <div class="modal-body">
                    @if ($errors->any() && old('_form') === 'add')
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @include('bookings._modal_fields', [
                        'prefix'  => 'add_',
                        'rooms'   => $rooms,
                        'booking' => null,
                    ])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-action" data-close-modal>Cancel</button>
                    <button type="submit" class="btn-primary-action">Save Booking</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= EDIT BOOKING MODALS (isa per row) ================= --}}
    @foreach ($bookings as $booking)
        <div class="modal-overlay" id="editBookingModal{{ $booking->id }}">
            <div class="modal-box">
                <form action="{{ route('bookings.update', $booking) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_form" value="edit_{{ $booking->id }}">
                    <div class="modal-header">
                        <h5>Edit Booking</h5>
                        <button type="button" class="modal-close" data-close-modal>&times;</button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any() && old('_form') === 'edit_' . $booking->id)
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @include('bookings._modal_fields', [
                            'prefix'  => 'edit_' . $booking->id . '_',
                            'rooms'   => $rooms,
                            'booking' => $booking,
                        ])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary-action" data-close-modal>Cancel</button>
                        <button type="submit" class="btn-primary-action">Update Booking</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <style>
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .btn-primary-action {
            background-color: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 18px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-action:hover { background-color: #1d4ed8; }

        .btn-secondary-action {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
        }

        .table-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .data-table { width: 100%; border-collapse: collapse; }

        .data-table th {
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #64748b;
            padding: 14px 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table td {
            padding: 14px 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #1e293b;
        }

        .empty-state { text-align: center; color: #94a3b8; padding: 40px 0 !important; }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
        }

        .status-pending   { background-color: #f59e0b; }
        .status-confirmed { background-color: #16a34a; }
        .status-cancelled { background-color: #dc2626; }

        .icon-btn {
            border: 1px solid #e2e8f0;
            background-color: #fff;
            border-radius: 6px;
            width: 32px;
            height: 32px;
            cursor: pointer;
            margin-left: 6px;
        }

        .icon-btn-edit { color: #2563eb; }
        .icon-btn-edit:hover { background-color: #eff6ff; }

        .icon-btn-delete { color: #dc2626; border-color: #fecaca; }
        .icon-btn-delete:hover { background-color: #fef2f2; }

        .text-end { text-align: right; }
        .d-inline { display: inline; }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-success { background-color: #dcfce7; color: #166534; }
        .alert-danger { background-color: #fee2e2; color: #991b1b; }

        /* ===== Vanilla modal (walang Bootstrap dependency) ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.55);
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 16px;
        }

        .modal-overlay.is-open {
            display: flex;
        }

        .modal-box {
            background-color: #fff;
            border-radius: 12px;
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-header h5 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            color: #64748b;
        }

        .modal-body { padding: 20px; }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-select, .form-control {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .mb-3 { margin-bottom: 14px; }
        .row { display: flex; gap: 12px; }
        .col-md-6 { flex: 1; min-width: 0; }
    </style>

    <script>
        (function () {
            function openModal(id) {
                var el = document.getElementById(id);
                if (el) el.classList.add('is-open');
            }
            function closeModal(el) {
                var overlay = el.closest('.modal-overlay');
                if (overlay) overlay.classList.remove('is-open');
            }

            // Buksan ang modal
            document.querySelectorAll('[data-open-modal]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    openModal(btn.getAttribute('data-open-modal'));
                });
            });

            // Isara ang modal (X button o Cancel)
            document.querySelectorAll('[data-close-modal]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    closeModal(btn);
                });
            });

            // Isara pag na-click sa labas ng modal box
            document.querySelectorAll('.modal-overlay').forEach(function (overlay) {
                overlay.addEventListener('click', function (e) {
                    if (e.target === overlay) {
                        overlay.classList.remove('is-open');
                    }
                });
            });

            // Isara gamit ang Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal-overlay.is-open').forEach(function (overlay) {
                        overlay.classList.remove('is-open');
                    });
                }
            });

            // Kung may validation error, i-open ulit yung tamang modal
            @if ($errors->any())
                var openId = @json(
                    old('_form') === 'add'
                        ? 'addBookingModal'
                        : (old('_form') ? 'editBookingModal' . str_replace('edit_', '', old('_form')) : null)
                );
                if (openId) {
                    document.addEventListener('DOMContentLoaded', function () {
                        openModal(openId);
                    });
                }
            @endif
        })();
    </script>
</x-app-layout>