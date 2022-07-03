@extends('layouts.admin')

@section('content')
@php
$customer = App\Customer::count();
$bill = App\Bill::count();
$vehicle = App\Vehicle::count();    
@endphp
<div class="content">
<div class="grey-bg container-fluid">
  <section id="minimal-statistics">
    <div class="row">
      <div class="col-xl-4 col-sm-6 col-12"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="nav-icon fas fa-fw fa-car" aria-hidden="true"></i>
                </div>
                <div class="media-body text-right">
                  <h3>{{ $vehicle }}</h3>
                  <span>Vehicles</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="nav-icon fas fa-fw fa-users" aria-hidden="true"></i>
                </div>
                <div class="media-body text-right">
                  <h3>{{ $customer }}</h3>
                  <span>Customers</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="nav-icon fas fa-fw fa-file" aria-hidden="true"></i>
                </div>
                <div class="media-body text-right">
                  <h3>{{ $bill }}</h3>
                  <span>Bills</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>
@endsection
@section('scripts')
@parent

@endsection