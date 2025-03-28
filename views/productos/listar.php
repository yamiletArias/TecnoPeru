<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

  <!-- ALT + SHIFT + F = ordenar código -->
  <!-- ALT + SHIFT + A = comentar código -->

  <div class="container">
    <div class="card mt-3">
      <div class="card-header">
        <div class="row">
          <div class="col"><strong>Lista de productos</strong></div>
          <div class="col text-end"><a href="registrar.php" class="btn btn-sm btn-success" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Registrar</a></div>
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

    function obtenerDatos(){
      //fetch(URL_CONTROLADOR).then(JSON).then(DATOS).catch(ERROR)
      fetch(`../../app/controllers/ProductoController.php`, {
        method: 'GET'
      })
        .then(response => { return response.json() })
        .then(data => { 
          const tabla = document.querySelector("#tabla-productos tbody");
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
              </tr>
            `;
          });
         })
        .catch(error => { console.error(error) });
    }

    document.addEventListener("DOMContentLoaded", obtenerDatos());
  </script>

</body>

</html>