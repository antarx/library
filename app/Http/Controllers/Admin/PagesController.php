<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::where('title', 'like', '%' . $request->input('search', '') . '%')->paginate();

        return view('backend.pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create', [
            'page' => new Page()
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

        $page = Page::create($request->all());

        return redirect()
            ->route('admin.pages.edit', $page->id)
            ->with('success', trans('page.create'));
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
        $page = Page::find($id);

        if ($page) {
            return view('backend.pages.edit', [
                'page' => $page
            ]);
        }

        return redirect()->route('admin.pages.index');
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
        $page = Page::find($id);

        if ($page) {
            $this->validateForm($request);

            $page->fill($request->all())->save();

            return redirect()
                ->back()
                ->with('success', trans('page.update'));
        }

        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if ($page) {
            $page->delete();

            return redirect()
                ->back()
                ->with('success', trans('page.delete'));
        }

        return redirect()->route('admin.pages.index');
    }

    /**
     * Set status the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status(Request $request, $id)
    {
        $page = Page::find($id);

        if ($page && array_key_exists($request->status_id, Page::statuses())) {
            $page->status = $request->status_id;
            $page->save();
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
            'title'            => 'required|max:255',
            'slug'             => 'required|max:255|unique:pages,slug,' . $request->id,
            'meta_title'       => 'required|max:255',
            'meta_description' => 'max:255',
            'meta_keywords'    => 'max:255',
        ]);
    }
}
