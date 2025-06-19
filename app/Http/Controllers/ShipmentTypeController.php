<?php

namespace App\Http\Controllers;

use App\Models\ShipmentType;
use Illuminate\Http\Request;

class ShipmentTypeController extends Controller
{
    // Menampilkan semua jenis pengiriman
    public function index()
    {
        $shipmenttypes = ShipmentType::all();
        return response()->json($shipmenttypes);
    }

    // Menambahkan jenis pengiriman baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_shipment_type' => 'required|string|max:255',
        ]);

        $shipmentType = ShipmentType::create([
            'name_shipment_type' => $validated['name_shipment_type'],
        ]);

        return response()->json($shipmentType, 201);
    }

    // Menampilkan satu jenis pengiriman berdasarkan ID
    public function show($id)
    {
        $shipmentType = ShipmentType::find($id);

        if (!$shipmentType) {
            return response()->json(['error' => 'Shipment type not found'], 404);
        }

        return response()->json($shipmentType);
    }

    // Mengupdate jenis pengiriman
    public function update(Request $request, $id)
    {
        $shipmentType = ShipmentType::find($id);

        if (!$shipmentType) {
            return response()->json(['error' => 'Shipment type not found'], 404);
        }

        $validated = $request->validate([
            'name_shipment_type' => 'required|string|max:255',
        ]);

        $shipmentType->name_shipment_type = $validated['name_shipment_type'];
        $shipmentType->save();

        return response()->json($shipmentType);
    }

    // Menghapus jenis pengiriman
    public function destroy($id)
    {
        $shipmentType = ShipmentType::find($id);

        if (!$shipmentType) {
            return response()->json(['error' => 'Shipment type not found'], 404);
        }

        $shipmentType->delete();

        return response()->json(['message' => 'Shipment type deleted successfully']);
    }
}
