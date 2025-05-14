<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index ()
    {
        $transactions = Transaction::all();
        
        $statistics = [
            'cash' => Transaction::where('payment_method', 'cash')->count(),
            'card' => Transaction::where('payment_method', 'card')->count()
        ];

        return view('admin.transactions.index', ['transactions' => $transactions, 'statistics' => $statistics]);
    }

    public function create()
    {   
        $bookings = Booking::where('booking_status', 'paid')->get();
        return view('admin.transactions.create', ['bookings' => $bookings]);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'payment_date' => ['required', 'date'],
            'payment_method' => ['required', Rule::in(['cash', 'card'])],
        ]);

        $transactions = Transaction::where('booking_id', $validation['booking_id'])->get();

        if (!$transactions->isEmpty()) {
            throw ValidationException::withMessages([
                'booking_id' => 'The Transaction record for this booking record already exists.'
            ]);
        }

        $booking = Booking::find($validation['booking_id']);

        if ($booking->booking_status !== 'paid') {
            throw ValidationException::withMessages([
                'booking_id' => 'The Booking record must already been paid.'
            ]);
        }

        $payment_date = Carbon::createFromFormat('Y-m-d', $validation['payment_date']);
        $updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $booking->updated_at);
        $updated_at_formatted = $updated_at->format('Y-m-d');

        if ($payment_date <= $updated_at_formatted) {
            throw ValidationException::withMessages([
                'payment_date' => 'Payment date must be after the booking was last updated.'
            ]);
        }

        Transaction::create([
            'booking_id' => $validation['booking_id'],
            'payment_date' => $validation['payment_date'],
            'payment_method' => $validation['payment_method'],
            'payment_total' => $booking->service->price,
        ]);

        return redirect('/admin/transactions')->with('success', 'Transaction Record created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', ['transaction' => $transaction]);
    }

    public function edit(Transaction $transaction)
    {
        $bookings = Booking::where('booking_status', 'paid')->get();
        return view('admin.transactions.edit', ['transaction' => $transaction, 'bookings' => $bookings]);
    }

    public function update(Transaction $transaction, Request $request)
    {
        $validation = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'payment_date' => ['required', 'date'],
            'payment_method' => ['required', Rule::in(['cash', 'card'])],
        ]);

        $transactions = Transaction::where('booking_id', $validation['booking_id'])
                        ->where('id', '!=', $transaction->id)
                        ->get();

        if (!$transactions->isEmpty()) {
            throw ValidationException::withMessages([
                'booking_id' => 'The Transaction record for this booking record already exists.'
            ]);
        }

        $booking = Booking::find($validation['booking_id']);

        if ($booking->booking_status !== 'paid') {
            throw ValidationException::withMessages([
                'booking_id' => 'The Booking record must already been paid.'
            ]);
        }

        $payment_date = Carbon::createFromFormat('Y-m-d', $validation['payment_date']);
        $updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $booking->updated_at);
        $updated_at_formatted = $updated_at->format('Y-m-d');

        if ($payment_date <= $updated_at_formatted) {
            throw ValidationException::withMessages([
                'payment_date' => 'Payment date must be after the booking was last updated.'
            ]);
        }

        $transaction->update([
            'booking_id' => $validation['booking_id'],
            'payment_date' => $validation['payment_date'],
            'payment_method' => $validation['payment_method'],
            'payment_total' => $booking->service->price,
        ]);

        return redirect('/admin/transactions/' . $transaction->id)->with('success', 'Transaction Record updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect('/admin/transactions');
    }
}
