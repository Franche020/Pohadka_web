

<div class="botonera-habitaciones">
<a href="/admin/acommodation/create" class="boton">Create acommodation</a>
<a href="/admin" class="boton">Admin</a>

</div>

<div class="tabla-habitaciones">
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>English</th>
    <th>Czech</th>
    <th>Capacity</th>
    <th>Price €</th>
    <th>Type</th>
    <th>Castle Room</th>
  </tr>

<?php 
foreach ($habitaciones as $habitacion) {
?>

  <tr>
    <td><?php echo $habitacion->id; ?></td>
    <td><?php echo $habitacion->nombre; ?></td>
    <td><?php echo $habitacion->descripcionIngles; ?></td>
    <td><?php echo $habitacion->descripcionCheco; ?></td>
    <td><?php echo $habitacion->capacidad; ?></td>
    <td><?php echo $habitacion->precio; ?></td>
    <td><?php echo $habitacion->tipo; ?></td>
    <td><?php echo $habitacion->castillo; ?></td>
    <td>
        <form method="GET" action="/admin/acommodation/update">
            <input type="text" name="id" id="actualizar" value="<?php echo $habitacion->id; ?>" hidden>
            <input class="boton-actualizar" type="submit" value="Update">
        </form>
        <form method="POST" action="/admin/acommodation/delete">
            <input type="text" name="id" id="eliminar" value="<?php echo $habitacion->id; ?>" hidden>
            <input class="boton-eliminar" type="submit" value="Delete">
        </form>        
    </td>

<?php
}

?>
</table>
</div>