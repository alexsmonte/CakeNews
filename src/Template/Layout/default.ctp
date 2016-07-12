<?php
$cakeDescription = 'CakeNews';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['CakeNews.bootstrap.min.css','CakeNews.simple-sidebar.css'], ['fullBase' => true]) ?>
    <?= $this->Html->script(['CakeNews.jquery.min.js', 'CakeNews.bootstrap.min.js'], ['fullBase' => true]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?= $this->assign('title', $title) ?>
<body>
<div id="wrapper" class="toggled">
<!-- Sidebar -->
<?= $this->element('CakeNews.nav-bar');?>
<!-- /#sidebar-wrapper -->
<!-- Page Content -->
<div id="page-content-wrapper">
<div class="container-fluid">
    <?= $this->element('CakeNews.header');?>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
</div>
<!-- /#page-content-wrapper -->
</div>

<!-- Menu Toggle Script -->
<script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>
