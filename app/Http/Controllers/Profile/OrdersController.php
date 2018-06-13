<?php

namespace App\Http\Controllers\Profile;

use App\Category;
use App\Order;
use App\OrderCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->paginate();

        return view('frontend.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.orders.create', [
            'order'      => new Order(),
            'categories' => Category::list(1)
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

        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice' => Order::generateInvoice(),
            'status'  => Order::STATUS_PREORDER
        ]);

        foreach ($request->order as $items) {
            $order->categories()->attach($items['category_id'], [
                'date_start' => $items['date_start'],
                'date_end'   => $items['date_end']
            ]);
        }

        return redirect()
            ->route('profile.orders.index')
            ->with('success', trans('order.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        if ($order) {
            return view('frontend.orders.show', [
                'order' => $order
            ]);
        }

        return redirect()->route('admin.orders.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Validate request form.
     *
     * @param Request $request
     */
    protected function validateForm(Request $request)
    {
        $this->validate($request, [
            'order'               => 'present',
            'order.*.category_id' => 'required|distinct',
            'order.*.date_start'  => 'required|date_format:d.m.Y',
            'order.*.date_end'    => 'required|date_format:d.m.Y|after:order.*.date_start'
        ]);
    }
}
