<?php
include 'conexion.php';
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $cedula = trim($_POST['cedula'] ?? '');
    if ($nombre !== '' && $cedula !== '') {
        $stmt = $conn->prepare("INSERT INTO datos (nombre, cedula) VALUES (?, ?)");
        $stmt->bind_param('ss', $nombre, $cedula);
        if ($stmt->execute()) {
            $mensaje = '<p style="color:green;">Usuario insertado correctamente.</p>';
        } else {
            $mensaje = '<p style="color:red;">Error al insertar usuario: ' . htmlspecialchars($stmt->error) . '</p>';
        }
        $stmt->close();
    } else {
        $mensaje = '<p style="color:red;">Por favor, completa todos los campos.</p>';
    }
}
header('Location: hola.php?mensaje=' . urlencode($mensaje));
exit;
?>
