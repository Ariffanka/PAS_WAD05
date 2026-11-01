<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalStock = Product::sum('stock');

        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->latest()
            ->take(5)
            ->get();

        $recentMovements = StockMovement::with([
            'product',
            'user',
        ])->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalStock',
            'lowStockProducts',
            'recentMovements'
        ));
    }
}