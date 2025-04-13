<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>

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
            <div class="col"><strong>Nuevo producto</strong></div>
            <div class="col text-end"><a href="listar.php" class="btn btn-sm btn-outline-success"
                style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Mostrar
                lista</a></div>
          </div>
        </div>
        <div class="card-body">

          <div class="form-floating mb-2">
            <select name="marcas" id="marcas" class="form-select" required autofocus>
              <option value="">Seleccione</option>
              <option value="1">Samsung</option>
              <option value="2">Lenovo</option>
              <option value="3">Epson</option>
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
                <input type="number" value="6" min="0" max="48" step="3" class="form-control text-center" id="garantia"
                  placeholder="Garantía" required>
                <label for="garantia">Garantía</label>
              </div>
            </div>
          </div>

          <div class="form-floating">
            <select name="condicion" id="condicion" class="form-select">
              <option value="S" selected>Producto nuevo</option>
              <option value="N">Semi nuevo</option>
            </select>
            <label for="condicion">Condición del producto</label>
          </div>

        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
          <button class="btn btn-secondary btn-sm" type="reset">Cancelar</button>
        </div>
      </div> <!-- ./card -->
    </form>

  </div> <!-- ./container -->

  <script>
  const marcasMap = {
    "1": "Samsung",
    "2": "Lenovo",
    "3": "Epson"
  };

  document.getElementById("formulario-registro").addEventListener("submit", function (e) {
    e.preventDefault();

    const marcaId = document.getElementById("marcas").value;
    const marca = marcasMap[marcaId] || ""; 
    const tipo = document.getElementById("tipo").value;
    const descripcion = document.getElementById("descripcion").value;
    const precio = document.getElementById("precio").value;
    const garantia = document.getElementById("garantia").value;
    const condicion = document.getElementById("condicion").value;
    
    // Convertir a boolean: si el valor es "S" se interpreta como true
    const nuevo = (condicion === "S");

    const producto = {
      marca,    
      tipo,
      descripcion,
      precio,
      garantia,
      nuevo
    };

    //productos guardados en localStorage
    let productos = JSON.parse(localStorage.getItem("productos")) || [];
    productos.push(producto);
    localStorage.setItem("productos", JSON.stringify(productos));

    alert("Producto registrado con éxito");

    setTimeout(() => {
      window.location.href = "listar.php";
    }, 1500);
  });
</script>

</body>
</html>