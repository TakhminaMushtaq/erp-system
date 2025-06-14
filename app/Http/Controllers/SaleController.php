<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = SalesOrder::with('items.product')->latest()->get();
        return view('sales_orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('sales_orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'customer_name' => 'required|string',
        'sale_date' => 'required|date',
        'products' => 'required|array',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    $total = 0;
    $items = [];

    foreach ($validated['products'] as $item) {
        $product = Product::findOrFail($item['product_id']);
        if ($product->quantity < $item['quantity']) {
            return back()->with('error', "Insufficient stock for {$product->name}");
        }

        $lineTotal = $item['quantity'] * $product->price;
        $total += $lineTotal;

        $items[] = [
            'product_id' => $product->id,
            'quantity' => $item['quantity'],
            'price' => $product->price,
        ];
    }

    $order = SalesOrder::create([
        'customer_name' => $validated['customer_name'],
        'sale_date' => $validated['sale_date'],
        'total_amount' => $total,
    ]);

    foreach ($items as $item) {
        $order->items()->create($item);
        Product::where('id', $item['product_id'])->decrement('quantity', $item['quantity']);
    }

    return redirect()->route('sales_orders.index')->with('success', 'Sales Order created.');
}


    /**
     * Display the specified resource.
     */
    public function show(SalesOrder $salesOrder)
    {
        $salesOrder->load('items.product');
        return view('sales_orders.show', compact('salesOrder'));
    }

    public function exportPdf(SalesOrder $salesOrder)
    {
        $pdf = Pdf::loadView('sales_orders.pdf', compact('salesOrder'));
        return $pdf->download("sales_order_{$salesOrder->id}.pdf");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
