<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <div class="column-responsive column-90">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Registro de Usuarios') ?></legend>
                <?php
                    echo $this->Form->control('identity', ['label' => 'Cédula']);
                    echo $this->Form->control('fullname', ['label' => 'Nombre Completo']);
                    echo $this->Form->control('email', ['label' => 'Correo Electrónico']);
                    echo $this->Form->control('password', ['label' => 'Contraseña']);
                    if($current_user['role'] === 'superadmin') :
                        echo $this->Form->control('role', ['label' => 'Rol', 'options' => [
                            'superadmin' => 'Super Administrador',
                            'admin' => 'Administrador',
                            'usuario' => 'Usuario',
                        ]]);
                    else :
                        echo $this->Form->control('role', ['label' => 'Rol', 'options' => [
                            'usuario' => 'Usuario',
                        ]]);
                    endif;
                    echo $this->Form->control('department', ['label' => 'Departamento']);
                    // echo $this->Form->control('user_id', ['label' => 'Supervisor', 'options' => $users, 'default' => $current_user['fullname']]);
                    echo $this->Form->control('user_id', ['label' => 'Supervisor', 'options' => [
                        $current_user['id'] => $current_user['fullname']
                    ]]);
                    echo $this->Form->control('salary', ['label' => 'Valor por Hora']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Crear Usuario')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
