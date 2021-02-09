@extends('mc_core::layouts.master')

@section('content')
@section('create-button')
<a class="btn btn-primary" href="{{ route('users.create') }}">Tạo mới</a>
@endsection
<table class="table">
    <thead>
        <tr>
            <th>{!! trans('mc_core::user.table.no_order') !!}</th>
            <th>{!! trans('mc_core::user.table.name') !!}</th>
            <th>{!! trans('mc_core::user.table.date_created') !!}</th>
            <th>{!! trans('mc_core::user.table.action') !!}</th>
        </tr>
    </thead>
</table>
<input type="hidden" id="link-database" value="{{ route('users.datatable') }}" />
@endsection
@section('script')
    <script>
        jQuery(function($){
            var linkDatabase = $("#link-database").val();
            var listDataTable = $('.table').dataTable({
                ajax: {
                    url: linkDatabase
                },
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('row-sort');
                    $(row).attr('data-id', data.id);
                },
                order: [
                    [0, 'asc']
                ],
                dom: '<"row"<"col-md-7 offset-md-5"f>><"table-responsive"rt><"row"<"col-md-5"l><"col-md-7"p>><"clear">',
                columns: [
                    datatableRenderColumnNoOrder(),
                    {name: 'name', data: 'name', orderable: false},
                    {name: 'created_at', data: 'created_at', className: 'text-center', searchable: false},
                    {name: 'action', data: 'action', className: 'text-center has-btn', searchable: false, orderable: false},
                ]
            })

            $( "tbody" ).sortable({
                items: "tr.row-sort",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer()
            {
                var orders = [];

                $('tr.row-sort').each(function(index,element) {
                    orders.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('users.sortable') }}",
                    data: {
                        orders : orders,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            listDataTable.api().ajax.reload();
                        }
                    }
                });
            }
        });
    </script>
@endsection
