/**
 * Created by Administrator on 8/08/2017.
 */
var EventClass = function () {
    var eventGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_event").DataTable({
            ajax: {
                url: '/event/get_events',
                dataType: 'json',
                method: 'GET',
                data: {}
            },
            columns: [
                {
                    data: 'thumbnail',
                    width: 80,
                    searchable: false,
                    className: 'reorder'
                },
                {
                    data: 'name'
                },
                {
                    data: 'price'
                },
                {
                    data: 'time_start',
                    width: 80,
                    searchable: false
                },
                {
                    data: 'time_length',
                    className: 'text-align-left',
                    width: '20%'

                },
                {
                    data: 'created_at'
                },
                {
                    data: null,
                    searchable: false,
                    width: 110,
                    defaultContent: '<a href="javascript:;" class="btn btn-xs blue edit-butt"><i class="fa fa-edit"></i> Edit</a>' +
                    '<a href="javascript:;" class="btn btn-xs red delete-butt"><i class="fa fa-trash"></i> Delete</a><br><br>' +
                        '<a href="javascript:;" class="btn btn-xs blue attendees-butt"><i class="fa fa-edit"></i> Attendees</a>'
                }
            ],
            autoWidth: false,
            paging: false,
            ordering: false,
            createdRow: function(row, data, dataIndex) {
                // $(row).attr('data-id', data.DT_RowData.id);
                $(row).find('.edit-butt').attr('href', "/event/edit/" + data.DT_RowData.id)
                $(row).find('.attendees-butt').attr('href', "/event/attendees/" + data.DT_RowData.id)
            }
        });

        // Click "Delete" button
        $('#datatable_event tbody').on('click', '.delete-butt', function() {
            if( confirm('Are you sure you want to delete selected item?') ) {
                var id = table.row($(this).parents('tr')).data().id;
                // table.row($(this).parents('tr')).remove().draw();
                $.ajax({
                    method: "POST",
                    url: "/event/delete/" + id,
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
            eventGrid();
        }
    };
}();

jQuery(document).ready(function() {
    EventClass.init();
});