const BASE_URL = "/Proyecto/index.php";

async function listarProductos() {
    try {
        const res = await fetch(`${BASE_URL}?ruta=listar`);
        const productos = await res.json();

        const tbody = document.getElementById("tbody-productos");
        tbody.innerHTML = "";

        if (Array.isArray(productos) && productos.length > 0) {
            productos.forEach(p => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${p.ID}</td>
                    <td>${p.Nombre}</td>
                    <td>${p.Categoria}</td>
                    <td>${p.Precio}</td>
                    <td>${p.Stock}</td>
                    <td>${p.FechaIngreso ?? ''}</td>
                    <td>
                        <button class="btn-eliminar" data-id="${p.ID}">Eliminar</button>
                        <button class="btn-actualizar" data-id="${p.ID}">Actualizar</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        } else {
            tbody.innerHTML = `
                <tr><td colspan="7">No hay productos registrados</td></tr>
            `;
        }
    } catch (err) {
        console.error("Error al listar productos:", err);
    }
}

document.addEventListener("DOMContentLoaded", listarProductos);

const frmRegistrar = document.getElementById('frmRegistrar');
if (frmRegistrar) {
    frmRegistrar.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch(`${BASE_URL}?ruta=insertar`, {
                method: 'POST',
                body: formData
            });

            const res = await response.json();

            if (res.status === 'success') {
                await Swal.fire('¡Éxito!', 'Producto registrado correctamente', 'success');
                frmRegistrar.reset();
                listarProductos();
            } else {
                Swal.fire('Error', res.message || 'No se pudo registrar', 'error');
            }
        } catch (err) {
            Swal.fire('Error', 'No se pudo registrar el producto', 'error');
            console.error(err);
        }
    });
}

document.addEventListener("click", async function (e) {
    if (e.target.classList.contains("btn-eliminar")) {
        const id = e.target.getAttribute("data-id");

        const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (result.isConfirmed) {
            try {
                const formData = new FormData();
                formData.append("id", id);

                const response = await fetch(`${BASE_URL}?ruta=eliminar`, {
                    method: 'POST',
                    body: formData
                });

                const res = await response.json();

                if (res.status === 'success') {
                    await Swal.fire('Eliminado', 'El producto fue eliminado', 'success');
                    listarProductos();
                } else {
                    Swal.fire('Error', res.message || 'No se pudo eliminar', 'error');
                }
            } catch (err) {
                Swal.fire('Error', 'No se pudo eliminar el producto', 'error');
                console.error(err);
            }
        }
    }
});

document.addEventListener("click", async function (e) {
    if (e.target.classList.contains("btn-actualizar")) {
        const id = e.target.getAttribute("data-id");

        try {
            const res = await fetch(`${BASE_URL}?ruta=listar`); 
            const productos = await res.json();
            const producto = productos.find(p => String(p.ID) === String(id));

            if (!producto) return;

            const { value: formValues } = await Swal.fire({
                title: 'Actualizar producto',
                html: `
                    <input id="swal-nombre" class="swal2-input" placeholder="Nombre" value="${producto.Nombre}">
                    <input id="swal-categoria" class="swal2-input" placeholder="Categoría" value="${producto.Categoria}">
                    <input id="swal-precio" class="swal2-input" placeholder="Precio" type="number" step="0.01" value="${producto.Precio}">
                    <input id="swal-stock" class="swal2-input" placeholder="Stock" type="number" value="${producto.Stock}">
                    <input id="swal-fechaIngreso" class="swal2-input" placeholder="Fecha Ingreso" type="date" value="${producto.FechaIngreso ?? ''}">
                `,
                focusConfirm: false,
                preConfirm: () => {
                    return {
                        idactualizar: producto.ID,
                        nombre: document.getElementById('swal-nombre').value,
                        categoria: document.getElementById('swal-categoria').value,
                        precio: document.getElementById('swal-precio').value,
                        stock: document.getElementById('swal-stock').value,
                        fechaIngreso: document.getElementById('swal-fechaIngreso').value
                    };
                }
            });

            if (formValues) {
                const response = await fetch(`${BASE_URL}?ruta=actualizar`, {
                    method: 'POST',
                    body: new URLSearchParams(formValues)
                });

                const res = await response.json();

                if (res.status === 'success') {
                    await Swal.fire('Actualizado', 'El producto fue actualizado', 'success');
                    listarProductos();
                } else {
                    Swal.fire('Error', res.message || 'No se pudo actualizar', 'error');
                }
            }
        } catch (err) {
            Swal.fire('Error', 'No se pudo obtener el producto', 'error');
            console.error(err);
        }
    }
});
