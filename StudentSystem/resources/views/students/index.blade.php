@extends('layouts.app')
@section('title', 'Admin — All Students')

@section('content')
    <div class="d-flex justify-between items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 style="font-size:24px; font-weight:700; margin-bottom:4px;">All Students</h1>
            <p style="font-size:13px; color:#9ca3af;">{{ $students->total() }} students total</p>
        </div>
        <div class="d-flex gap-2 flex-wrap items-center">
            <form method="GET" action="{{ route('admin.students.index') }}" style="display:flex; gap:8px; margin:0;">
                <input type="text" name="search" class="form-input" style="padding:6px 12px; width:220px; font-size:13px;" value="{{ request('search') }}" placeholder="Search students...">
                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                @if(request('search'))
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-sm" style="color:#ef4444; border-color:#fca5a5;">Clear</a>
                @endif
            </form>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">+ Add Student</a>
        </div>
    </div>

    <div class="card">
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Sem</th>
                        <th>Batch</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td style="color:#9ca3af;">{{ $loop->iteration }}</td>
                            <td style="font-weight:500;">{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td><span class="badge badge-indigo">{{ $student->course ?? '—' }}</span></td>
                            <td><span class="badge badge-amber">{{ $student->semester ?? '—' }}</span></td>
                            <td>{{ $student->batch ?? '—' }}</td>
                            <td>{{ $student->year ?? '—' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="margin:0;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center; padding:40px; color:#9ca3af;">
                                No students found. Add your first student!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination" style="margin-top:20px; justify-content:center;">
        {{ $students->links() }}
    </div>
@endsection
