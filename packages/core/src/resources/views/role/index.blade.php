@extends('mc_core::layouts.master')

@section('content')
@section('create-button')
<a class="btn btn-primary" href="{{ route('roles.create') }}">Tạo mới</a>
@endsection
<table class="table">
    <thead>
    <tr>
        <th>{!! trans('mc_core::role.table.no_order') !!}</th>
        <th>{!! trans('mc_core::role.table.name') !!}</th>
        <th>{!! trans('mc_core::role.table.date_created') !!}</th>
        <th>{!! trans('mc_core::role.table.action') !!}</th>
    </tr>
    </thead>
</table>
<input type="hidden" id="link-database" value="{{ route('roles.datatable') }}" />
@include('mc_core::layouts.partials.components.modal_delete')
@endsection
@section('script')
    <script>
        jQuery(function($){
            var linkDatabase = $("#link-database").val();
            var listDataTable = $('.table').dataTable({
                ajax: {
                    url: linkDatabase
                },
                order: [
                    [0, 'desc']
                ],
                dom: '<"row"<"col-md-7 offset-md-5"f>><"table-responsive"rt><"row"<"col-md-5"l><"col-md-7"p>><"clear">',
                columns: [
                    datatableRenderColumnNoOrder(),
                    {name: 'name', data: 'name', orderable: false},
                    {name: 'created_at', data: 'created_at', className: 'text-center', searchable: false},
                    {name: 'action', data: 'action', className: 'text-center has-btn', searchable: false, orderable: false},
                ]
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
                var id = $(this).attr('data-id')
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
