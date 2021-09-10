<!--//Comentario Darío ***********************************************************
Este Archivo es creado para mostrar la barra lateral de forma dinámica, en cada una de las 
pantallas / vistas que tendrá el usuario a su disposición -->

<!-- La implementación de este archivo se realizará acabo en las vistas de cada BD. -->

<?= $this->Html->css(['sidebar']) ?>


<div class="side-nav">
    <div>
        <h4 class="heading"><?= __('Acciones Rápidas') ?></h4>
        <!-- Es importante tomar en cuenta, que los links que se están creando son dinámicos, porque 
        obtienen el typo de "controllador", basados en la vista en la cual se encuentra.
        De esta forma, cambiaran su valor dependiendo de la vista en la que se ubiquen. -->
        <?php if($current_user['role'] !== 'usuario'): ?>
        <?= $this->Html->link(__('Nuevo: ' .$type), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        <?php endif; ?>
        <?= $this->Html->link(__('Lista de: ' .$types), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>

    <div class="activo">
        <?php if($activo) : ?>
            <h4 class="heading"><?= __('Sesión Activa') ?></h4>
            <div class="proyecto-activo">
                <div class="inicio">
                    <p> Hora de Inicio: </p>
                    <p class="horaInicio"><?= $registro['starttime'] ?></p>
                </div>
                <div class="transcurrido">
                    <p> Tiempo Activo:  </p>
                    <p class="stTime"> </p>
                </div>
            </div>
        <?php  endif ; ?>
    </div>
</div>