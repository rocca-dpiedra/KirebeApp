<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="row">
    <div class="column-responsive column-90">
        <div class="users index content">
            <h3><?= __('Lista de Usuarios') ?></h3>
            <div class="table-responsive">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', ['label' => 'Id']) ?></th>
                            <th><?= $this->Paginator->sort('identity', ['label' => 'Cédula']) ?></th>
                            <th><?= $this->Paginator->sort('fullname', ['label' => 'Nombre']) ?></th>
                            <th><?= $this->Paginator->sort('email', ['label' => 'Correo']) ?></th>
                            <th><?= $this->Paginator->sort('role', ['label' => 'Rol']) ?></th>
                            <th><?= $this->Paginator->sort('department', ['label' => 'Departamento']) ?></th>
                            <th><?= $this->Paginator->sort('salary', ['label' => 'Costo Hora']) ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td><?= h($user->identity) ?></td>
                                <td><?= h($user->fullname) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td><?= h($user->role) ?></td>
                                <td><?= h($user->department) ?></td>
                                <td><?= $this->Number->format($user->salary) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('Ver'), ['action' => 'View', $user->id], ['class' => 'ver']) ?>
                                    <?php if($current_user['role'] == 'admin' || $current_user['role'] == 'superadmin') : ?>
                                        <?= $this->Html->link(__('Editar'), ['action' => 'Edit', $user->id], ['class' => 'editar']) ?>
                                    <?php endif; ?>
                                    <?php if($current_user['role'] == 'superadmin') : ?>
                                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'Delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'eliminar']) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Paginador Personalizado con el Element Paginator -->
            <div class="paginator">
                <?=$this->Element('paginator'); ?>
            </div>
        </div>
    </div>
</div>
