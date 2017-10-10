var UserClass = function () {
    var videoGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_user").DataTable({
            ajax: {
                url: '/user/get_users',
                dataType: 'json',
                method: 'get',
                data: {}
            },
            columns: [
                {
                    data: 'no',
                    width: 60,
                    searchable: false,
                    className: 'dt-center'
                },
                {
                    data: 'name',
                    className: 'text-align-left',
                    width: 150
                },
                // {
                //     data: 'username',
                //     className: 'text-align-left',
                //     width: '150'
                // },
                {
                    data: 'email',
                    className: 'text-align-left',
                    width: '300'
                },
                {
                    data: 'role',
                    className: 'text-align-left',
                    width: '100'
                },
                {
                    data: 'enable',
                    className: 'text-align-center',
                    width: 80
                },
                {
                    data: null,
                    searchable: false,
                    defaultContent: '<a href="javascript:;" class="btn btn-xs blue edit-butt"><i class="fa fa-edit"></i> Edit</a><a href="javascript:;" class="btn btn-xs red delete-butt"><i class="fa fa-trash"></i> Delete</a>'
                }
            ],
            autoWidth: false,
            paging: false,
            ordering: false,
            createdRow: function(row, data, dataIndex) {
                // $(row).attr('data-id', data.DT_RowData.id);
                $(row).find('.edit-butt').attr('href', "/user/edit/" + data.DT_RowData.id)
            }
        });

        // Click "Delete" button
        $('#datatable_user tbody').on('click', '.delete-butt', function() {
            if( confirm('Are you sure you want to delete selected item?') ) {
                var id = table.row($(this).parents('tr')).data().id;
                // table.row($(this).parents('tr')).remove().draw();
                $.ajax({
                    method: "POST",
                    url: "/user/delete/" + id,
                    data: { '_token': $('#form_user input[name="_token"]').val() },
                    cache: false,
                    success: function(data, textStatus, jqXHR){
                        // console.log('success', data, textStatus, jqXHR);
                        table.ajax.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // console.log('error', jqXHR, textStatus, errorThrown);
                        alert('Sorry! Occurred some error. Please retry again.');
                        table.ajax.reload();
                    }
                });
            }
        });
    };

    return {
        // main function to initiate the module
        init: function () {
            videoGrid();
        }
    };
}();

jQuery(document).ready(function() {
    UserClass.init();
});