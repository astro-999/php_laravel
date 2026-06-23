<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * List all fee records with search/filter.
     */
    public function index(Request $request)
    {
        $query = Fee::with('student');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhereHas('student', function ($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('status') && $request->status != '') {
            $status = $request->status;
            if ($status === 'paid') {
                $query->whereColumn('fee_paid', '>=', 'total_fee');
            } elseif ($status === 'partial') {
                $query->where('fee_paid', '>', 0)->whereColumn('fee_paid', '<', 'total_fee');
            } elseif ($status === 'unpaid') {
                $query->where('fee_paid', '<=', 0);
            }
        }

        $fees = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
        return view('fees.index', compact('fees'));
    }

    /**
     * Show form to add a new fee record.
     */
    public function create()
    {
        $students = Student::orderBy('name')->get();
        return view('fees.create', compact('students'));
    }

    /**
     * Save a new fee record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'description' => 'required|string|max:255',
            'total_fee' => 'required|numeric|min:0',
            'fee_paid' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        // Ensure fee_paid doesn't exceed total_fee
        if ($request->fee_paid > $request->total_fee) {
            return back()->withErrors(['fee_paid' => 'Fee paid cannot exceed total fee.'])->withInput();
        }

        Fee::create($request->all());

        return redirect()->route('admin.fees.index')
            ->with('success', 'Fee record created successfully.');
    }

    /**
     * Show a single fee record.
     */
    public function show(Fee $fee)
    {
        $fee->load('student');
        return view('fees.show', compact('fee'));
    }

    /**
     * Show edit form.
     */
    public function edit(Fee $fee)
    {
        $students = Student::orderBy('name')->get();
        return view('fees.edit', compact('fee', 'students'));
    }

    /**
     * Update a fee record.
     */
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'description' => 'required|string|max:255',
            'total_fee' => 'required|numeric|min:0',
            'fee_paid' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        if ($request->fee_paid > $request->total_fee) {
            return back()->withErrors(['fee_paid' => 'Fee paid cannot exceed total fee.'])->withInput();
        }

        $fee->update($request->all());

        return redirect()->route('admin.fees.index')
            ->with('success', 'Fee record updated successfully.');
    }

    /**
     * Delete a fee record.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()->route('admin.fees.index')
            ->with('success', 'Fee record deleted successfully.');
    }

    /**
     * Printable bill view.
     */
    public function bill(Fee $fee)
    {
        $fee->load('student');
        return view('fees.bill', compact('fee'));
    }
}
