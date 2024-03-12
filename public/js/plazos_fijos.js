// ============================== //
// ======== PLAZOS FIJOS ======== //
// ============================== //

function agregarPlazoFijo() {
    $('#activo-plazo-fijo').on('change',function(e){
        if (e.target.checked == true) {
            e.target.value = 1;
        } else {
            e.target.value = 0;
        }
    });
    
    $('#add-plazo-fijo').on('submit',function(e){
        e.preventDefault();
        let inputactivo = $('#activo-plazo-fijo').val();
        let formData = $(this).serialize()+'&activo='+inputactivo;
        $.ajax({
            url:'/agregar-plazo-fijo',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    $('#exito-add-pf').removeClass('hide');
                    setInterval(() => {
                        window.location.replace('/cauciones');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function borrarPlazoFijo() {
    $('.borrar-pf').on('click',function(){
        let pf_select = $(this).data('id-pf');
        let pf_tipo = $(this).data('tipo-pf');
        let pf_fecha = $(this).data('creacion-pf');
        let pf_ganancia = $(this).data('ganancia-pf');
        let pf_porcentaje = $(this).data('porcentaje-pf');
        $('#tipo-pf').text(pf_tipo.trim());
        $('#fecha-pf').text(pf_fecha);
        $('#ganancia-pf').text(pf_ganancia);
        $('#porcentaje-pf').text(pf_porcentaje);
        $('#frm-borrar-pf [name="id_plazo_fijo"]').val(pf_select);
        
    });
    
    $('#confirm_borrar_pf').on('click',function(){
        $.ajax({
            url: '/borrar-plazo-fijo',
            method: 'post',
            data: $('#frm-borrar-pf').serialize(),
            success: function(){
                if (resp == '1') {
                    $('#exito-borrar-pf').removeClass('hide');
                    setInterval(() => {
                        window.location.replace('/plazos-fijos');
                    }, 2000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}
