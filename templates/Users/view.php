<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <div class="column-responsive column-90">
        <div class="users view content">
            <h3>Detalles de usuario: <?= h($user->fullname) ?></h3>
            <table class="tabla">
                <tr>
                    <th><?= __('Cédula') ?></th>
                    <td><?= h($user->identity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre Completo') ?></th>
                    <td><?= h($user->fullname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Correo Electrónico') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rol') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Departamento') ?></th>
                    <td><?= h($user->department) ?></td>
                </tr>

                <?php
                    foreach($supervisor as $value){
                        if($value->id == $user->user_id){
                            ?>
                            <tr>
                                <th><?= __('Supervisor') ?></th>
                                <td>
                                    <?php echo $value->fullname; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                 ?>
                <!-- <tr>
                    <th><?= __('Supervisor') ?></th>
                    <td><?= $this->Number->format($user->user_id) ?></td>
                </tr> -->
                <tr>
                    <th><?= __('Valor por Hora') ?></th>
                    <td><?= $this->Number->format($user->salary) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $user->status ? __('Activo') : __('Inactivo'); ?></td>
                </tr>
            </table>
            <div class="related">
            <h4><?= __('Usuarios Relacionados') ?></h4>
                <?php if (!empty($user->users)) : ?>
                    <div class="table-responsive">
                        <table class="tabla">
                            <tr>
                                <th><?= __('Identity') ?></th>
                                <th><?= __('Fullname') ?></th>
                                <th><?= __('Email') ?></th>
                                <th><?= __('Role') ?></th>
                                <th><?= __('Department') ?></th>
                                <th><?= __('User Id') ?></th>
                                <th><?= __('Salary') ?></th>
                                <th><?= __('Status') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($user->users as $users) : ?>
                                <tr>
                                    <td><?= h($users->identity) ?></td>
                                    <td><?= h($users->fullname) ?></td>
                                    <td><?= h($users->email) ?></td>
                                    <td><?= h($users->role) ?></td>
                                    <td><?= h($users->department) ?></td>
                                    <td><?= h($users->user_id) ?></td>
                                    <td><?= h($users->salary) ?></td>
                                    <td><?= h($users->status) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Proyectos Relacionados') ?></h4>
                <?php if (!empty($user->projects)) : ?>
                <div class="table-responsive">
                    <table class="tabla">
                        <tr>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Descripción') ?></th>
                            <th><?= __('Departamento') ?></th>
                            <th><?= __('Subsidiaria') ?></th>
                            <th><?= __('Status') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->projects as $projects) : ?>
                        <tr>
                            <td><?= h($projects->name) ?></td>
                            <td><?= h($projects->description) ?></td>
                            <td><?= h($projects->department) ?></td>
                            <td><?= h($projects->subsidiary) ?></td>
                            <td><?= $projects->status ? __('Activo') : __('Inactivo'); ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id], ['class' => 'ver']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id],['class' => 'editar']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Sesiones Relacionadas') ?></h4>
                <?php if (!empty($user->timelogs)) : ?>
                <div class="table-responsive">
                <table class="tabla">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Proyecto') ?></th>
                            <th><?= __('Fecha') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Hora Inicio') ?></th>
                            <th><?= __('Hora Cierre') ?></th>
                            <th><?= __('Transcurrido') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->timelogs as $timelogs) : ?>
                        <tr>
                            <td><?= h($timelogs->id) ?></td>
                            <td><?= h($timelogs->project_id) ?></td>
                            <td><?= h($timelogs->date) ?></td>
                            <td><?= $timelogs->status ? __('Activa') : __('Finalizada'); ?></td>
                            <td><?= h($timelogs->starttime) ?></td>
                            <td><?= h($timelogs->endtime) ?></td>
                            <td><?= h($timelogs->elapsedtime) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Timelogs', 'action' => 'view', $timelogs->id], ['class' => 'ver']) ?>
                                <?php if($current_user['role'] == 'superadmin') : ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Timelogs', 'action' => 'edit', $timelogs->id],['class' => 'editar']) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
