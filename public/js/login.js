// =========================== //
// ======== CAUCIONES ======== //
// =========================== //

function validaciones(url) {
    let url_hots = $('#url_host').val();
    let error_email_validacion = 1;
    let validaciones_correctas_pass = 0; // EL VALOR CORRECTO ES 6 (LA SUMA DE LOS VALORES ARBITRARIOS DE CADA VALIDACIÓN (ENTRE 8 Y 20 CARACTERES, QUE TENGA UNA MAYÚSCULA, QUE TENGA NÚMEROS))
    // 
    if (url == url_hots+'/login'){
        $('#email').on('keyup',function(){
            error_email_validacion = validarEmail($(this).val());
        });
        // 
        $('#contraseña').on('keyup',function(){
            validaciones_correctas_pass = validarPass();            
        });
        $('#login').on('submit',function(e){
            $('#err_pass').addClass('hide');
            $('#err_cuenta').addClass('hide');
            $('#logeado_ok').addClass('hide');
            e.preventDefault();
            if (error_email_validacion == 0 && validaciones_correctas_pass == 6) {
                $.ajax({
                    method:'post',
                    url: url_hots+'/logearse',
                    data: $('#login').serialize(),
                    success: function(resp){
                        if (resp == 1) {
                            M.toast({html: 'Te logeaste correctamente!', classes: 'rounded green'});
                            setTimeout(() => {
                                window.location.replace('/');                                
                            }, 2000);
                        } else if (resp == 2) {
                            M.toast({html: 'Te equivocaste de clave polli! jijiji', classes: 'rounded red'});
                        } else {
                            M.toast({html: 'No tenés cuenta...', classes: 'rounded red'});
                        }
                    }
                })
            }
        })
    } else if (url == url_hots+'/registrarse') {
        
    } else if (url == url_hots+'/restablecer-contraseña') {
        $('#email').on('keyup',function(){
            error_email_validacion = validarEmail($(this).val());
        });
    }
    
}

function validarEmail(valor){
    let emailreg = /[a-z.-]+@[a-z]+\.[a-z]{2,5}/;
    let error_mail = 1;
    // 
    if (valor.length > 5) {
        if (!validarCampo(2,emailreg,'#email')) {
            $('#email_aviso').removeClass('hide');
            $(this).addClass('invalid');
            error_mail ++;
        } else {
            $('#email_aviso').addClass('hide');
            $(this).removeClass('invalid');
            $(this).addClass('valid');
            error_mail = 0;
        }
    } else {
        $('#email_aviso').addClass('hide');
        $(this).removeClass('invalid');
        $(this).removeClass('valid');
    }
    return error_mail;
}

function validarPass(){
    let passreg3 = /.{8,20}/;
    let passreg1 = /[A-Z]/;
    let passreg2 = /[0-9]/;
    let valid_pass_input = 0;
    // 1ERA VALIDACION: CARACTERES ENTRE 8 Y 20
    if (!validarCampo(2,passreg3,'#contraseña')) {
        $('#pass_aviso3').removeClass('hide');
        $(this).addClass('invalid');
    } else {
        valid_pass_input = 3;
        $('#pass_aviso3').addClass('hide');
    }
    // 2ERA VALIDACION: MAYÚSCULAS
    if (!validarCampo(1,passreg1,'#contraseña')) {
        $('#pass_aviso1').removeClass('hide');
        $(this).addClass('invalid');
    } else {
        $('#pass_aviso1').addClass('hide');
        valid_pass_input = (valid_pass_input == 3 || valid_pass_input == 4) ? valid_pass_input+1 : valid_pass_input;
    }
    // 3ERA VALIDACION: NÚMEROS
    if (!validarCampo(1,passreg2,'#contraseña')) {
        $('#pass_aviso2').removeClass('hide');
        $(this).addClass('invalid');
    } else {
        $('#pass_aviso2').addClass('hide');
        valid_pass_input = (valid_pass_input == 3 || valid_pass_input == 4) ? valid_pass_input+2 : valid_pass_input;
    }
    // VALIDACION COMPLETA
    if (valid_pass_input == 6) {
        $(this).removeClass('invalid');
        $(this).addClass('valid');
    }
    return valid_pass_input;
}

function validarCampo(tipo_validacion,regex,input) {
    if (tipo_validacion == 1) {
        return regex.test($(input).val());
    } else if (tipo_validacion == 2) {
        return $(input).val().match(regex);
    }
    return false;
}

function regenerarClave(){
    $('#restablecer').on('submit',function(e){
        e.preventDefault();
        console.log('aca');
    });
    // $.ajax({
    //     url:'/regenerar-clave',
    //     method:'post',
    //     data:
    // });
}
