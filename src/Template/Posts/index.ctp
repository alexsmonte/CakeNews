<?php use Cake\I18n\Time; ?>

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
                    <!---<th style="width: 4%"><input type="checkbox" name="chkAll" id="chkAll"></th> --->
                    <th style="width: 45%"><?= $this->Paginator->sort('title', __('Title')) ?></th>
                    <th><?=  __('Category') ?></th>
                    <th><?=  __('Tags') ?></th>
                    <th><?= __('Date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($posts->isEmpty()) { ?>
                    <tr>
                        <td colspan="6"><?= __('No records found')?></td>
                    </tr>
                <?php }else{ foreach ($posts as $post){ ?>
                    <tr>
                        <!---<td><input type="checkbox" name="posts[id][]" class="chkPosts" value="<?= $post->id ?>"></td>-->
                        <td><?= $this->Html->link($post->title, ['controller' => 'Posts', 'action' => 'edit', $post->id]) ?></td>
                        <td><?php $categories = ''; foreach($post->categories as $category){ $categories .= $category->name.',';  $categoryUrl = strtolower($category->name); } echo substr($categories, 0 , -1); ?></td>
                        <td><?php $tags = ''; foreach($post->tags as $tag){ $tags .= $tag->name.',';  } echo substr($tags, 0 , -1); ?></td>
                        <td><?= __('published')?> <?php
                            $time = new Time($post->created);
                            echo $time->timeAgoInWords(['end' => '+1 day','accuracy' => ['second' =>'second']]); ?></td>
                        <td class="actions">
                            <div class="btn-group">
                                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-primary-custom dropdown-toggle">Opções<span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><?= $this->Html->link(__('View'), ['controller' => 'Posts','action' => 'postView', 'plugin' => 'CakeNews', 'slug' => $post->slug,'_full' => true]) ?></li>
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $post->id]) ?></li>
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->title)]) ?></li>
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
<script type="text/javascript">
    $(document).ready( function() {
        $("#chkAll").click(function(){
            $('.chkPosts').not(this).prop('checked', this.checked);
        });
    });

</script>