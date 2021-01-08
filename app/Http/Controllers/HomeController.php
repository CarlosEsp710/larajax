<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = \App\Models\Product::paginate();
        return view('home', compact('products'));
    }

    public function destroyProduct(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = \App\Models\Product::find($id);
            $product->delete();
            $products_total = \App\Models\Product::all()->count();
            return response()->json([
                'total' => $products_total,
                'message' => $product->name . 'fue eliminado correctamente'
            ]);
        }
    }
}
