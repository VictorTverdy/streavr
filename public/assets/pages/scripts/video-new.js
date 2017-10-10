var VideoClass = function () {
    var editVideo = function () {
        var form = $('#form_video_edit');

        $('#save_video_butt').click(function (e) {
            e.preventDefault();

            form.submit();
        });

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                category: {
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
            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                var path = $('tr.template-download').attr('data-path');
                if (!path) {
                    alert('You must upload video file before to save the video.');
                    return false;
                }
                $('#video_path').val(path);
                $('#video_name').val($('tr.template-download').attr('data-name'));
                $('#video_size').val($('tr.template-download').attr('data-size'));

                return true;
            }
        });
    }

    var uploadVideo = function () {
        // Initialize the jQuery File Upload widget:
        $('#form_video_upload').fileupload({
            disableImageResize: false,
            autoUpload: false,
            disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
            maxNumberOfFiles: 1,
            acceptFileTypes: /(\.|\/)(mp4|mpg|mpeg|avi)$/i
        }).bind('fileuploadstart', function (e) {
            $('.progress-bar-success').hide();
            $('.progress-bar-success-new').show();
        }).bind('fileuploaddestroy', function (e, data) {
            return confirm('Are you sure you want to delete this video?');
        });

        // Enable iframe cross-domain access via redirect option:
        $('#form_video_upload').fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
            )
        );

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                        new Date())
                    .appendTo('#form_video_upload');
            });
        }

        // Load & display existing files:
        $('#form_video_upload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: '/api/video/uploaded/0',
            dataType: 'json',
            context: $('#form_video_upload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

    return {
        // main function to initiate the module
        init: function () {
            editVideo();
            uploadVideo();
        }
    };
}();

jQuery(document).ready(function() {
    VideoClass.init();
});