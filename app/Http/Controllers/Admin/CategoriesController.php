<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::where('name', 'like', '%' . $request->input('search', '') . '%')->paginate();

        return view('backend.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create', [
            'category'   => new Category(),
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

        $category = Category::create($request->all());

        return redirect()
            ->route('admin.categories.edit', $category->id)
            ->with('success', trans('category.create'));
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
        $category = Category::find($id);

        if ($category) {
            return view('backend.categories.edit', [
                'category'   => $category,
                'categories' => Category::list($category->id)
            ]);
        }

        return redirect()->route('admin.categories.index');
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
        $category = Category::find($id);

        if ($category) {
            $this->validateForm($request);

            $category->fill($request->all())->save();

            return redirect()
                ->back()
                ->with('success', trans('category.update'));
        }

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();

            return redirect()
                ->back()
                ->with('success', trans('category.delete'));
        }

        return redirect()->route('admin.categories.index');
    }

    /**
     * Set status the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category && array_key_exists($request->status_id, Category::statuses())) {
            $category->status = $request->status_id;
            $category->save();
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
            'name'             => 'required|max:255',
            'slug'             => 'required|max:255|unique:categories,slug,' . $request->id,
            'meta_title'       => 'required|max:255',
            'meta_description' => 'max:255',
            'meta_keywords'    => 'max:255',
            'sort_order'       => 'required|integer|max:11'
        ]);
    }
}
