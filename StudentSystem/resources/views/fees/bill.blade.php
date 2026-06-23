<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Bill — {{ $fee->student->name ?? 'Student' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; color: #1a1a2e; padding: 20px; }
        .bill-container { max-width: 700px; margin: 0 auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 40px; }
        .bill-header { text-align: center; border-bottom: 2px solid #4f46e5; padding-bottom: 20px; margin-bottom: 24px; }
        .bill-header h1 { font-size: 22px; font-weight: 700; color: #4f46e5; }
        .bill-header p { font-size: 13px; color: #9ca3af; margin-top: 4px; }
        .bill-section { margin-bottom: 24px; }
        .bill-section h3 { font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; margin-bottom: 10px; }
        .bill-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; }
        .bill-row .label { color: #6b7280; }
        .bill-row .value { font-weight: 500; }
        .bill-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .bill-table th { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; padding: 10px 14px; text-align: left; border-bottom: 1px solid #e5e7eb; background: #f9fafb; }
        .bill-table td { padding: 12px 14px; font-size: 14px; border-bottom: 1px solid #f3f4f6; }
        .bill-total { background: #f9fafb; border-radius: 10px; padding: 16px 20px; margin-top: 20px; }
        .bill-total .row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 14px; }
        .bill-total .row.final { font-size: 18px; font-weight: 700; color: #4f46e5; border-top: 1px solid #e5e7eb; padding-top: 12px; margin-top: 8px; }
        .bill-footer { text-align: center; margin-top: 32px; padding-top: 16px; border-top: 1px solid #e5e7eb; font-size: 12px; color: #9ca3af; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 6px; font-size: 12px; font-weight: 500; }
        .print-btn { display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; background: #4f46e5; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: 'Inter', sans-serif; margin-bottom: 20px; }
        .print-btn:hover { background: #4338ca; }
        .print-area { text-align: center; }
        @media print {
            body { background: #fff; padding: 0; }
            .print-area { display: none; }
            .bill-container { border: none; box-shadow: none; padding: 20px; }
        }
    </style>
</head>
<body>
    <div style="max-width:700px; margin:0 auto;">
        <div class="print-area">
            <button class="print-btn" onclick="window.print()">🖨️ Print Bill</button>
            <a href="{{ route('admin.fees.show', $fee->id) }}" style="font-size:14px; color:#6b7280; margin-left:12px;">← Back to Details</a>
        </div>

        <div class="bill-container">
            <div class="bill-header">
                <h1>🎓 Student System</h1>
                <p>Fee Payment Receipt</p>
            </div>

            <div class="bill-section">
                <h3>Student Details</h3>
                <div class="bill-row">
                    <span class="label">Name</span>
                    <span class="value">{{ $fee->student->name ?? '—' }}</span>
                </div>
                <div class="bill-row">
                    <span class="label">Course</span>
                    <span class="value">{{ $fee->student->course ?? '—' }}</span>
                </div>
                <div class="bill-row">
                    <span class="label">Semester / Batch</span>
                    <span class="value">{{ $fee->student->semester ?? '—' }} / {{ $fee->student->batch ?? '—' }}</span>
                </div>
            </div>

            <div class="bill-section">
                <h3>Fee Details</h3>
                <table class="bill-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th style="text-align:right;">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $fee->description }}</td>
                            <td style="text-align:right;">{{ number_format($fee->total_fee, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bill-total">
                <div class="row">
                    <span>Total Fee</span>
                    <span>Rs. {{ number_format($fee->total_fee, 2) }}</span>
                </div>
                <div class="row">
                    <span>Amount Paid</span>
                    <span style="color:#16a34a;">Rs. {{ number_format($fee->fee_paid, 2) }}</span>
                </div>
                <div class="row final">
                    <span>Balance Remaining</span>
                    <span>Rs. {{ number_format($fee->fee_remaining, 2) }}</span>
                </div>
            </div>

            <div style="margin-top:20px; display:flex; justify-content:space-between; font-size:13px; color:#6b7280;">
                <span>Status:
                    @if($fee->status === 'Paid')
                        <span class="badge" style="background:#f0fdf4; color:#16a34a;">Paid</span>
                    @elseif($fee->status === 'Partial')
                        <span class="badge" style="background:#fffbeb; color:#d97706;">Partial</span>
                    @else
                        <span class="badge" style="background:#fef2f2; color:#dc2626;">Unpaid</span>
                    @endif
                </span>
                @if($fee->due_date)
                    <span>Due: {{ $fee->due_date->format('M d, Y') }}</span>
                @endif
            </div>

            <div class="bill-footer">
                <p>Generated on {{ now()->format('F d, Y \a\t h:i A') }}</p>
                <p style="margin-top:4px;">Thank you for your payment.</p>
            </div>
        </div>
    </div>
</body>
</html>
