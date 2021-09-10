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
                <legend><?= __('Edit User') ?></legend>
                <?php
                    echo $this->Form->control('identity', ['label' => 'Cédula']);
                    echo $this->Form->control('fullname', ['label' => 'Nombre Completo']);
                    echo $this->Form->control('email', ['label' => 'Correo Electrónico']);
                    if($current_user['role'] == 'superadmin') :
                        echo $this->Form->control('password', ['label' => 'Contraseña']);
                    endif;
                    if($current_user['role'] === 'superadmin') :
                        echo $this->Form->control('role', ['label' => 'Rol', 'options' => [
                            'superadmin' => 'Super Administrador',
                            'admin' => 'Administrador',
                            'usuario' => 'Usuario',
                        ]]);
                    else :
                        if($current_user['id'] == $user->id):
                            echo $this->Form->control('role', ['label' => 'Rol', 'options' => [
                                'admin' => 'Administrador',
                                'usuario' => 'Usuario',
                            ]]);
                        else:
                            echo $this->Form->control('role', ['label' => 'Rol', 'options' => [
                                'usuario' => 'Usuario',
                            ]]);
                        endif;
                    endif;
                    echo $this->Form->control('department', ['label' => 'Departamento']);
                    // echo $this->Form->control('user_id', ['label' => 'Supervisor', 'options' => $users, 'default' => $current_user['fullname']]);
                    echo $this->Form->control('salary', ['label' => 'Valor por Hora']);
                    echo $this->Form->control('status',['label' => 'Usuario Activo']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Actualizar Usuario')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
