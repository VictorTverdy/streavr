/**
 * Created by Administrator on 8/08/2017.
 */
var EventClass = function () {
    var eventGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_event").DataTable({
            ajax: {
                url: '/settings/variable/get_variables',
                dataType: 'json',
                method: 'GET',
                data: {}
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'description'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'language'
                },
                {
                    data: null,
                    searchable: false,
                    width: 170,
                    defaultContent: '<a href="javascript:;" class="btn btn-xs blue edit-butt"><i class="fa fa-edit"></i> Edit</a>' +
                    '<a href="javascript:;" class="btn btn-xs red delete-butt"><i class="fa fa-trash"></i> Delete</a>'
                }
            ],
            autoWidth: false,
            paging: false,
            ordering: false,
            createdRow: function(row, data, dataIndex) {
                // $(row).attr('data-id', data.DT_RowData.id);
                $(row).find('.edit-butt').attr('href', "/settings/variable/edit/" + data.DT_RowData.id)
            }
        });

        // Click "Delete" button
        $('#datatable_event tbody').on('click', '.delete-butt', function() {
            if( confirm('Are you sure you want to delete selected item?') ) {
                var id = table.row($(this).parents('tr')).data().id;
                // table.row($(this).parents('tr')).remove().draw();
                $.ajax({
                    method: "POST",
                    url: "/settings/variable/delete/" + id,
                    data: { '_token': $('#form_variable input[name="_token"]').val() },
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
            eventGrid();
        }
    };
}();

jQuery(document).ready(function() {
    EventClass.init();
});