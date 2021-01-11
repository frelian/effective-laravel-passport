<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * D) Ver todos los productos disponibles (paginadas).
     * API: /api/admin/products
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiProducts(Request $request) {

        $request = request();
        $token = $request->bearerToken();

        $products = DB::table('products')->paginate(5);

        return response()->json($products, 200);
    }
}
