<?php require_once('../html/head2.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Basic Bootstrap Table -->
<div class="card">
    <button type="button" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#ModalUsuarios">Nuevo Usuario</button>

    <h5 class="card-header">Lista de Usuarios</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo electronico</th>
                    <th>Fecha de registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaUsuarios">

            </tbody>
        </table>
    </div>
</div>

<!-- Modal Libros-->
<style>
    .swal2-container {
        z-index: 999999;
    }
</style>

<div class="modal" tabindex="-1" id="ModalUsuarios">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Insertar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_usuarios" method="post">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Ingrese el nombre de usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese el apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo electronico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" placeholder="Ingrese el correo electronico" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_registro">Fecha de registro</label>
                        <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" placeholder="Ingrese la fecha de registro" required>
                    </div>    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="LimpiarCajas()">Cerrar</button>

                    
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/scripts2.php') ?>

<script src="./usuarios.js"></script>

