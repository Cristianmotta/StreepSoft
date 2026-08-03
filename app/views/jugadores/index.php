<?php
declare (strict_types=1);
Auth::requerirLogin();
?>

<?php require_once __DIR__ . '/../../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../../layouts/navbar.php'; ?>

<div class="container-fluid py-4">

    <!-- ENCABEZADO + 4 BOTONES -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Gestión de Jugadores</h4>
        <div class="d-flex gap-2">

            <!-- AÑADIR -->
            <a href="<?= BASE_URL ?>jugadores/create" 
               class="btn btn-primary d-flex flex-column align-items-center p-3">
                <i class="bi bi-person-plus-fill fs-4"></i>
                <small>Añadir</small>
            </a>

            <!-- VER -->
            <a href="<?= BASE_URL ?>jugadores" 
               class="btn btn-info d-flex flex-column align-items-center p-3">
                <i class="bi bi-eye-fill fs-4"></i>
                <small>Visualizar</small>
            </a>

            <!-- EDITAR -->
            <a href="#" 
               class="btn btn-warning d-flex flex-column align-items-center p-3"
               id="btnEditar">
                <i class="bi bi-pencil-fill fs-4"></i>
                <small>Actualizar</small>
            </a>

            <!-- DESACTIVAR -->
            <a href="#" 
               class="btn btn-danger d-flex flex-column align-items-center p-3"
               id="btnDesactivar">
                <i class="bi bi-person-x-fill fs-4"></i>
                <small>Desactivar</small>
            </a>

        </div>
    </div>

    <!-- MENSAJES -->
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if(isset($exito)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($exito) ?></div>
    <?php endif; ?>

    <!-- TABLA DE JUGADORES -->
    <div class="card shadow">
        <div class="card-body">

            <!-- BUSCADOR -->
            <div class="mb-3">
                <input 
                    type="text" 
                    id="buscador"
                    class="form-control" 
                    placeholder="Buscar por nombre, apellido, documento o instructor..."
                >
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaJugadores">
                    <thead class="table-dark">
                        <tr>
                            <th>Foto</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Documento</th>
                            <th>Categoría</th>
                            <th>Instructor</th>
                            <th>Beca</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($jugadores)): ?>
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    No hay jugadores registrados.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($jugadores as $jugador): ?>
                                <tr>
                                    <!-- FOTO -->
                                    <td>
                                        <img 
                                            src="<?= BASE_URL ?>assets/img/jugadores/<?= htmlspecialchars($jugador['foto'] ?? 'default.png') ?>" 
                                            alt="Foto"
                                            width="45" 
                                            height="45"
                                            class="rounded-circle object-fit-cover"
                                        >
                                    </td>

                                    <!-- DATOS -->
                                    <td><?= htmlspecialchars($jugador['apellido']) ?></td>
                                    <td><?= htmlspecialchars($jugador['nombre']) ?></td>
                                    <td><?= htmlspecialchars($jugador['documento']) ?></td>
                                    <td><?= htmlspecialchars($jugador['categoria_nombre'] ?? '—') ?></td>
                                    <td><?= htmlspecialchars($jugador['instructor_nombre'] ?? '—') ?></td>

                                    <!-- BECA -->
                                    <td>
                                        <?php if($jugador['tipo_beca'] === 'beca_completa'): ?>
                                            <span class="badge bg-success">Beca completa</span>
                                        <?php elseif($jugador['tipo_beca'] === 'media_beca'): ?>
                                            <span class="badge bg-warning text-dark">Media beca</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Sin beca</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- ESTADO -->
                                    <td>
                                        <?php if($jugador['estado'] === 'activo'): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php elseif($jugador['estado'] === 'inactivo'): ?>
                                            <span class="badge bg-warning text-dark">Inactivo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Retirado</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- ACCIONES -->
                                    <td>
                                        <div class="d-flex gap-1">

                                            <!-- VER PERFIL -->
                                            <a href="<?= BASE_URL ?>jugadores/show/<?= $jugador['id'] ?>" 
                                               class="btn btn-info btn-sm"
                                               title="Ver perfil">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- EDITAR -->
                                            <a href="<?= BASE_URL ?>jugadores/edit/<?= $jugador['id'] ?>" 
                                               class="btn btn-warning btn-sm"
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- DESACTIVAR -->
                                            <form method="POST" 
                                                  action="<?= BASE_URL ?>jugadores/desactivar/<?= $jugador['id'] ?>"
                                                  onsubmit="return confirm('¿Estás seguro de desactivar este jugador?')">
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm"
                                                        title="Desactivar"
                                                        <?= $jugador['estado'] === 'inactivo' ? 'disabled' : '' ?>>
                                                    <i class="bi bi-person-x"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT BUSCADOR -->
<script>
document.getElementById('buscador').addEventListener('keyup', function() {
    const termino  = this.value.toLowerCase();
    const filas    = document.querySelectorAll('#tablaJugadores tbody tr');

    filas.forEach(fila => {
        const texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(termino) ? '' : 'none';
    });
});
</script>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>