<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function products()
    {
        $items = Product::Paginate(6);
        return view('products', compact('items'));
    }

    public function search(Request $request)
    {
        $request->flash();
        $request->query("page");
        $product_name = $request->input('product_name');
        $product_sort = $request->input('product_sort');
        $sort__type = "";
        $query = Product::query();
        $query->where('name', 'LIKE', "%$product_name%");

        if(strpos($product_sort, 'ascending') !== false){
            $query = $query->orderBy('price');
            $sort__type = "低い順に表示";
        } elseif(strpos($product_sort,'descending') !== false){
            $query = $query->orderByDesc('price');
            $sort__type = "高い順に表示";
        }

        $items = $query->paginate(6)->withQueryString();
        // $product_name = "\"".$product_name."\""."の";
        return view('products', compact('items', 'product_name', 'sort__type'));
    }

    public function descending(Request $request)
    {
        $request->flash();
        $product_name = $request->input("search_data");
        $query = Product::query();
        $query->where('name', 'LIKE', "%$product_name%");
        $items = $query->orderByDesc('price')->paginate(6)->withQueryString();
        $sort__type = "高い順に表示";
        return view('products', compact('items', 'sort__type', 'product_name'));
    }

    public function ascending(Request $request)
    {
        $request->flash();
        $product_name = $request->input("search_data");
        $query = Product::query();
        $query->where('name', 'LIKE', "%$product_name%");
        $items = $query->orderBy('price')->paginate(6)->withQueryString();
        $sort__type = "低い順に表示";
        return view('products', compact('items', 'sort__type', 'product_name'));
    }

    public function reset(Request $request)
    {
        $request->flash();
        $product_name = $request->input("search_data");
        $query = Product::query();
        $query->where('name', 'LIKE', "%$product_name%");
        $items = $query->paginate(6)->withQueryString();
        return view('products', compact('items','product_name'));
    }

    public function register()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        // 画像の処理
        $filename = $request->image->getClientOriginalName();
        $image = $request->image->storeAs('', $filename, 'public');

        $request->flash();

        $product_contents = $request->only(['name', 'price', 'description']) + ['image'=>$image];
        $product = Product::create($product_contents);

        $season = array_map('intval', $request->input('seasons'));
        $product->seasons()->sync($season);

        return redirect('/products');
    }

    public function detail($id)
    {
        $item = Product::find($id);
        $seasons = Season::all();
        $season_list = Season::pluck('name', 'id');
        return view('detail', compact('item', 'seasons', 'season_list'));
    }

    public function update(ProductRequest $request)
    {

        $request->flash();

        // 画像の処理
        $filename = $request->image->getClientOriginalName();
        $image = $request->image->storeAs('', $filename, 'public');

        $product_contents = $request->only(['name', 'price', 'description']) + ['image' => $image];
        $season = array_map('intval', $request->input('seasons'));

        $item = Product::find($request->input('id'));

        $item->update($product_contents);
        $item->seasons()->sync($season);

        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        $item = Product::find($request->input('id'));
        $item->delete();
        $item->seasons()->detach();

        return redirect('/products');
    }


}

