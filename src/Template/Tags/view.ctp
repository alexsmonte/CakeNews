<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <table class="table">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($tag->id) ?></td>
                    </tr>
                    <tr>
                        <th width="20%"><?= __('Name') ?></th>
                        <td><?= h($tag->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($tag->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($tag->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
