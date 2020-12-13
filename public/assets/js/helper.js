function datatableRenderColumnNoOrder(className) {
    return {
        render: function(data, type, row, meta) {
            return meta.row + 1;
        },
        className: (className !== undefined ? className : 'text-center'),
        searchable: false,
        orderable: false
    }
}