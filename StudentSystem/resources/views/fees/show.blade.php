@extends('layouts.app')
@section('title', 'Fee Details — Admin')

@section('content')
<div style="max-width:700px; margin:0 auto;">
    <div class="d-flex justify-between items-center mb-4">
        <h1 style="font-size:24px; font-weight:700;">Fee Details</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.fees.bill', $fee->id) }}" class="btn btn-secondary">🧾 Bill</a>
            <a href="{{ route('admin.fees.edit', $fee->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary btn-sm">← Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header"><h4>Student Information</h4></div>
        <div class="card-body">
            <div class="row">
                <div>
                    <p style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Name</p>
                    <p style="font-weight:600;">{{ $fee->student->name ?? '—' }}</p>
                </div>
                <div>
                    <p style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Course</p>
                    <p>{{ $fee->student->course ?? '—' }}</p>
                </div>
            </div>
            <div class="row" style="margin-top:16px;">
                <div>
                    <p style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Semester</p>
                    <p>{{ $fee->student->semester ?? '—' }}</p>
                </div>
                <div>
                    <p style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Batch</p>
                    <p>{{ $fee->student->batch ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Fee Breakdown</h4>
            @if($fee->status === 'Paid')
                <span class="badge" style="background:#f0fdf4; color:#16a34a;">Paid</span>
            @elseif($fee->status === 'Partial')
                <span class="badge badge-amber">Partial</span>
            @else
                <span class="badge" style="background:#fef2f2; color:#dc2626;">Unpaid</span>
            @endif
        </div>
        <div class="card-body">
            <div style="margin-bottom:16px;">
                <p style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Description</p>
                <p style="font-weight:500;">{{ $fee->description }}</p>
            </div>
            <div class="row-3">
                <div style="background:#f9fafb; padding:16px; border-radius:10px; text-align:center;">
                    <p style="font-size:12px; color:#9ca3af; margin-bottom:4px;">Total Fee</p>
                    <p style="font-size:20px; font-weight:700; color:#1a1a2e;">Rs. {{ number_format($fee->total_fee, 2) }}</p>
                </div>
                <div style="background:#f0fdf4; padding:16px; border-radius:10px; text-align:center;">
                    <p style="font-size:12px; color:#9ca3af; margin-bottom:4px;">Fee Paid</p>
                    <p style="font-size:20px; font-weight:700; color:#16a34a;">Rs. {{ number_format($fee->fee_paid, 2) }}</p>
                </div>
                <div style="background:#fef2f2; padding:16px; border-radius:10px; text-align:center;">
                    <p style="font-size:12px; color:#9ca3af; margin-bottom:4px;">Remaining</p>
                    <p style="font-size:20px; font-weight:700; color:#dc2626;">Rs. {{ number_format($fee->fee_remaining, 2) }}</p>
                </div>
            </div>
            @if($fee->due_date)
            <div style="margin-top:16px;">
                <p style="font-size:13px; color:#9ca3af; margin-bottom:4px;">Due Date</p>
                <p style="font-weight:500;">{{ $fee->due_date->format('F d, Y') }}</p>
            </div>
            @endif
            <div style="margin-top:16px; font-size:12px; color:#9ca3af;">
                Created: {{ $fee->created_at->format('M d, Y h:i A') }}
            </div>
        </div>
    </div>
</div>
@endsection
