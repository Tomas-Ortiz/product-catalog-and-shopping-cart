function agregadoAlCarro(producto, agregado) {

    if (agregado) {
        swal({
            title: producto,
            text: "¡Has agregado el producto al carro!",
            icon: "success"
        });
    } else {
        swal({
            title: producto,
            text: "¡El producto ya ha sido agregado al carro!",
            icon: "warning"
        });
    }
}

function actualizarCantCarro(cant) {

    $('#cantProdCarro').val(cant);

}



