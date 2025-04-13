<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar producto</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <form action="" autocomplete="off" id="formulario-registro">
      <div class="card mt-3">
        <div class="card-header">
          <div class="row">
            <div class="col"><strong>Actualizar producto</strong></div>
            <div class="col text-end">
              <a href="listar.php" class="btn btn-sm btn-outline-success" 
                 style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                Mostrar lista
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Cambiamos los valores del <select> para que sean nombres -->
          <div class="form-floating mb-2">
            <select name="marcas" id="marcas" class="form-select" required autofocus>
              <option value="">Seleccione</option>
              <option value="Samsung">Samsung</option>
              <option value="Lenovo">Lenovo</option>
              <option value="Epson">Epson</option>
            </select>
            <label for="marcas">Marca del producto</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="tipo" placeholder="Tipo" required>
            <label for="tipo">Tipo</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="descripcion" placeholder="Descripción" required>
            <label for="descripcion">Descripción</label>
          </div>

          <div class="row g-2">
            <div class="col">
              <div class="form-floating mb-2">
                <input type="text" class="form-control text-end" id="precio" placeholder="Precio" required>
                <label for="precio">Precio</label>
              </div>
            </div>
            <div class="col">
              <div class="form-floating mb-2">
                <input type="number" value="6" min="0" max="48" step="3" class="form-control text-center" id="garantia" placeholder="Garantía" required>
                <label for="garantia">Garantía</label>
              </div>
            </div>
          </div>

          <!-- Usamos "S" para nuevo y "N" para semi nuevo -->
          <div class="form-floating">
            <select name="condicion" id="condicion" class="form-select">
              <option value="S" selected>Producto nuevo</option>
              <option value="N">Semi nuevo</option>
            </select>
            <label for="condicion">Condición del producto</label>
          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary btn-sm" id="btnActualizar" type="submit">Actualizar</button>
          <button class="btn btn-secondary btn-sm" type="reset">Cancelar</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    // Definimos la cantidad de registros estáticos (en este ejemplo, 10)
    const cantidadEstaticos = 9;
    const urlParams = new URLSearchParams(window.location.search);
    const idParam = urlParams.get("id");
    const indice = parseInt(idParam, 9);
    if (indice < cantidadEstaticos) {
      alert("No se puede editar un registro estático.");
      window.location.href = "listar.php";
    }
    const indiceRelativo = indice - cantidadEstaticos;

    const productosGuardados = JSON.parse(localStorage.getItem("productos")) || [];
    if (indiceRelativo < 0 || indiceRelativo >= productosGuardados.length) {
      alert("Producto no encontrado.");
      window.location.href = "listar.php";
    }

    let producto = productosGuardados[indiceRelativo];

    document.getElementById("marcas").value = producto.marca;
    document.getElementById("tipo").value = producto.tipo;
    document.getElementById("descripcion").value = producto.descripcion;
    document.getElementById("precio").value = producto.precio;
    document.getElementById("garantia").value = producto.garantia;
    document.getElementById("condicion").value = producto.nuevo ? "S" : "N";

    document.getElementById("formulario-registro").addEventListener("submit", function(e) {
      e.preventDefault();

      const marca = document.getElementById("marcas").value;
      const tipo = document.getElementById("tipo").value;
      const descripcion = document.getElementById("descripcion").value;
      const precio = document.getElementById("precio").value;
      const garantia = document.getElementById("garantia").value;
      const condicion = document.getElementById("condicion").value;
      const nuevo = (condicion === "S");

      const productoActualizado = {
        marca,
        tipo,
        descripcion,
        precio,
        garantia,
        nuevo
      };

      productosGuardados[indiceRelativo] = productoActualizado;
      localStorage.setItem("productos", JSON.stringify(productosGuardados));

      alert("Producto actualizado con éxito.");
      window.location.href = "listar.php";
    });
  </script>
</body>
</html>
