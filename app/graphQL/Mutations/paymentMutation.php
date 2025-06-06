<?php

namespace App\GraphQL\Mutations;

use App\Models\Payment;
use Illuminate\Support\Facades\Validator;

class PaymentMutation
{
    // Buat payment baru
    public function create($_, array $args): Payment
    {
        $validator = Validator::make($args, [
            'payment_methods' => 'required|string|max:255',
        ]);

        $validator->validate();

        return Payment::create([
            'payment_methods' => $args['payment_methods'],
        ]);
    }

    // Update payment
    public function update($_, array $args): ?Payment
    {
        $payment = Payment::find($args['id']);
        if (!$payment) {
            throw new \Exception('Payment method not found.');
        }

        $validator = Validator::make($args, [
            'payment_methods' => 'required|string|max:255',
        ]);

        $validator->validate();

        $payment->update([
            'payment_methods' => $args['payment_methods'],
        ]);

        return $payment;
    }

    // Hapus payment
    public function delete($_, array $args): string
    {
        $payment = Payment::find($args['id']);
        if (!$payment) {
            throw new \Exception('Payment method not found.');
        }

        $payment->delete();

        return "Payment method deleted successfully.";
    }
}
