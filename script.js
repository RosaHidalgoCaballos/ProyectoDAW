let boton = document.getElementById("Eliminar");
boton.addEventListener("click", confirmar);

function confirmar() {
    if (confirm("¿Estás seguro de que deseas realizar esta acción?")) {
        // Obtener el valor del campo DNI
        var dni = document.getElementsByName("DNI")[0].value;

        // Si el usuario confirma, enviar una solicitud AJAX a un script PHP
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'borrar.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Manejar la respuesta del servidor si es necesario
                document.getElementById("mensaje").innerHTML = xhr.responseText;
            }
        };
        xhr.send("DNI=" + dni); // Enviar el DNI como datos en la solicitud
    } else {
        // Si el usuario cancela, hacer algo más o simplemente salir
        console.log("Acción cancelada");
    }
}

function obtener(str) {
        
    let nombre = str.innerText;

        // Si el usuario confirma, enviar una solicitud AJAX a un script PHP
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'detalles.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Manejar la respuesta del servidor si es necesario
                document.getElementById("lista").innerHTML = "";
                document.getElementById("mensaje").innerHTML = xhr.responseText;
            }
        };
        xhr.send("nombre=" + nombre); // Enviar el DNI como datos en la solicitud

}

fetch('servidor.php?q=' + str).then(function (response) {
    return response.json(); // Este response.json() que devolvemos...
}).then(function (producto) {
        document.getElementById("spnNombre").innerHTML =producto.nombre;
        document.getElementById("spnPrecio").innerHTML =producto.precio;
        document.getElementById("ficha").style.display = "block";

});