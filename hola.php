
<?php
include 'conexion.php';
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
$sql = "SELECT id, nombre, cedula FROM datos";
$result = $conn->query($sql);
$usuarios = array();
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}
echo "<html><body><h1>Usuarios</h1>";
echo $mensaje;
echo '<form method="post" action="insertar.php">
    <label>Nombre: <input type="text" name="nombre" required></label>
    <label>Cédula: <input type="text" name="cedula" required></label>
    <button type="submit">Agregar usuario</button>
</form><br>';
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nombre</th><th>Cédula</th><th>Acción</th></tr>";
if (count($usuarios) > 0) {
    foreach ($usuarios as $row) {
        echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['nombre']) . "</td><td>" . htmlspecialchars($row['cedula']) . "</td>";
        echo '<td><a href="eliminar.php?id=' . $row['id'] . '" onclick="return confirm(\'¿Seguro que deseas eliminar este usuario?\')">Eliminar</a></td></tr>';
    }
} else {
    echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
}
echo "</table></body></html>";
$conn->close();
?>
