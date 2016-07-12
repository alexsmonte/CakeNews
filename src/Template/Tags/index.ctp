<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> '.__('Add new'), ['action' => 'add', '_full' => true], ['class' => 'btn btn-primary btn-sm', 'role' => 'button', 'escape' => false]) ?>
                </div>
            </div>
            <div class="ibox-content">
                <table cellpadding="0" cellspacing="0" class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 4%"><input type="checkbox" name="chkAll" id="chkAll"></th>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th class="actions" style="width: 10%"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($tags->isEmpty()) { ?>
                    <tr>
                        <td colspan="6"><?= __('No records found')?></td>
                    </tr>
                    <?php } else { foreach ($tags as $tag){ ?>
                        <tr>
                            <td><input type="checkbox" name="tags[id][]" class="chkTags" value="<?= $tag->id ?>"></td>
                            <td><?= h($tag->name) ?></td>
                            <td class="actions">
                                <div class="btn-group">
                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-primary-custom dropdown-toggle">Opções<span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $tag->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->name)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php } } ?>
                    </tbody>
                </table>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>