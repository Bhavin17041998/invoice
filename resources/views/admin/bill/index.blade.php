@extends('layouts.admin')
@section('content')
@can('vehicle_manage')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.bill.create") }}">
                {{ trans('global.add') }} Bill
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Bill {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Invoice Number
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            Vehicle Number
                        </th>
                        <th>
                            Total Amount
                        </th>
                        <th>
                            Invoice
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill as $key => $value)
                        <tr data-entry-id="{{ $value->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $value->id ?? '' }}
                            </td>
                            <td>
                                {{ $value->customer->name ?? '' }}
                            </td>
                            <td>
                                {{ $value->vehicle->number ?? '' }}
                            </td>
                            <td>
                                {{ $value->total_amount ?? '' }}
                            </td>
                            <td>
                                {{-- <a class="btn btn-xs btn-primary" href="{{ route('admin.customer.show', $value->id) }}">
                                    {{ trans('global.view') }}
                                </a> --}}

                                <a class="btn btn-xs btn-info" href="{{ route('admin.bill.generatePDF', $value->id) }}">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </a>

                                {{-- <form action="{{ route('admin.customer.destroy', $value->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form> --}}

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('vehicle_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
//   dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection