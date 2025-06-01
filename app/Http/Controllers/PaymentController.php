<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_methods' => 'required|string|max:255',
        ]);

        $payment = Payment::create([
            'payment_methods' => $request->payment_methods,
        ]);

        return response()->json([
            'message' => 'Payment method created successfully.',
            'data' => $payment,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment method not found.'], 404);
        }

        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment method not found.'], 404);
        }

        $request->validate([
            'payment_methods' => 'required|string|max:255',
        ]);

        $payment->update([
            'payment_methods' => $request->payment_methods,
        ]);

        return response()->json([
            'message' => 'Payment method updated successfully.',
            'data' => $payment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment method not found.'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment method deleted successfully.']);
    }
}
