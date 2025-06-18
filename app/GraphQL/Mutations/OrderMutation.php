<?php

namespace App\GraphQL\Mutations;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class OrderMutation
{
    public function store($_, array $args)
    {
        $input = $args['input'];

        $user = Customer::find($input['customer_id']);
        $product = Product::find($input['product_id']);

        if (!$user || !$product) {
            throw new \Exception('User atau produk tidak ditemukan');
        }

        if ($product->stock < $input['quantity']) {
            throw new \Exception('Stok produk tidak mencukupi');
        }

        $payment = Payment::where('payment_methods', $input['payment_methods'])->first();
        if (!$payment) {
            throw new \Exception('Metode pembayaran tidak ditemukan');
        }

        $shipment = Shipment::where('status', $input['status'])->first();
        if (!$shipment) {
            throw new \Exception('Status pembayaran tidak ditemukan');
        }
        DB::beginTransaction();

        try {
            $product->stock -= $input['quantity'];
            $product->save();

            $total = $product->price * $input['quantity'];

            $orderData = [
                'customer_id'     => $input['customer_id'],
                'product_id'      => $input['product_id'],
                'quantity'        => $input['quantity'],
                'customer_name'   => $user->customer_name,
                'product_name'    => $product->product_name,
                'price'           => $product->price,
                'total_price'     => $total,
                'payment_id'      => $payment->id,
                'payment_methods' => $payment->payment_methods,
                'shipment_id'      => $shipment->shipment_id,
                'status'          => $shipment->status, 
            ];

            // Add shipment_id if provided
            if ($shipment) {
                $orderData['shipment_id'] = $shipment->shipment_id;
            }

            $order = Order::create($orderData);

            DB::commit();
            return $order;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Gagal menyimpan data order: ' . $e->getMessage());
        }
    }

    public function update($_, array $args)
    {
        $input = $args['input'];
        $order = Order::find($args['id']);

        if (!$order) {
            throw new \Exception('Order tidak ditemukan');
        }

        $user = Customer::find($input['customer_id']);
        $product = Product::find($input['product_id']);

        if (!$user || !$product) {
            throw new \Exception('User atau produk tidak ditemukan');
        }

        $total = $product->price * $input['quantity'];

        $updateData = [
            'customer_id'   => $input['customer_id'],
            'product_id'    => $input['product_id'],
            'quantity'      => $input['quantity'],
            'customer_name' => $user->customer_name,
            'product_name'  => $product->product_name,
            'price'         => $product->price,
            'total_price'   => $total
        ];

        // Handle payment update
        if (isset($input['payment_methods'])) {
            $payment = Payment::where('payment_methods', $input['payment_methods'])->first();
            if (!$payment) {
                throw new \Exception('Metode pembayaran tidak ditemukan');
            }
            $updateData['payment_id'] = $payment->id;
            $updateData['payment_methods'] = $payment->payment_methods;
        }

        // Handle status update
        if (isset($input['status'])) {
              $shipment = Shipment::where('status', $input['status'])->first();
            if (!$shipment) {
                throw new \Exception('Status tidak ditemukan');
            }
            $updateData['shipment_id'] = $shipment->shipment_id;// Use shipment_id if provided
            $updateData['status'] = $shipment->status; // Default to 'pending' if not provided
        }

        $order->update($updateData);

        return $order;
    }
}