@extends('layouts.app')
@section('title', 'My Fees')

@section('content')
<div>
    <div class="d-flex justify-between items-center mb-4">
        <div>
            <h1 style="font-size:24px; font-weight:700; margin-bottom:4px;">My Fees</h1>
            <p style="font-size:13px; color:#9ca3af;">{{ $fees->count() }} fee records</p>
        </div>
    </div>

    @if($fees->count() > 0)
        {{-- Summary Cards --}}
        @php
            $totalFees = $fees->sum('total_fee');
            $totalPaid = $fees->sum('fee_paid');
            $totalRemaining = $totalFees - $totalPaid;
        @endphp
        <div class="row-3 mb-4">
            <div class="card" style="text-align:center;">
                <div class="card-body">
                    <p style="font-size:12px; color:#9ca3af; margin-bottom:4px;">Total Fees</p>
                    <p style="font-size:22px; font-weight:700; color:#1a1a2e;">Rs. {{ number_format($totalFees, 2) }}</p>
                </div>
            </div>
            <div class="card" style="text-align:center;">
                <div class="card-body">
                    <p style="font-size:12px; color:#9ca3af; margin-bottom:4px;">Total Paid</p>
                    <p style="font-size:22px; font-weight:700; color:#16a34a;">Rs. {{ number_format($totalPaid, 2) }}</p>
                </div>
            </div>
            <div class="card" style="text-align:center;">
                <div class="card-body">
                    <p style="font-size:12px; color:#9ca3af; margin-bottom:4px;">Remaining</p>
                    <p style="font-size:22px; font-weight:700; color:#dc2626;">Rs. {{ number_format($totalRemaining, 2) }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Total Fee</th>
                        <th>Paid</th>
                        <th>Remaining</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fees as $fee)
                        <tr>
                            <td style="color:#9ca3af;">{{ $loop->iteration }}</td>
                            <td style="font-weight:500;">{{ $fee->description }}</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:40px; color:#9ca3af;">
                                No fee records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
