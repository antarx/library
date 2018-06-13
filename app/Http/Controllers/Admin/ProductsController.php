<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->input('search', '') . '%')->paginate();

        return view('backend.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create', [
            'product'    => new Product(),
            'categories' => Category::list()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);

        DB::beginTransaction();

        $product = Product::create($request->all());
        $product->categories()->attach($request->category);

        DB::commit();

        return redirect()
            ->route('admin.products.edit', $product->id)
            ->with('success', trans('product.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if ($product) {
            return view('backend.products.edit', [
                'product'    => $product,
                'categories' => Category::list()
            ]);
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $this->validateForm($request);

            DB::beginTransaction();

            $product->fill($request->all())->save();
            $product->categories()->sync($request->category);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', trans('product.update'));
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->cateories()->detach();
            $product->delete();

            return redirect()
                ->back()
                ->with('success', trans('products.delete'));
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Set status the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product && array_key_exists($request->status_id, Product::statuses())) {
            $product->status = $request->status_id;
            $product->save();
        }

        return redirect()->back();
    }

    /**
     * Validate request form.
     *
     * @param Request $request
     */
    protected function validateForm(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|string|max:255',
            'slug'       => 'required|string|max:255',
            'meta_title' => 'required|string|max:255'
        ]);
    }
}
