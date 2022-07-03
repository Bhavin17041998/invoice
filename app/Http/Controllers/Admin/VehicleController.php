<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vehicle_manage')) {
            return abort(401);
        }

        $vehicle = Vehicle::all();

        return view('admin.vehicle.index', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vehicle_manage')) {
            return abort(401);
        }
        return view('admin.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('vehicle_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required',
            'number' => 'required',
            'date' => 'required'
        ]);
        $vehicle = Vehicle::create($request->all());
        return redirect()->route('admin.vehicle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        if (! Gate::allows('vehicle_manage')) {
            return abort(401);
        }
        return view('admin.vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        if (! Gate::allows('vehicle_manage')) {
            return abort(401);
        }
        return view('admin.vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        if (! Gate::allows('vehicle_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required',
            'number' => 'required',
            'date' => 'required'
        ]);
        $vehicle->update($request->all());
        return redirect()->route('admin.vehicle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        if (! Gate::allows('vehicle_manage')) {
            return abort(401);
        }
        $vehicle->delete();

        return redirect()->route('admin.vehicle.index');
    }
}
