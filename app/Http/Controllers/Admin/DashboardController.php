<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.index', [
            'users'  => $this->getUsers(),
            'orders' => $this->getOrders()
        ]);
    }

    protected function getUsers()
    {
        return User::whereHas('roles', function ($query) {
                $query->where('role_id', Role::ROLE_USER);
            })
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
    }

    protected function getOrders()
    {
        return Order::orderBy('id', 'desc')
            ->take(10)
            ->get();
    }
}
