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
            <th>{!! trans('mc_core::user.table.active') !!}</th>
            <th>{!! trans('mc_core::user.table.date_created') !!}</th>
            <th>{!! trans('mc_core::user.table.action') !!}</th>
        </tr>
    </thead>
</table>
<input type="hidden" id="link-database" value="{{ route('users.datatable') }}" />
@include('mc_core::layouts.partials.components.modal_delete')
@endsection
@section('script')
    <script>
        jQuery(function($){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
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
                    {name: 'active', data: 'active', orderable: false, className: 'text-center'},
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
                        orders : orders
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            listDataTable.api().ajax.reload();
                        }
                    }
                });
            }

            $('body').on('click', '.toggle-active', function (e) {
                $.ajax({
                    method:'post',
                    url:"{{ route('users.toggle_active') }}",
                    data: {
                        id: $(this).attr('data-id'),
                        active: $(this).val()
                    }
                })
            })

            function format ( d ) {
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                    '<tr>'+
                        '<td>Họ tên:</td>'+
                        '<td>'+d.name+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Ngày tạo:</td>'+
                        '<td>'+d.created_at+'</td>'+
                    '</tr>'+
                '</table>';
            }

            $('body').on('click', 'td .btn-view', function () {
                var tr = $(this).closest('tr');
                var row = listDataTable.api().row(tr);
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            $('body').on('click', '.btn-delete', function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                if (!link) {
                    return;
                }
                $("#confirmModal form").prop({
                    action: link
                });
                $('#confirmModal').modal('show')
            })
        });
    </script>
@endsection
