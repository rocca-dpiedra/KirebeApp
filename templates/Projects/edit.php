<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 */
?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <div class="column-responsive column-90">
        <div class="projects form content">
            <?= $this->Form->create($project,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edición de Proyecto') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nombre']);
                    echo $this->Form->control('description', ['label' => 'Descripción']);
                    echo $this->Form->control('image_file', ['type' => 'file','label' => 'Imagen']);
                    echo '<p> Para una adecuada compatibilidad escoger una imagen simétrica: Resolución Ejemplo: 1024 * 1024 </p>';
                    echo $this->Form->control('department', ['label' => 'Departamento']);
                    echo $this->Form->control('subsidiary', ['label' => 'Subsidiaria', 'readonly']);
                    echo $this->Form->control('price', ['label' => 'Valor']);
                    echo $this->Form->control('status', ['label' => 'Proyecto Activo']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Actualizar Proyecto')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
