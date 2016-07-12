<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table">
                    <tr>
                        <th><?= __('Parent Category') ?></th>
                        <td><?= $category->has('parent_category') ? $this->Html->link($category->parent_category->name, ['controller' => 'Categories', 'action' => 'view', $category->parent_category->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th width="10%"><?= __('Name') ?></th>
                        <td><?= h($category->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Slug') ?></th>
                        <td><?= h($category->slug) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= __('Related Posts'); ?></h5>
            </div>
            <div class="ibox-content">
                <table class="table table-striped">
                    <tr>
                        <th><?= __('Title') ?></th>
                        <th><?= __('Resume') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Modified') ?></th>
                    </tr>
                    <?php if (empty($category->posts)){ ?>
                        <tr>
                            <td colspan="9"><?= __('No records found')?></td>
                        </tr>
                    <?php } else { ?>
                    <?php foreach ($category->posts as $posts) { ?>
                        <tr>
                            <td><?= h($posts->title) ?></td>
                            <td><?= h($posts->resume) ?></td>
                            <td><?= h($posts->created) ?></td>
                            <td><?= h($posts->modified) ?></td>
                        </tr>
                    <?php }} ?>
                </table>

            </div>
        </div>
    </div>
</div>

