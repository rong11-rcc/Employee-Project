<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Employee</h1>
        
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
            </div>
            
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="{{ $employee->age }}" min="18" max="100" required>
            </div>
            
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" required>
            </div>
            
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" step="0.01" class="form-control" id="salary" name="salary" value="{{ $employee->salary }}" required>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                @if($employee->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $employee->image) }}" width="100" height="100">
                    </div>
                @endif
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            
            <div class="mb-3">
                <label for="file" class="form-label">Document File</label>
                @if($employee->file)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $employee->file) }}" target="_blank">Current File</a>
                    </div>
                @endif
                <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx">
            </div>
            
            <button type="submit" class="btn btn-primary">Update Employee</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>