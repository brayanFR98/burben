<?php
require_once("../../conexion/conexion.php");

$query = "SELECT *, if(notes = '', 'N/A', notes) notesValidation
FROM usuarios u 
WHERE name LIKE '%%'
ORDER BY u.name;";

$result = mysqli_query($conexion, $query);

while ($registro = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?= $registro["name"] ?></td>
        <td><?= $registro["telephone"] ?></td>
        <td><?= $registro["email"] ?></td>
        <td><?= $registro["rfc"] ?></td>
        <td><?= $registro["notesValidation"] ?></td>
        <td>
            <button class="editar btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="<?= $registro["oid"] ?>">Editar</button>
            <button class="borrar btn btn-danger btn-sm" data-id="<?= $registro["oid"] ?>">Eliminar</button>
        </td>
    </tr>

    <?php
}
mysqli_close($conexion);
?>