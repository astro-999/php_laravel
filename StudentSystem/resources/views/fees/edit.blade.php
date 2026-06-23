@extends('layouts.app')
@section('title', 'Edit Fee Record — Admin')

@section('content')
<div style="max-width:700px; margin:0 auto;">
    <h1 style="font-size:24px; font-weight:700; margin-bottom:24px;">Edit Fee Record</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.fees.update', $fee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Student *</label>
                    <select name="student_id" class="form-input @error('student_id') is-invalid @enderror">
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $fee->student_id) == $student->id ? 'selected' : '' }}>{{ $student->name }} ({{ $student->course ?? 'N/A' }})</option>
                        @endforeach
                    </select>
                    @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <input type="text" name="description" class="form-input @error('description') is-invalid @enderror" value="{{ old('description', $fee->description) }}" placeholder="e.g. Tuition Fee - Semester 3">
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="form-label">Total Fee (Rs.) *</label>
                        <input type="number" step="0.01" min="0" name="total_fee" id="totalFee" class="form-input @error('total_fee') is-invalid @enderror" value="{{ old('total_fee', $fee->total_fee) }}" placeholder="0.00" oninput="calcRemaining()">
                        @error('total_fee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fee Paid (Rs.) *</label>
                        <input type="number" step="0.01" min="0" name="fee_paid" id="feePaid" class="form-input @error('fee_paid') is-invalid @enderror" value="{{ old('fee_paid', $fee->fee_paid) }}" placeholder="0.00" oninput="calcRemaining()">
                        @error('fee_paid') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class="form-label">Fee Remaining (Rs.)</label>
                        <input type="text" id="feeRemaining" class="form-input" value="{{ number_format($fee->fee_remaining, 2) }}" readonly style="background:#f9fafb; color:#6b7280;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-input @error('due_date') is-invalid @enderror" value="{{ old('due_date', $fee->due_date ? $fee->due_date->format('Y-m-d') : '') }}">
                        @error('due_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex gap-3" style="margin-top:8px;">
                    <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary">← Back</a>
                    <button type="submit" class="btn btn-primary">Update Fee Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function calcRemaining() {
    const total = parseFloat(document.getElementById('totalFee').value) || 0;
    const paid = parseFloat(document.getElementById('feePaid').value) || 0;
    const remaining = Math.max(0, total - paid);
    document.getElementById('feeRemaining').value = remaining.toFixed(2);
}
document.addEventListener('DOMContentLoaded', calcRemaining);
</script>
@endsection
