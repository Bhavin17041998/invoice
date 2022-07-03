<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('customer_manage')) {
            return abort(401);
        }

        $customer = Customer::all();

        return view('admin.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('customer_manage')) {
            return abort(401);
        }
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('customer_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required',
            'mobile_number' => 'required',
            'address' => 'required'
        ]);
        $customer = Customer::create($request->all());
        if ($customer) {
            return redirect()->route('admin.customer.index')->with('success', 'Success! Customer created');
        }
        else {
            return redirect()->route('admin.customer.index')->with('failed', 'Failed! Customer not created');
        }
        // return redirect()->route('admin.customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        if (! Gate::allows('customer_manage')) {
            return abort(401);
        }
        return view('admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        if (! Gate::allows('customer_manage')) {
            return abort(401);
        }
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if (! Gate::allows('customer_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required',
            'mobile_number' => 'required',
            'address' => 'required'
        ]);
        $customer->update($request->all());
        if ($customer) {
            return redirect()->route('admin.customer.index')->with('success', 'Success! Customer updated');
        }
        else {
            return redirect()->route('admin.customer.index')->with('failed', 'Failed! Customer not updated');
        }
        // return redirect()->route('admin.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if (! Gate::allows('customer_manage')) {
            return abort(401);
        }
        $customer->delete();
        if ($customer) {
            return redirect()->route('admin.customer.index')->with('success', 'Success! Customer deleted');
        }
        else {
            return redirect()->route('admin.customer.index')->with('failed', 'Failed! Customer not deleted');
        }
        // return redirect()->route('admin.customer.index');
    }
}
