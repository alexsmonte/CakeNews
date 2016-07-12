<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <?= $this->Html->link(__('CakeNews'),['controller' => 'Posts', 'action' => 'index','_full' => true]);?>
        </li>
        <li>
            <a href="#" class="collapsed" data-toggle="collapse" data-target="#demo"><i class="fa fa-th-large"></i> <span class="nav-label"><?= __('Posts')?></span> <span class="fa arrow"></span></a>
            <ul id="demo" class="nav nav-second-level collapse in">
                <li><?= $this->Html->link(__('All posts'),['controller' => 'Posts', 'action' => 'index','_full' => true]);?></a></li>
                <li><?= $this->Html->link(__('Add new post'),['controller' => 'Posts', 'action' => 'add', '_full' => true]);?></a></li>
                <li><?= $this->Html->link(__('Categories'),['controller' => 'Categories', 'action' =>'index','_full' => true]);?></a></li>
                <li><?= $this->Html->link(__('Tags'),['controller' => 'Tags','action'=> 'index', '_full' => true]);?></a></li>
            </ul>
        </li>
    </ul>
</div>