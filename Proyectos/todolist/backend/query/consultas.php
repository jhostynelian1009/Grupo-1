<?php 
include '../dbconexion/dbconexion.php';

class consultas {

    // FUNCION MOSTRAR ACTIVIDADES
    public static function mostrarActividad() {
        $conn = dbactividades::conectar();
        $query = "SELECT * FROM actividades";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // FUNCION CREAR ACTIVIDAD
    public static function crearActividad($actividad, $descripcion, $estado) {
        $conn = dbactividades::conectar();
        $query = "INSERT INTO actividades (actividad, descripcion, estado) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $actividad);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $estado);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return json_encode(['success' => true, 'message' => 'Actividad creada correctamente']);
        } else {
            return json_encode(['success' => false, 'message' => 'Error al crear la actividad']);
        }
    }

    // FUNCION ELIMINAR ACTIVIDAD
    public static function eliminarActividad($id) {
        $conn = dbactividades::conectar();
        $query = "DELETE FROM actividades WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return json_encode(['success' => true, 'message' => 'Actividad eliminada correctamente']);
        } else {
            return json_encode(['success' => false, 'message' => 'Error al eliminar la actividad']);
        }
    }

    // FUNCION EDITAR ACTIVIDAD
    public static function editarActividad($id, $actividad, $descripcion, $estado) {
        $conn = dbactividades::conectar();
        $query = "UPDATE actividades SET actividad = ?, descripcion = ?, estado = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $actividad);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $estado);
        $stmt->bindParam(4, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return json_encode(['success' => true, 'message' => 'Actividad actualizada correctamente']);
        } else {
            return json_encode(['success' => false, 'message' => 'No se realizaron cambios']);
        }
    }

    // FUNCION OBTENER ACTIVIDAD POR ID
    public static function obtenerActividadPorId($id) {
        $conn = dbactividades::conectar(); // 🔧 corregido (antes tenías db_actividades)
        $query = "SELECT * FROM actividades WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $actividad = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($actividad) {
            return json_encode(['success' => true, 'data' => $actividad]);
        } else {
            return json_encode(['success' => false, 'message' => 'Actividad no encontrada']);
        }
    }

    // FUNCION AGREGAR OBSERVACION
    public static function agregarObservacion($id, $observacion) {
        $conn = dbactividades::conectar(); // 🔧 corregido (antes tenías db_actividades)
        $query = "UPDATE actividades SET observacion = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $observacion);
        $stmt->bindParam(2, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return json_encode(['success' => true, 'message' => 'Observación agregada correctamente']);
        } else {
            return json_encode(['success' => false, 'message' => 'Error al agregar la observación']);
        }
    }
}
?>
