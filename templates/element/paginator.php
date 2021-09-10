
<ul class="pagination">
    <?= $this->Paginator->first('<< ' . __('Primera')) ?>
    <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
    <?= $this->Paginator->last(__('Última') . ' >>') ?>
</ul>
<p><?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} resultados de {{count}} totales')) ?></p>