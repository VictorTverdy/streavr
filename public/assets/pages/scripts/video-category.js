var VideoCategory = function () {
    var saveCategory = function () {
        var form = $('#form_video_category');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                thumbnail: {
                    required: true
                }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            submitHandler: function (form) {
                form[0].submit(); // submit the form
            }
        });
    };

    var categoryGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_category").DataTable({
            ajax: {
                url: '/api/video/get_categories',
                dataType: 'json',
                method: 'POST',
                data: {}
            },
            columns: [
                {
                    data: 'thumbnail',
                    width: 100,
                    searchable: false,
                    className: 'reorder'
                },
                {
                    data: 'name',
                    className: 'text-align-left',
                    width: '20%'

                },
                {
                    data: 'description'
                },
                {
                    data: 'language'
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
                $(row).find('.edit-butt').attr('href', "/video/category/edit/" + data.DT_RowData.id)
            },
            rowReorder: {
                dataSrc: 'id',
                update: false   // Disable redraw after reorder
            }
        });

        // Click "Delete" button
        $('#datatable_category tbody').on('click', '.delete-butt', function() {
            if( confirm('Are you sure you want to delete selected item?') ) {
                var id = table.row($(this).parents('tr')).data().id;
                // table.row($(this).parents('tr')).remove().draw();
                $.ajax({
                    method: "POST",
                    url: "/video/category/delete/" + id,
                    data: { '_token': $('#form_video_category input[name="_token"]').val() },
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

        table.on('row-reorder', function(e, diff, edit) {
            // console.log(diff);
            var orders = [];
            for ( var i = 0; i < diff.length; i++ ) {
                orders[i] = {id: diff[i].oldData, pos: diff[i].newPosition};
            }

            $.ajax({
                method: "POST",
                url: "/video/category/reorder",
                data: {
                    '_token': $('#form_video_category input[name="_token"]').val(),
                    orders: orders
                },
                cache: false,
                success: function(data, textStatus, jqXHR){
                    // console.log(data, textStatus, jqXHR);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // console.log(jqXHR, textStatus, errorThrown);
                    alert('Sorry! Occurred some error. Please retry again.');
                    table.ajax.reload();
                }
            });
        });
    };

    return {
        // main function to initiate the module
        init: function () {
            saveCategory();
            categoryGrid();
        }
    };
}();

jQuery(document).ready(function() {
    VideoCategory.init();
});