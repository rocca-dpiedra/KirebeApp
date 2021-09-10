<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timelog $timelog
 */
?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <aside class="column">
        <?=$this->Element('actions', array('type' => 'Registro', 'types' => 'Registros')); ?>
    </aside>
    <div class="column-responsive column-80">
        <div class="timelogs form content">
            <?= $this->Form->create($timelog) ?>
            <fieldset>
                <legend><?= __('Edit Timelog') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('project_id', ['options' => $projects]);
                    echo $this->Form->control('date');
                    echo $this->Form->control('status');
                    echo $this->Form->control('starttime');
                    echo $this->Form->control('endtime');
                    echo $this->Form->control('elapsedtime');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
