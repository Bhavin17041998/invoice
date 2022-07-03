@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Invoice
    </div>

    <div class="card-body">
        <form action="{{ route("admin.bill.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- <div class="form-group col-md-6 {{ $errors->has('invoice_number') ? 'has-error' : '' }}">
                    <label for="invoice_number">Invoice Number*</label>
                    <input type="invoice_number" name="invoice_number" class="form-control" id="invoice_number" />
                    @if($errors->has('invoice_number'))
                        <em class="invalid-feedback">
                            {{ $errors->first('invoice_number') }}
                        </em>
                    @endif
                </div> --}}
                <div class="form-group col-md-6"></div>
                <div class="form-group col-md-6 {{ $errors->has('current_date') ? 'has-error' : '' }}">
                    <label for="current_date">Date*</label>
                    @php
                        $date = Carbon\Carbon::now()->format('d-m-Y');
                    @endphp
                    <input type="text" name="current_date" class="form-control" id="current_date" value="{{ $date }}" readonly/>
                    @if($errors->has('current_date'))
                        <em class="invalid-feedback">
                            {{ $errors->first('current_date') }}
                        </em>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('customer_name') ? 'has-error' : '' }}">
                    <label for="customer_name">Customer Name*</label>
                    <select class="form-control" name="customer_name">
                        <option value="">Select Customer</option>
                        @foreach ($customer as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('customer_name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('customer_name') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.name_helper') }}
                    </p>
                </div>
                <div class="form-group col-md-6 {{ $errors->has('vehicle_name') ? 'has-error' : '' }}">
                    <label for="vehicle_name">Vehicle Number*</label>
                    <select class="form-control" name="vehicle_name">
                        <option value="">Select Vehicle</option>
                        @foreach ($vehicle as $item_value)
                            <option value="{{ $item_value->id }}">{{ $item_value->number }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('vehicle_name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('vehicle_name') }}
                        </em>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('from_date') ? 'has-error' : '' }}">
                    <label for="from_date">From Date*</label>
                    <input type="date" name="from_date" class="form-control" id="from_date" />
                    @if($errors->has('from_date'))
                        <em class="invalid-feedback">
                            {{ $errors->first('from_date') }}
                        </em>
                    @endif
                </div>
                <div class="form-group col-md-6 {{ $errors->has('to_date') ? 'has-error' : '' }}">
                    <label for="to_date">To Date*</label>
                    <input type="date" name="to_date" class="form-control" id="to_date" />
                    @if($errors->has('to_date'))
                        <em class="invalid-feedback">
                            {{ $errors->first('to_date') }}
                        </em>
                    @endif
                </div>
            </div>
            <br />
            <div class="container">
                <div class="row clearfix">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                        <th class="text-center"> # </th>
                        <th class="text-center"> Description </th>
                        <th class="text-center"> Amount </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id='addr0'>
                        <td>1</td>
                        <td><input type="text" name='description[]'  placeholder='Enter Description' class="form-control"/></td>
                        <td><input type="number" name='amount[]' placeholder='Enter Amount' class="form-control amount" step="0.00" min="0"/></td>
                        </tr>
                        <tr id='addr1'></tr>
                    </tbody>
                    </table>
                </div>
                </div>
                <div class="row clearfix">
                <div class="col-md-12">
                    <a id="add_row" class="btn btn-default pull-left">Add Row</a>
                    <a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
                </div>
                </div>
                <div class="row clearfix" style="margin-top:20px">
                <div class="pull-right col-md-4">
                    <table class="table table-bordered table-hover" id="tab_logic_total" style="margin-left: 700px">
                    <tbody>
                        <tr>
                        <th class="text-center">Total</th>
                        <td class="text-center"><input type="number" name='total_amount' placeholder='0.00' class="form-control" id="total_amount" readonly/></td>
                        </tr>
                        <tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script>
    $(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc_total();
	});
	
	$('#tab_logic tbody').on('keyup change',function(){
		calc_total();
	});
});

function calc_total()
{
	var sum=0;
    $('.amount').each(function(){
        sum+=Number($(this).val());
    });

    $('#total_amount').val(sum);
}
</script>
@endsection