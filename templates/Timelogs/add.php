<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timelog $timelog
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="timelogs form content">
            <?= $this->Form->create($timelog) ?>
            <fieldset>
                <legend><?= __('Add Timelog') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('project_id', ['options' => $projects]);
                    echo $this->Form->control('date');
                    echo $this->Form->control('status');
                    echo $this->Form->control('starttime');
                    echo $this->Form->control('endtime', ['empty' => true]);
                    echo $this->Form->control('elapsedtime', ['empty' => true]);
                    echo $this->Form->control('cost');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
