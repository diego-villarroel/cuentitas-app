async function detalleProducto(data) {
    try {
        const response = await fetch("/detalle_producto", {
            method: "POST", // or 'PUT'
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });

        const result = await response.json();
        console.log(result);
        document.getElementById('titulo_producto').innerHTML = result[0].nombre_producto;
        document.getElementById('descrip_prod').innerHTML = result[0].descripcion;
        document.getElementById('descrip_prod').innerHTML += "<br><br><small>Desde $"+result[0].precio+"</small>";
        document.getElementById('img_prod').setAttribute('src',result[0].url_img);
        document.getElementById('agregar_carrito').setAttribute('data-id-prod',result[0].id);
        document.getElementById('agregar_carrito').setAttribute('data-nombre-prod',result[0].nombre_producto);
    } catch (error) {
        console.error("Error:", error);
    }
}

function eventosTienda(){

    let prod = document.getElementsByClassName('producto');
    let id_prod = '';
    for ( p of prod ) {
        p.addEventListener('click', function(){
            id_prod = this.getAttribute('data-id');
            // 
            const data = { _token: document.getElementById('token').value, id_producto: id_prod };
            detalleProducto(data)[0];
        })
    }
    let btn_agregar = document.getElementById('agregar_carrito');
    btn_agregar.addEventListener('click',function(){
        let carrito = [];
        if (localStorage.getItem("carrito") != null) {
            carrito = JSON.parse(localStorage.getItem("carrito"));
        }
        let prod_add = [btn_agregar.getAttribute('data-id-prod'),btn_agregar.getAttribute('data-nombre-prod')];
        carrito.push(prod_add);
        localStorage.setItem("carrito", JSON.stringify(carrito));
        document.getElementById('cantidad_carrito').innerHTML = carrito.length;
        document.getElementById('cerrar_modal').click();
    });

    
}