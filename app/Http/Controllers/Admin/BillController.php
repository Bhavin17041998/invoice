<?php

namespace App\Http\Controllers\Admin;

use App\Bill;
use App\Vehicle;
use App\Customer;
use App\BillConnection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use DB;
use PDF;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('bill_manage')) {
            return abort(401);
        }

        $bill = Bill::all();

        return view('admin.bill.index', compact('bill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('bill_manage')) {
            return abort(401);
        }
        $vehicle = Vehicle::get(['number','name','id']);
        $customer = Customer::get(['name','id']);
        return view('admin.bill.create',compact('vehicle','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('bill_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'current_date' => 'required',
            'customer_name' => 'required',
            'vehicle_name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $customer = Bill::create($request->all());
        foreach($request->amount as $key => $value){
            DB::table('bills_connection')->insert([
                'bill_id' => $customer->id,
                'description' => $request->description[$key],
                'amount' => $value,
            ]);
        }
        return redirect()->route('admin.bill.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }

    public function generatePDF($id)
    {
        $bill = Bill::find($id);
        $bill_connection = BillConnection::where('bill_id', $id)->get();
        $pdf = PDF::loadView('myPDF',compact('bill', 'bill_connection'));
        return $pdf->download('invoice.pdf');
    }
}
