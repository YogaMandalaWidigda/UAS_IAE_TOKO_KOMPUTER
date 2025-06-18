<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;
use App\Models\ShipmentType;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['payment', 'shipment'])->get();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = Order::with(['payment', 'shipment'])->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        return response()->json($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'     => 'required|integer',
            'product_id'      => 'required|integer',
            'quantity'        => 'required|integer|min:1',
            'payment_methods' => 'required|string',
            'shipment_types'  => 'required|integer',
        ]);

        $user     = Customer::find($request->customer_id);
        $product  = Product::find($request->product_id);
        $shipment = ShipmentType::on('shipment')->find($request->shipment_types);

        if (!$user || !$product || !$shipment) {
            return response()->json(['error' => 'Data user, produk, atau shipment tidak ditemukan'], 404);
        }

        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Stok produk tidak mencukupi'], 400);
        }

        $payment = Payment::where('payment_methods', $request->payment_methods)->first();
        if (!$payment) {
            return response()->json(['error' => 'Metode pembayaran tidak ditemukan di database'], 404);
        }

        DB::beginTransaction();

        try {
            $product->stock -= $request->quantity;
            $product->save();

            $total = $product->price * $request->quantity;

            $order = Order::create([
                'customer_id'         => $request->customer_id,
                'product_id'          => $request->product_id,
                'quantity'            => $request->quantity,
                'customer_name'       => $user->customer_name,
                'product_name'        => $product->product_name,
                'price'               => $product->price,
                'total_price'         => $total,
                'payment_id'          => $payment->id,
                'payment_methods'     => $payment->payment_methods,
                'shipment_types'      => $shipment->shipment_types,
                'name_shipment_type'  => $shipment->name_shipment_type,
            ]);

            DB::commit();

            $order->load(['payment', 'shipment']);

            return response()->json(['order' => $order], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error'   => 'Gagal menyimpan data order',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order berhasil dihapus']);
    }

    public function getByCustomerId($customer_id)
    {
        $orders = Order::with(['payment', 'shipment'])->where('customer_id', $customer_id)->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'Tidak ada order untuk customer ini']);
        }

        return response()->json($orders);
    }
}
