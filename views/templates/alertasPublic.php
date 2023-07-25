<?php
if (!empty($alertas)) {
    if (!empty($alertas['error'])) {
                ?>
        <div class="alerta-form">
            <?php

            if ($lenguaje !== 'cs-CZ') {
                foreach ($alertas['error']['en'] as $alerta) {
                     ?>
                    <p class="alerta error">
                        <?php echo $alerta ?>
                    </p>
                <?php
                }
            } else {
                foreach ($alertas['error']['cz'] as $alerta) {
                ?>
                    <p class="alerta error">
                        <?php echo $alerta ?>
                    </p>
                     <?php
                }
            }
    } elseif (!empty($alertas['exito'])) {
            ?>
        <div class="alerta-form">
            <?php

            if ($lenguaje !== 'cs-CZ') {
                foreach ($alertas['exito']['en'] as $alerta) {
                    ?>
                    <p class="alerta exito">
                        <?php echo $alerta ?>
                    </p>
                <?php
                }
            } else {
                foreach ($alertas['exito']['cz'] as $alerta) {
                ?>
                    <p class="alerta exito">
                        <?php echo $alerta ?>
                    </p>
                        <?php
                }
            }
    }
            ?>
            </div> <?php
}?>