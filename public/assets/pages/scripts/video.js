var VideoClass = function () {
    var videoGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_video").DataTable({
            ajax: {
                url: '/video/get_videos_by_user',
                dataType: 'json',
                method: 'GET',
                data: {}
            },
            columns: [
                {
                    data: 'thumbnail',
                    width: 80,
                    searchable: false
                },
                {
                    data: 'title',
                    className: 'text-align-left',
                    width: '20%'

                },
                {
                    data: 'description'
                },
                {
                    data: 'visibility',
                    className: 'text-align-center',
                    width: 80
                },
                {
                    data: 'created_at'
                },
                {
                    data: null,
                    searchable: false,
                    width: 110,
                    defaultContent: '<a href="javascript:;" class="btn btn-xs blue edit-butt"><i class="fa fa-edit"></i> Edit</a><a href="javascript:;" class="btn btn-xs red delete-butt"><i class="fa fa-trash"></i> Delete</a>'
                }
            ],
            autoWidth: false,
            paging: false,
            ordering: false,
            createdRow: function(row, data, dataIndex) {
                // $(row).attr('data-id', data.DT_RowData.id);
                $(row).find('.edit-butt').attr('href', "/video/edit/" + data.DT_RowData.id)
            }
        });

        // Click "Delete" button
        $('#datatable_video tbody').on('click', '.delete-butt', function() {
            if( confirm('Are you sure you want to delete selected item?') ) {
                var id = table.row($(this).parents('tr')).data().id;
                // table.row($(this).parents('tr')).remove().draw();
                $.ajax({
                    method: "POST",
                    url: "/video/delete/" + id,
                    data: { '_token': $('#form_video input[name="_token"]').val() },
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
    VideoClass.init();
});