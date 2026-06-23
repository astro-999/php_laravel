@extends('layouts.app')
@section('title', 'Admin — Fee Management')

@section('content')
    <div class="d-flex justify-between items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 style="font-size:24px; font-weight:700; margin-bottom:4px;">Fee Management</h1>
            <p style="font-size:13px; color:#9ca3af;">{{ $fees->total() }} fee records total</p>
        </div>
        <div class="d-flex gap-2 flex-wrap items-center">
            <form method="GET" action="{{ route('admin.fees.index') }}" style="display:flex; gap:8px; margin:0;">
                <input type="text" name="search" class="form-input" style="padding:6px 12px; width:200px; font-size:13px;" value="{{ request('search') }}" placeholder="Search by name or desc...">
                <select name="status" class="form-input" style="padding:6px 12px; width:130px; font-size:13px;">
                    <option value="">All Status</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Partial</option>
                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
                <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary btn-sm" style="color:#ef4444; border-color:#fca5a5;">Clear</a>
                @endif
            </form>
            <a href="{{ route('admin.fees.create') }}" class="btn btn-primary">+ Add Fee</a>
        </div>
    </div>

    <div class="card">
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Description</th>
                        <th>Total Fee</th>
                        <th>Paid</th>
                        <th>Remaining</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fees as $fee)
                        <tr>
                            <td style="color:#9ca3af;">{{ $loop->iteration }}</td>
                            <td style="font-weight:500;">{{ $fee->student->name ?? '—' }}</td>
                            <td>{{ $fee->description }}</td>
                            <td>Rs. {{ number_format($fee->total_fee, 2) }}</td>
                            <td>Rs. {{ number_format($fee->fee_paid, 2) }}</td>
                            <td style="font-weight:600;">Rs. {{ number_format($fee->fee_remaining, 2) }}</td>
                            <td>{{ $fee->due_date ? $fee->due_date->format('M d, Y') : '—' }}</td>
                            <td>
                                @if($fee->status === 'Paid')
                                    <span class="badge" style="background:#f0fdf4; color:#16a34a;">Paid</span>
                                @elseif($fee->status === 'Partial')
                                    <span class="badge badge-amber">Partial</span>
                                @else
                                    <span class="badge" style="background:#fef2f2; color:#dc2626;">Unpaid</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.fees.show', $fee->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('admin.fees.bill', $fee->id) }}" class="btn btn-secondary btn-sm" title="Print Bill">🧾 Bill</a>
                                    <a href="{{ route('admin.fees.edit', $fee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.fees.destroy', $fee->id) }}" method="POST" style="margin:0;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this fee record?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center; padding:40px; color:#9ca3af;">
                                No fee records found. Add your first fee record!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination" style="margin-top:20px; justify-content:center;">
        {{ $fees->links() }}
    </div>
@endsection
