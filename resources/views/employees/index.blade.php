<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Employees List</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add New Employee</a>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Image</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->age }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>${{ number_format($employee->salary, 2) }}</td>
                    <td>
                        @if($employee->image)
                            @if(filter_var($employee->image, FILTER_VALIDATE_URL))
                                <!-- External URL image -->
                                <img src="{{ $employee->image }}" 
                                     width="50" 
                                     height="50" 
                                     class="rounded-circle border"
                                     alt="{{ $employee->name }}"
                                     title="{{ $employee->name }}">
                            @else
                                <!-- Local stored image -->
                                <img src="{{ asset('storage/' . $employee->image) }}" 
                                     width="50" 
                                     height="50" 
                                     class="rounded-circle border"
                                     alt="{{ $employee->name }}"
                                     title="{{ $employee->name }}"
                                     onerror="this.onerror=null; this.src='https://via.placeholder.com/50?text=No+Image';">
                            @endif
                        @else
                            <!-- No image available -->
                            <img src="https://via.placeholder.com/50?text=No+Image" 
                                 width="50" 
                                 height="50" 
                                 class="rounded-circle border"
                                 alt="No Image"
                                 title="No Image Available">
                        @endif
                    </td>
                    <td>
                        @if($employee->file)
                            @if(filter_var($employee->file, FILTER_VALIDATE_URL))
                                <!-- External URL file -->
                                <a href="{{ $employee->file }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    📖 View File
                                </a>
                            @else
                                <!-- Local stored file -->
                                <a href="{{ asset('storage/' . $employee->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    📖 View File
                                </a>
                            @endif
                        @else
                            <span class="text-muted">No File</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <!-- Removed the View button -->
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <style>
        .table img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 2px solid #dee2e6;
        }
        .btn-group .btn {
            margin-right: 5px;
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-group form {
            display: inline-block;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
    
    <script>
        // Auto-hide success message after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alert = document.querySelector('.alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        });
    </script>
</body>
</html>