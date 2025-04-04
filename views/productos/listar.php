<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar</title>

  <!-- Boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

  <!-- ALT + SHIFT + F = ordenar código -->
  <!-- ALT + SHIFT + A = comentar código -->

  <div class="container">
    <div class="card mt-3">
      <div class="card-header">
        <div class="row">
          <div class="col"><strong>Lista de productos</strong></div>
          <div class="col text-end"><a href="registrar.php" class="btn btn-sm btn-success"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Registrar</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-sm" id="tabla-productos">
          <thead>
            <tr>
              <th>ID</th>
              <th>Marca</th>
              <th>Tipo</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Garantía</th>
              <th>Nuevo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contenido dinámico -->
          </tbody>
        </table>
      </div> <!-- ./card-body -->
    </div> <!-- ./card -->
  </div> <!-- ./container -->

  <script>

    /* 
    Consideraciones
      1. Nunca devolver TODAS las filas de la tabla
      2. Mostrar solo los campos relevantes
      3. Agregar comandos(botones)
    */
    const tabla = document.querySelector("#tabla-productos tbody");

    function obtenerDatos() {
      //fetch(URL_CONTROLADOR).then(JSON).then(DATOS).catch(ERROR)
      fetch(`../../app/controllers/ProductoController.php`, {
        method: 'GET'
      })
        .then(response => { return response.json() })
        .then(data => {
          data.forEach(element => {
            tabla.innerHTML += `
              <tr>
                <td>${element.id}</td>
                <td>${element.marca}</td>
                <td>${element.tipo}</td>
                <td>${element.descripcion}</td>
                <td>${element.precio}</td>
                <td>${element.garantia}</td>
                <td>${element.esnuevo}</td>
                <td>
                  <a href='editar.php?id=${element.id}' class='btn btn-sm btn-info'><i class="fa-solid fa-pen"></i></a>
                  <a href='#' data-idproducto='${element.id}' class='btn btn-sm btn-danger delete'><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            `;
          });
        })
        .catch(error => { console.error(error) });
    }

    //¿Como enviamos los datos?
    //Get     : en URL
    //POST    : JSON
    //DELETE  : EN LA URL (miweb.com/producto/5)
    function eliminarProducto(idproducto){
      fetch(`../../app/controllers/ProductoController.php`, {method: 'DELETE'})
        .then(response => { return response.json() })
        .then(data => { console.log(data) })
        .catch(error => { console.log(error) });
    }

    document.addEventListener("DOMContentLoaded", () =>{
      //Cuando la pagina esta Lista, renderiza los datos
      obtenerDatos()

      //¿se puede asociar el evento a un objeto que NO existe? => NO
      //Solucion => "delegacion de eventos"
      tabla.addEventListener("click", (event) =>{
        //boton eliminar
        //En css podemos agregar a <i> pointer-events: none
        const enlace = event.target.closest("a");
        
        //Identificamos el anlace
        if(enlace && enlace.classList.contains("delete")){
          event.preventDefault(); //Hipervinculo deja de funcionar

          const idproducto = parseInt(enlace.getAttribute("data-idproducto"));
          console.log(idproducto);

          if(confirm("¿Esta seguro de eliminar el registro?")){
            eliminarProducto(idproducto);
          }
        }
      })
    });
  </script>

</body>

</html>