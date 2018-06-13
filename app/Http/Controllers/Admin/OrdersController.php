<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $userId)
    {
        $user = User::find($userId);

        if ($user) {
            $orders = Order::where('user_id', $userId)
                ->where('invoice', 'like', '%' . $request->input('search', '') . '%')
                ->paginate();

            return view('backend.orders.index', [
                'user'   => $user,
                'orders' => $orders
            ]);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($userId, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', $userId)
            ->first();

        if ($order) {
            return view('backend.orders.edit', [
                'order'      => $order,
                'categories' => Category::list(1)
            ]);
        }

        return redirect()->route('admin.orders.index', $userId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', $userId)
            ->first();

        if ($order) {
            $this->validateForm($request);

            $order->fill($request->all())->save();

            $order->categories()->detach();

            foreach ($request->order as $items) {
                $order->categories()->attach($items['category_id'], [
                    'date_start' => $items['date_start'],
                    'date_end'   => $items['date_end']
                ]);
            }

            return redirect()
                ->back()
                ->with('success', trans('order.update'));
        }

        return redirect()->route('admin.orders.index', $userId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', $userId)
            ->first();

        if ($order) {
            $order->categories()->detach();
            $order->delete();

            return redirect()
                ->back()
                ->with('success', trans('order.delete'));
        }

        return redirect()->route('admin.orders.index', $userId);
    }

    /**
     * Set status the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status(Request $request, $userId, $orderId)
    {
        $order = Order::where('user_id', $userId)->find($orderId);

        if ($order && array_key_exists($request->status_id, Order::statuses())) {
            $order->status = $request->status_id;
            $order->save();
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
            'order'               => 'present',
            'order.*.category_id' => 'required|distinct',
            'order.*.date_start'  => 'required|date_format:d.m.Y',
            'order.*.date_end'    => 'required|date_format:d.m.Y|after:order.*.date_start'
        ]);
    }
}
