<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with([
            'product',
            'user',
        ])->latest()->paginate(15);

        return view('stock-movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock-movements.form', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $product = Product::whereKey($validated['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $quantity = $validated['quantity'];

            if ($validated['type'] === 'out' && $product->stock < $quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Insufficient stock available.',
                ]);
            }

            if ($validated['type'] === 'in') {
                $product->increment('stock', $quantity);
            } else {
                $product->decrement('stock', $quantity);
            }

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $request->user()->id,
                'type' => $validated['type'],
                'quantity' => $quantity,
                'notes' => $validated['notes'] ?? null,
            ]);
        });

        return redirect()->route('stock-movements.index')
            ->with('success', 'Stock movement recorded successfully.');
    }
}