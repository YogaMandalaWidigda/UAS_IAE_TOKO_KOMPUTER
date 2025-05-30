<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    // Membuat data pengiriman baru
    public function create(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);

        $shipment = Shipment::create([
            'order_id' => $validated['order_id'],
            'address' => $validated['address'],
            'status' => 'pending',
        ]);

        return response()->json($shipment, 201);
    }

    // Mendapatkan data pengiriman berdasarkan ID
    public function show($id)
    {
        $shipment = Shipment::find($id);

        if (!$shipment) {
            return response()->json(['error' => 'Shipment not found'], 404);
        }

        return response()->json($shipment);
    }

    // Mengupdate status pengiriman
    public function updateStatus(Request $request, $id)
    {
        $shipment = Shipment::find($id);

        if (!$shipment) {
            return response()->json(['error' => 'Shipment not found'], 404);
        }

        $validated = $request->validate([
            'status' => 'required|string|in:pending,shipped,delivered,cancelled',
        ]);

        $shipment->status = $validated['status'];
        $shipment->save();

        return response()->json($shipment);
    }
}
