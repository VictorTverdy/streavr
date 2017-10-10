var UserClass = function () {
    var newUser = function () {
        var form = $('#form_user_new');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                first_name: {
                    minlength: 2,
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                // username: {
                //     required: true,
                //     minlength: 3
                // },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirm: {
                    equalTo: '#password'
                },
                role: {
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
            newUser();
        }
    };
}();

jQuery(document).ready(function() {
    UserClass.init();
});