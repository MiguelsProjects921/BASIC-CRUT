<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestor de Productos</title>
  <link rel="stylesheet" href="css/Style.css">
</head>
<body>
  <header>
    <h1 class="titulo-principal">Gestor de Productos</h1>
    <hr>
  </header>

  <main>
    <section>
      <h2>Lista de Productos</h2>
      <table class="tabla-productos">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Fecha de Ingreso</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tbody-productos">
          <tr>
            <td colspan="7" class="no-productos">No hay productos registrados</td>
          </tr>
        </tbody>
      </table>
    </section>

    <hr>

    <section>
      <h2>Registrar nuevo producto</h2>
      <form id="frmRegistrar">
        <p><label>Nombre:<br><input type="text" name="nombre" placeholder="Nombre" required></label></p>
        <p><label>Categoría:<br><input type="text" name="categoria" placeholder="Categoría" required></label></p>
        <p><label>Precio:<br><input type="number" step="0.01" name="precio" placeholder="Precio" required></label></p>
        <p><label>Stock:<br><input type="number" name="stock" placeholder="Stock" min="0" required></label></p>
        <p><label>Fecha de ingreso:<br><input type="date" name="fechaIngreso" required></label></p>
        <p><button type="submit">Registrar</button></p>
      </form>
    </section>

    <hr>

    <section id="formActualizarCont" class="oculto">
      <h2>Actualizar producto</h2>
      <form id="frmActualizar">
        <input type="hidden" name="idactualizar" id="id_up">
        <p><label>Nombre:<br><input type="text" name="nombre" id="nombre_up" placeholder="Nombre" required></label></p>
        <p><label>Categoría:<br><input type="text" name="categoria" id="categoria_up" placeholder="Categoría" required></label></p>
        <p><label>Precio:<br><input type="number" step="0.01" name="precio" id="precio_up" placeholder="Precio" required></label></p>
        <p><label>Stock:<br><input type="number" name="stock" id="stock_up" placeholder="Stock" min="0" required></label></p>
        <p><label>Fecha de ingreso:<br><input type="date" name="fechaIngreso" id="fechaIngreso_up" required></label></p>
        <p><button type="submit">Actualizar</button></p>
      </form>
    </section>
  </main>

  <footer>
    <hr>
    <p class="pie">&copy; 2025 - Proyecto Gestor de Productos</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="JS/Ajax.js"></script>
  <script src="JS/Generalidades.js"></script>
</body>
</html>
