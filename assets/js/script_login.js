$(document).ready(function() {
    $('#myForm').on('submit', function (event) {
        event.preventDefault();
        $.post(
            $(this).attr('action'),
            $(this).serialize(),
            function (result) {
                if(result.failed) {
                    $('#close').click();
                    $('#msg').empty();
                    $('#msg').prepend('<div class="alert alert-danger">' +result.message+ '<div>');
                } else if (result.success) {
                    $('#myForm')[0].reset();
                    $('#close').click();
                    $('#msg').empty();
                    $('#msg').prepend('<div class="alert alert-success">' +result.message+ '<div>');
                }
            }, 'json');
        
    });
});