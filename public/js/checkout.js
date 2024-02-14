function eventosCheckout(){
    let carrito_checkout = JSON.parse(localStorage.getItem('carrito'));
    let host = host_wsp();
    inicioCheckout(carrito_checkout);
    eliminarProducto(carrito_checkout);
    finalizarCompra(carrito_checkout,host);
}

function host_wsp(){
    let screen_width = window.screen.availWidth;
    let host_wsp = "wa.me";
    if (screen_width > 1200) {
        host_wsp = "web.whatsapp.com";
    }
    return host_wsp
}

function inicioCheckout(carrito_checkout) {
    if (carrito_checkout != null && carrito_checkout.length > 0) {
        document.getElementById('hay_compras').className = 'table mt-4';
        document.getElementById('finalizar_compra').className = 'btn btn-success';
        document.getElementById('carrito_vacio').className += ' d-none';
        document.getElementById('nombre').removeAttribute('disabled');
        document.getElementById('apellido').removeAttribute('disabled');
        document.getElementById('email').removeAttribute('disabled');
        document.getElementById('telefono').removeAttribute('disabled');
    } else {
        document.getElementById('hay_compras').className += ' d-none';
        document.getElementById('carrito_vacio').className = 'text-center';
        document.getElementById('finalizar_compra').className += ' disabled';
        document.getElementById('nombre').setAttribute('disabled',true);
        document.getElementById('apellido').setAttribute('disabled',true);
        document.getElementById('email').setAttribute('disabled',true);
        document.getElementById('telefono').setAttribute('disabled',true);
    }
    // DETALLE DE PRODUCTO
    if (carrito_checkout != null){
        for ( let i = 0; i < carrito_checkout.length; i++ ) {
            document.getElementById('detalle_compra').innerHTML += "<tr><td>"+carrito_checkout[i][1]+"</td><td class='text-center'><button class='btn btn-sm btn-outline-secondary' id='eliminar_prod_"+i+"' data-bs-toggle='modal' data-bs-target='#confirm_eliminar_producto' data-prod='"+i+"'><i class='bi bi-trash3' ></i></button></td></tr>";
        }
    }
}

function eliminarProducto(carrito_checkout) {
    if (carrito_checkout != null) {
        for ( let i = 0; i < carrito_checkout.length; i++ ) {
            document.getElementById('eliminar_prod_'+i).addEventListener('click',function(){
                let prod_a_eliminar = parseInt(this.getAttribute('data-prod'));
                document.getElementById('prod_a_eliminar').innerHTML = carrito_checkout[prod_a_eliminar][1];
                // 
                document.getElementById('confirm_eliminar_prod').addEventListener('click',function(){
                    carrito_checkout.splice(prod_a_eliminar,1)
                    localStorage.clear();
                    localStorage.setItem('carrito',JSON.stringify(carrito_checkout));
                    window.location.replace('/checkout');
                });
            })
        }
    }
}

function finalizarCompra(carrito_checkout,host) {
    let mensaje = "Hola Cactus Amp! Esta es mi lista de productos que quiero comprar: ";
    let wsp_url = "https://"+host+"/541131187394?text=";

    document.getElementById('finalizar_compra').addEventListener('click',function(){
        let nombre = document.getElementById('nombre').value;
        let apellido = document.getElementById('apellido').value;
        let email = document.getElementById('email').value;
        let telefono = document.getElementById('telefono').value;
        // VALIDACION DE CAMPOS
        let validacion = 0;
        // VALIDA SI ESTAN VACÍOS O NO TIENEN SU TIPO DE DATO
        validacion = validacionEmpty(nombre,'nombre',validacion);
        validacion = validacionEmpty(apellido,'apellido',validacion);
        validacion = validacionEmail(email,'email',validacion);
        validacion = validacionTelefonoARG(telefono,'telefono',validacion);
        // VALIDACIÓN DE QUE EL CARRITO TENGA PRODUCTOS

        if (carrito_checkout != null){
            if (carrito_checkout.length < 0) {
                validacion++;
            }
            // 
            if (validacion == 0) {
                for ( let i = 0; i < carrito_checkout.length; i++ ) {
                    mensaje += "\n - "+carrito_checkout[i][1]+"";
                }

                const data = { _token: document.getElementById('token').value, carrito: JSON.stringify(carrito_checkout), _nombre: nombre, _apellido: apellido, _email: email, _telefono: telefono };
                registroCompra(data)[0];
                mensaje += "\nMi nombre es "+nombre+" "+apellido+", mi teléfono es "+telefono+" y mi email es "+email+".\nSaludos!";
                document.getElementById('link_wsp').setAttribute('href',wsp_url+encodeURIComponent(mensaje));
                document.getElementById('link_wsp').click();
            }
        }
    })

}

async function registroCompra(data) {
    try {
        const response = await fetch("/registro_compra", {
            method: "POST", // or 'PUT'
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });

        const result = await response.json();
    } catch (error) {
        console.error("Error:", error);
    }
}

// ================================================= //
// ============ FUNCIONES DE VALIDACIÓN ============ //
// ================================================= //

function validacionEmpty(valor,id,validacion) {
    if ( valor == '' ) {
        document.getElementById(id).className += ' is-invalid';
        return validacion+1;
    } else {
        document.getElementById(id).className = 'form-control';
        return validacion;
    }
}

function validacionEmail(email,id,validacion) {
    email_valido = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if ( !email.match(email_valido) ) {
        document.getElementById(id).className += ' is-invalid';
        return validacion+1;
    } else {
        document.getElementById(id).className = 'form-control';
        return validacion;
    }
}

function validacionTelefonoARG(telefono,id,validacion) {
    telefono_valido = /^[0-9]{10}$/;
    if ( !telefono.match(telefono_valido) ) {
        document.getElementById(id).className += ' is-invalid';
        return validacion+1;
    } else {
        document.getElementById(id).className = 'form-control';
        return validacion;
    }
}