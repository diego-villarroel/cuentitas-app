
// ============================= //
// ======== INVERSIONES ======== //
// ============================= //

function inversiones() {

    // GRAFICOS
    // GRAFICO RESUMEN
    let data_inv = [];
    let labels_inv = [];
    $('.label_inversiones').each(function(){
        labels_inv.push($(this).val());
    });
    $('.valores_inversiones').each(function(){
        data_inv.push($(this).val());
    });
    let ctx = document.getElementById('inversiones');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels_inv,
            datasets: [{
                data: data_inv,
            }]
        },
        options: {
            responsive: true,
            plugins: { 
                legend: {
                    labels: {
                        color: "white", 
                    }
                }
            },

        }
    });
    // GRAFICO POR TIPO DE INVERSION
    $('.graf_tipo_inv').each(function(){ 
        let ctx = document.getElementById('graf-inversion-segmentada-'+$(this).val());
        let valor_tot = $(this).data('valor-tot');
        let valores = [];
        $('.una-inv-'+$(this).val()).each(function(){
            let aux = {
                axis: 'y',
                label: $(this).data('nombre-inv'),
                data: [$(this).data('valor-neto')],
                borderWidth: 1
            };
            valores.push(aux);
        });
        new Chart(
            ctx,{
                type: 'bar',
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            stacked: true,
                            title: {
                                color: 'purple',
                                display: true,
                                text: 'Total: $ '+valor_tot
                            }
                        },
                        y: {
                            stacked: true
                        }
                    },
                },            
                data: {
                    labels: [""],    
                    datasets: valores
                }
            }
        );
    })
}

function agregarInversion() {
    let url_hots = $('#url_host').val();
    $('#add-inversion').on('submit',function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url:url_hots+'/agregar-inversion',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Tipo de Presupuesto agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/inversiones');
                    }, 3000);
                } else if (resp == '2') {
                    M.toast({html: 'Existe un registro similar, cambiá el nombre por favor.', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar un nuevo Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
            },
        })
    });
}

function borrarInversion() {
    let url_hots = $('#url_host').val();
    $('.borrar-inv').on('click',function(){
        $('#frm-borrar-inversion [name="id_inversion"]').val($(this).data('id-inv'));
        $('#nombre-inv-borrar').html($(this).data('nombre-inv'));
        $('#fecha-inv-borrar').html($(this).data('fecha-inv'));
        $('#valor-inv-borrar').html($(this).data('valor-inv'));
        $('#cantidad-inv-borrar').html($(this).data('cantidad-inv'));
    });
    $('#confirm_borrar_inv').on('click',function(){
        $.ajax({
            url: url_hots+'/borrar-inversion',
            method: 'post',
            data: $('#frm-borrar-inversion').serialize(),
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Borraste Inversion con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/inversiones');
                    }, 2000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar un nuevo Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
            },
        })
    });
}