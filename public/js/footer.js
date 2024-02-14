function eventosFooter(){
    carrito = JSON.parse(localStorage.getItem("carrito"));
    if (carrito != null && carrito.length > 0) {
        document.getElementById('cantidad_carrito').innerHTML = carrito.length;
    } else {
        document.getElementById('cantidad_carrito').innerHTML = '';
    }
}