<?php 
  if (!empty($alertas)){
    ?>
    <div class="card alerta-form">
    <?php
    if ($lenguaje !== 'cs-CZ') {
      foreach($alertas['en'] as $alerta) {
      ?>
      <p class="alerta error">
        <?php echo $alerta ?>
      </p>
      <?php
      }
    }
  }
  ?>
