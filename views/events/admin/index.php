

<div class="botonera-eventos">
<a href="/admin/events/create" class="boton">Create Event</a>
<a href="/admin" class="boton">Admin</a>

</div>

<div class="tabla-eventos">
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Date</th>
    <th>English</th>
    <th>Czech</th>
    <th>Actions</th>
  </tr>
<?php 
foreach ($eventos as $evento) {
?>
  
  <tr>
    <td><?php echo $evento->id; ?></td>
    <td><?php echo $evento->nombre; ?></td>
    <td><?php echo $evento->fecha; ?></td>
    <td><?php echo $evento->descripcionIngles; ?></td>
    <td><?php echo $evento->descripcionCheco; ?></td>
    <td>
        <form method="GET" action="/admin/events/update">
            <input type="text" name="id" id="actualizar" value="<?php echo $evento->id; ?>" hidden>
            <input class="boton-actualizar" type="submit" value="Update">
        </form>
        <form method="POST" action="/admin/events/delete">
            <input type="text" name="id" id="eliminar" value="<?php echo $evento->id; ?>" hidden>
            <input class="boton-eliminar" type="submit" value="Delete">
        </form>        
    </td>

<?php
}

?>
</table>
</div>

