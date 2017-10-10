var AttendeesClass = function () {
    var eventGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_attendees").DataTable({
            ajax: {
                url: '/event/get_attendees/'+$("#event_id").val(),
                dataType: 'json',
                method: 'GET',
                data: {}
            },
            columns: [
                {
                    data: 'no'
                },
                {
                    data: 'user_name'
                },
                {
                    data: 'user_email'
                },
                {
                    data: 'payment_status_name'
                },
                {
                    data: 'allowed'
                },
                {
                    data: 'payment_source_name'
                },
                {
                    data: 'payment_method_name'
                },
                {
                    data: 'registration_status_name'
                },
                {
                    data: 'created_at'
                }

            ],
            autoWidth: false,
            paging: false,
            ordering: false
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
    AttendeesClass.init();
});