<?php require_once('../html/head2.php')  ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Basic Bootstrap Table -->
<div class="card">
    <button type="button" class="btn btn-outline-secondary" onclick="usuarios()" data-bs-toggle="modal" data-bs-target="#ModalPublicaciones">Nueva Publicacion</button>

    <h5 class="card-header">Lista de Publicaciones</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Contenido</th>
                    <th>Fecha de publicacion </th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaPublicaciones">

            </tbody>
        </table>
    </div>
</div>

<!-- Modal Prestamos-->
<style>
    .swal2-container {
        z-index: 999999;
    }
</style>

<div class="modal" tabindex="-1" id="ModalPublicaciones">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Insertar Publicacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_publicaciones" method="post">
                <input type="hidden" name="post_id" id="post_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">Usuario</label>
                        <select name="user_id" id="user_id" class="form-control"  required></select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contenido">Contenido</label>
                        <input type="text" name="contenido" id="contenido" class="form-control" placeholder="Ingrese el contenido" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_publicacion">fecha publicacion </label>
                        <input type="date" name="fecha_publicacion" id="fecha_publicacion" class="form-control" placeholder="Ingrese la fecha de publicacion" required>
                    </div>
                    
                
                <div class="modal-footer">
                    <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="LimpiarCajas()">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/scripts2.php') ?>

<script src="./publicaciones.js"></script>
