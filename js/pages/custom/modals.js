$(document).ready(function() {
    $("#login-form").validate({
        //ignore: null,
        onkeyup: true,
        onfocusout: true,
        ignore: 'input[type="hidden"]',
        errorPlacement: function( error, element ) {
            var place = element.closest('.input-group');
            console.log(error);
            if (!place.get(0)) {
                place = element;
            }
            if (place.get(0).type === 'checkbox') {
                place = element.parent();
            }
            if (error.text() !== '') {
                place.after(error);
            }            
        },
        errorClass: 'help-block',
        rules: {
            username: "required",
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            username: "Ingrese su nombre de usuario",
            password: {
                required: "Ingrese una contraseña",
                minlength: "La contraseña debe tener mas de 6 caracteres"
            }            
        },
        highlight: function( label ) {
            $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function( label ) {
            $(label).closest('.form-group').removeClass('has-error');
            label.remove();
        }
    });
});