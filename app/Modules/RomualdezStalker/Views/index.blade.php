<x-app-layout>
    <!-- Fallback Styling to completely fix the squished layout -->
    <style>
        .custom-card { background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-top: 20px; }
        .custom-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-family: sans-serif; }
        .custom-btn { background-color: #2563eb; color: white; padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; font-weight: 6px; font-size: 14px; text-decoration: none; }
        .custom-btn:hover { background-color: #1d4ed8; }
        .custom-btn-danger { background-color: #dc2626; margin-left: 8px; }
        .custom-btn-danger:hover { background-color: #b91c1c; }
        .custom-btn-secondary { background-color: #4b5563; color: white; }
        .custom-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-family: sans-serif; font-size: 14px; }
        .custom-table th { background-color: #f3f4f6; color: #374151; font-weight: 600; text-align: left; padding: 12px; border-bottom: 2px solid #e5e7eb; }
        .custom-table td { padding: 12px; border-bottom: 1px solid #e5e7eb; color: #1f2937; }
        .custom-badge { background-color: #e5e7eb; color: #374151; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .action-link { background: none; border: none; color: #2563eb; cursor: pointer; font-weight: 600; padding: 0 4px; text-decoration: none; font-size: 14px; }
        .action-link.delete { color: #dc2626; }
        /* Modal Engine CSS */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999; }
        .modal-content-box { background: white; padding: 24px; border-radius: 8px; width: 100%; max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 600; font-size: 13px; color: #4b5563; }
        .form-control { width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Information System') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main Content Container Card -->
            <div class="custom-card">
                <div class="custom-header">
                    <span style="color: #6b7280; font-size: 14px;">Manage your dynamic student records below</span>
                    <button class="custom-btn" onclick="openAddModal()">Add Student</button>
                </div>

                <div style="overflow-x: auto;">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Year</th>
                                <th>Email</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td style="font-weight: bold;">{{ $student->student_id }}</td>
                                <td>{{ $student->name }}</td>
                                <td><span class="custom-badge">{{ $student->course }}</span></td>
                                <td>{{ $student->year }}</td>
                                <td>{{ $student->email }}</td>
                                <td style="text-align: center;">
                                    <button class="action-link" onclick="openEditModal({{ json_encode($student) }})">Edit</button>
                                    <form action="{{ route('stalker.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-link delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-center; padding: 40px; color: #9ca3af; text-align: center;">
                                    No student records found in the database.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- ================= ADD STUDENT MODAL ================= -->
    <div id="addModal" class="modal-overlay">
        <div class="modal-content-box">
            <h3 style="margin-top:0; margin-bottom: 20px; font-size:18px; font-weight:bold;">Add New Student</h3>
            <form action="{{ route('stalker.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="student_id" class="form-control" required placeholder="e.g. 101">
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Ma Romualdo">
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <input type="text" name="course" class="form-control" required placeholder="e.g. bscs">
                </div>
                <div class="form-group">
                    <label>Year Level</label>
                    <input type="number" name="year" class="form-control" required placeholder="e.g. 3">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="name@email.com">
                </div>
                <div style="text-align: right; margin-top: 24px;">
                    <button type="button" class="custom-btn custom-btn-secondary" onclick="closeAddModal()">Cancel</button>
                    <button type="submit" class="custom-btn">Save Student</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= EDIT STUDENT MODAL ================= -->
    <div id="editModal" class="modal-overlay">
        <div class="modal-content-box">
            <h3 style="margin-top:0; margin-bottom: 20px; font-size:18px; font-weight:bold;">Edit Student Record</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" id="edit_student_id" name="student_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="edit_name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <input type="text" id="edit_course" name="course" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Year Level</label>
                    <input type="number" id="edit_year" name="year" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="edit_email" name="email" class="form-control" required>
                </div>
                <div style="text-align: right; margin-top: 24px;">
                    <button type="button" class="custom-btn custom-btn-secondary" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="custom-btn">Update Details</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal JavaScript Interactions -->
    <script>
        function openAddModal() { document.getElementById('addModal').style.display = 'flex'; }
        function closeAddModal() { document.getElementById('addModal').style.display = 'none'; }
        
        function openEditModal(student) {
            document.getElementById('edit_student_id').value = student.student_id;
            document.getElementById('edit_name').value = student.name;
            document.getElementById('edit_course').value = student.course;
            document.getElementById('edit_year').value = student.year;
            document.getElementById('edit_email').value = student.email;
            
            // Set dynamic form route action url target cleanly
            document.getElementById('editForm').action = "/stalker/" + student.id;
            document.getElementById('editModal').style.display = 'flex';
        }
        function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }
    </script>
</x-app-layout>
