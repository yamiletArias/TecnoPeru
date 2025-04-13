<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <div class="container">
    <div class="card mt-3">
      <div class="card-header">
        <div class="row">
          <div class="col"><strong>Lista de productos</strong></div>
          <div class="col text-end">
            <a href="../../index.html" class="btn btn-sm btn-secondary"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Regresar al
              dashboard</a>
            <a href="registrar.php" class="btn btn-sm btn-success"
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
            <!-- Aquí se cargarán los productos dinámicamente -->
          </tbody>
        </table>
      </div> <!-- ./card-body -->
    </div> <!-- ./card -->
  </div> <!-- ./container -->

  <script>
    const tbody = document.querySelector("#tabla-productos tbody");

    const datosEstaticos = [
      { marca: "Samsung", tipo: "Celular", descripcion: "Galaxy S22", precio: 3500, garantia: "12", nuevo: true },
      { marca: "Samsung", tipo: "Televisor", descripcion: "Smart TV 50", precio: 2200, garantia: "24", nuevo: false },
      { marca: "Lenovo", tipo: "Laptop", descripcion: "Lenovo 16ram", precio: 2800, garantia: "12", nuevo: true },
      { marca: "Samsung", tipo: "Audífonos", descripcion: "WH-1000XM5", precio: 1200, garantia: "6", nuevo: true },
      { marca: "Samsung", tipo: "Celular", descripcion: "Samsung 13", precio: 4600, garantia: "18", nuevo: true },
      { marca: "Lenovo", tipo: "Laptop", descripcion: "Lenovo 3", precio: 2500, garantia: "12", nuevo: false },
      { marca: "Samsung", tipo: "Refrigeradora", descripcion: "2 puertas, 300L", precio: 1900, garantia: "36", nuevo: false },
      { marca: "Samsung", tipo: "Tablet", descripcion: "Samsung 10.4", precio: 1300, garantia: "12", nuevo: true },
      { marca: "Lenovo", tipo: "Laptop", descripcion: "Lenovo X512", precio: 2700, garantia: "24 ", nuevo: true },
    ];

    function cargarProductos() {
      const nuevosProductos = JSON.parse(localStorage.getItem("productos")) || [];

      const productosCombinados = datosEstaticos.concat(nuevosProductos);

      tbody.innerHTML = "";

      productosCombinados.forEach((producto, index) => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
          <td>${index + 1}</td>
          <td>${producto.marca}</td>
          <td>${producto.tipo}</td>
          <td>${producto.descripcion}</td>
          <td>${producto.precio}</td>
          <td>${producto.garantia}</td>
          <td>${producto.nuevo ? "Sí" : "No"}</td>
          <td>
            <a href='editar.php?id=${index}' class='btn btn-sm btn-info'><i class="fa-solid fa-pen"></i></a>
            <a href='#' data-idproducto='${index}' class='btn btn-sm btn-danger delete'><i class="fa-solid fa-trash"></i></a>
          </td>
        `;
        tbody.appendChild(fila);
      });

      document.querySelectorAll('.delete').forEach((btn) => {
        btn.addEventListener('click', function () {
          const idProducto = parseInt(this.getAttribute('data-idproducto'), 10);
          eliminarProducto(idProducto);
        });
      });
    }

    function eliminarProducto(indice) {
      const cantidadEstaticos = datosEstaticos.length;
      if (indice < cantidadEstaticos) {
        alert("No se puede eliminar un registro estático.");
        return;
      }

      if (!confirm("¿Desea eliminar este registro?")) {
        return;
      }

      const indiceRelativo = indice - cantidadEstaticos;

      let nuevosProductos = JSON.parse(localStorage.getItem("productos")) || [];

      // Eliminar el producto usando splice
      nuevosProductos.splice(indiceRelativo, 1);

      // Actualizar localStorage
      localStorage.setItem("productos", JSON.stringify(nuevosProductos));

      cargarProductos();
    }

    cargarProductos();
  </script>
</body>

</html>