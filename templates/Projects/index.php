<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */
?>

<div class="row">
    <div class="column-responsive column-90">
        <div class="users index content">
            <h3><?= __('Lista de Proyectos') ?></h3>
            <div class="table-responsive">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', ['label' => 'Id']) ?></th>
                            <th><?= $this->Paginator->sort('name', ['label' => 'Nombre']) ?></th>
                            <th><?= $this->Paginator->sort('description', ['label' => 'Descripción']) ?></th>
                            <th><?= $this->Paginator->sort('department', ['label' => 'Departamento']) ?></th>
                            <th><?= $this->Paginator->sort('user_id', ['label' => 'Encargado']) ?></th>
                            <th><?= $this->Paginator->sort('subsidiary', ['label' => 'Subsidiaria']) ?></th>
                            <th><?= $this->Paginator->sort('price', ['label' => 'Costo']) ?></th>
                            <th><?= $this->Paginator->sort('status', ['label' => 'Estado']) ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= $this->Number->format($project->id) ?></td>
                            <td><?= h($project->name) ?></td>
                            <td><?= h($project->description) ?></td>
                            <td><?= h($project->department) ?></td>
                            <td><?= $project->has('user') ? $this->Html->link($project->user->fullname, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></td>
                            <td><?= h($project->subsidiary) ?></td>
                            <td><?= $this->Number->currency($project->price,'CRC') ?></td>


                            <!-- <td><?= ($project->status)?'Activo':'Finalizado'; ?></td> -->

                            <td class="actions">
                                <?php if ($project->status == 1):
                                    echo $this->Form->postLink(__('Finalizar'),
                                        [
                                            'action' => 'projectStatus',
                                            $project->id,
                                            $project->status,
                                        ],
                                        [ 
                                            'block' => true,
                                            'confirm' => __( '¿Estás seguro que quieres Inactivar este usario? # {0}?', $project->name),
                                        ]
                                    );
                                else:
                                    echo $this->Form->postLink(__('Activar'),
                                        [
                                            'action' => 'projectStatus',
                                            $project->id,
                                            0
                                        ],
                                        [
                                            'block' => true,
                                            'confirm' => __('¿Estás seguro que quieres Activar este usario? ? # {0}?',$project->name),
                                        ]
                                    );
                                endif; ?>
                            </td>

                            <td class="actions">
                                <?= $this->Html->link(__('Ver'), ['action' => 'View', $project->id], ['class' => 'ver']) ?>
                                <?php if($current_user['role'] == 'admin' || $current_user['role'] == 'superadmin') : ?>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'Edit', $project->id], ['class' => 'editar']) ?>
                                <?php endif; ?>
                                <?php if($current_user['role'] == 'superadmin') : ?>
                                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'Delete', $project->id], 
                                     ['confirm' => __('Desea eliminar el proyecto # {0}?', $project->name), 'class' => 'eliminar']) ?>
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

