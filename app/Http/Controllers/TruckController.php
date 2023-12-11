<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    // Truck detail page controller for order deliver feature to be used by logistic
    // to change status of the order when the order is delivered.
    public function show($id)
    {
        $truck = Truck::with('orders')->findOrFail($id);

        return view('trucks.show', compact('truck'));
    }
}
