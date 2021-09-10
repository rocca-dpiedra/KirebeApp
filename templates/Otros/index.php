<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timelog[]|\Cake\Collection\CollectionInterface $timelogs
 */
?>

<!-- Se agrega formulario para búsqueda. -->
<div class="table-responsive">
    <?= $this->Form->create(null,['url'=>['action'=>'Index']]) ?>
        <table>
            <tbody>
                <tr>
                    <td>
                        <?= $this->Form->control('projects',['label'=>'Seleccione el Proyecto','value'=>$this->request->getData('projects'), 'options' => $projects, 'multiple' => 'true']) ?>
                    </td>
                    <td>
                        <?= $this->Form->control('users',['label'=>'Seleccione el Usuario','value'=>$this->request->getData('users'), 'options' => $users, 'multiple' => 'true']) ?>
                    </td>
                    <td>
                        <p> Hola Hola</p>
                        <p> Adios Adios</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php echo $this->Form->button('Buscar'); ?>
    <?= $this->Form->end() ?>
</div>



<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <aside class="column">
        <?=$this->Element('actions', array('type' => 'Registro', 'types' => 'Registros')); ?>
    </aside>
    <div class="column-responsive column-80">
        <div class="timelogs index content">
            <?= $this->Html->link(__('New Timelog'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <h3><?= __('Timelogs') ?></h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('user_id') ?></th>
                            <th><?= $this->Paginator->sort('project_id') ?></th>
                            <th><?= $this->Paginator->sort('date') ?></th>
                            <th><?= $this->Paginator->sort('status') ?></th>
                            <th><?= $this->Paginator->sort('starttime') ?></th>
                            <th><?= $this->Paginator->sort('endtime') ?></th>
                            <th><?= $this->Paginator->sort('elapsedtime') ?></th>
                            <th><?= $this->Paginator->sort('cost') ?></th>
                            <th><?= $this->Paginator->sort('created') ?></th>
                            <th><?= $this->Paginator->sort('modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timelogs as $timelog): ?>
                        <tr>
                            <td><?= $this->Number->format($timelog->id) ?></td>
                            <td><?= $timelog->has('user') ? $this->Html->link($timelog->user->fullname, ['controller' => 'Users', 'action' => 'view', $timelog->user->id]) : '' ?></td>
                            <td><?= $timelog->has('project') ? $this->Html->link($timelog->project->name, ['controller' => 'Projects', 'action' => 'view', $timelog->project->id]) : '' ?></td>
                            <td><?= h($timelog->date) ?></td>
                            <td> 
                                <?php if ($timelog->status == 0 ) : ?> 
                                    Finalizado 
                                <?php else : ?> 
                                    En Curso 
                                <?php endif ; ?> 
                            </td>
                            <td><?= h($timelog->starttime) ?></td>
                            <td><?= h($timelog->endtime) ?></td>
                            <td><?= h($timelog->elapsedtime) ?></td>
                            <td><?= $this->Number->format($timelog->cost) ?></td>
                            <td><?= h($timelog->created) ?></td>
                            <td><?= h($timelog->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $timelog->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timelog->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timelog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timelog->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
            </div>
        </div>
    </div>
</div>