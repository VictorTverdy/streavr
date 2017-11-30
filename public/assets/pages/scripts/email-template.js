var TemplateClass = function () {
    var newTemplate = function () {
        var form = $('#form_template');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                from_email: {
                    minlength: 2,
                    required: true
                },
                from_name: {
                    required: true,
                },
                subject: {
                    required: true
                },
                body: {
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
            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                form[0].submit(); // submit the form
            }
        });
    }

    return {
        // main function to initiate the module
        init: function () {
            newTemplate();
        }
    };
}();

jQuery(document).ready(function() {
    TemplateClass.init();
});