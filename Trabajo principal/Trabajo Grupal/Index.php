<?php
// Index.php - Interfaz básica para "Trabajo Grupal"
session_start();
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Manejo simple de formulario para agregar tareas
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_title'])) {
    $title = trim(filter_var($_POST['task_title'], FILTER_SANITIZE_STRING));
    $desc  = trim(filter_var($_POST['task_desc'], FILTER_SANITIZE_STRING));
    if ($title !== '') {
        $_SESSION['tasks'][] = [
            'title' => $title,
            'desc'  => $desc,
            'created' => date('Y-m-d H:i:s')
        ];
        $mensaje = 'Tarea agregada correctamente.';
    } else {
        $mensaje = 'El título es obligatorio.';
    }
}

// Nombre de usuario demo (puede venir de login real)
$user = 'Invitado';
if (isset($_GET['user'])) {
    $user = htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Trabajo Grupal - Interfaz</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding-top: 56px; }
    .sidebar { min-width: 220px; max-width: 220px; }
    @media (max-width: 991.98px) {
      .sidebar { display: none; }
    }
    .content { padding: 20px; }
    .card-compact { margin-bottom: 1rem; }
  </style>
</head>
<body>
  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Trabajo Grupal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Proyectos</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Tareas</a></li>
        </ul>
        <div class="d-flex">
          <span class="navbar-text me-3">Hola, <?php echo $user; ?></span>
          <a class="btn btn-outline-light btn-sm" href="?">Cerrar</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <aside class="col-lg-2 sidebar bg-light border-end vh-100 position-fixed">
        <div class="p-3">
          <h6 class="text-muted">Menú</h6>
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#">Resumen</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Equipo</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Calendario</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Archivos</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Configuración</a></li>
          </ul>
        </div>
      </aside>

      <!-- Contenido principal -->
      <main class="col-lg-10 offset-lg-2 content">
        <?php if ($mensaje): ?>
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <h2>Panel de control</h2>
          <div>
            <a href="#newTask" class="btn btn-primary me-2">Nueva tarea</a>
            <a href="#" class="btn btn-outline-secondary">Exportar</a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-7">
            <div class="card card-compact">
              <div class="card-body">
                <h5 class="card-title">Bienvenido, <?php echo $user; ?>.</h5>
                <p class="card-text">Aquí puedes consultar tus proyectos, crear tareas y colaborar con el equipo.</p>
                <div class="row">
                  <div class="col-6">
                    <div class="border p-2 mb-2">
                      <strong><?php echo count($_SESSION['tasks']); ?></strong>
                      <div class="text-muted small">Tareas</div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="border p-2 mb-2">
                      <strong>--</strong>
                      <div class="text-muted small">Miembros</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla de tareas -->
            <div class="card card-compact">
              <div class="card-body">
                <h6 class="card-title">Tareas recientes</h6>
                <div class="table-responsive">
                  <table class="table table-sm table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Creada</th>
                        <th>Descripción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (empty($_SESSION['tasks'])): ?>
                        <tr><td colspan="4" class="text-muted">No hay tareas todavía.</td></tr>
                      <?php else: ?>
                        <?php foreach (array_reverse($_SESSION['tasks']) as $i => $t): ?>
                          <tr>
                            <td><?php echo count($_SESSION['tasks']) - $i; ?></td>
                            <td><?php echo htmlspecialchars($t['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($t['created'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($t['desc'], ENT_QUOTES, 'UTF-8'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>

          <div class="col-md-5">
            <!-- Formulario para nueva tarea -->
            <div id="newTask" class="card card-compact">
              <div class="card-body">
                <h6 class="card-title">Crear nueva tarea</h6>
                <form method="post" action="#newTask">
                  <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="task_title" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="task_desc" class="form-control" rows="4"></textarea>
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Guardar</button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Atajos -->
            <div class="card mt-3">
              <div class="card-body">
                <h6 class="card-title">Atajos</h6>
                <div class="d-grid gap-2">
                  <a class="btn btn-outline-primary" href="#">Crear proyecto</a>
                  <a class="btn btn-outline-secondary" href="#">Invitar miembro</a>
                  <a class="btn btn-outline-warning" href="#">Revisar pendientes</a>
                </div>
              </div>
            </div>

          </div>
        </div>

        <footer class="mt-4 text-muted small">
          &copy; <?php echo date('Y'); ?> Trabajo Grupal — Interfaz demo
        </footer>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>