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
                        <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                        <th><?= $this->Paginator->sort('parent_id', __('Parent')) ?></th>
                        <th><?= $this->Paginator->sort('slug', __('Slug')) ?></th>
                        <th class="actions" style="width: 8%"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($categories->isEmpty()) { ?>
                        <tr>
                            <td colspan="6"><?= __('No records found')?></td>
                        </tr>
                    <?php }else{ foreach ($categories as $category){ ?>
                        <tr>
                            <td><input type="checkbox" name="category[id][]" value="<?= $this->Number->format($category->id) ?>"></td>
                            <td><?= h($category->name) ?></td>
                            <td><?= $category->has('parent_category') ? $this->Html->link($category->parent_category->name, ['controller' => 'Categories', 'action' => 'view', $category->parent_category->id]) : '' ?></td>
                            <td><?= h($category->slug) ?></td>
                            <td class="actions">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary-custom dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?= __('Options'); ?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $category->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php }}; ?>
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
<script type="text/javascript">
    $(document).ready( function() {
        $("#chkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });

</script>