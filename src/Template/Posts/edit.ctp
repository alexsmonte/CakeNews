<?php use Cake\I18n\Time; ?>
<div class="row" ng-app="App">
    <?= $this->Form->create($post,['class' => 'form-horizontal']); $this->Form->templates( ['inputContainer' => '{{content}}']); ?>
    <div class="col-lg-9">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="form-group">
                    <div class="col-lg-12">
                        <?= $this->Form->input('title', ['label' => __('Title'),'class' => 'form-control', 'placeholder' => __('Enter the post title')]); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <?= $this->Form->input('content', ['label' => false,'class' => 'form-control', 'required' => false]); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <?= $this->Form->input('resume', ['label' => __('Resume'),'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <?= $this->Form->input('slug', ['label' => __('Url'),'class' => 'form-control']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox-title">
            <h5><?= __('Publish'); ?></h5>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12"><?= __('Published in')?>: <?php $time = new Time($post->created); echo $time->timeAgoInWords(['end' => '+1 day','accuracy' => ['second' =>'second']]); ?></div>
            </div>
        <br/>
            <?= $this->Form->button(__('Update'), ['type' => 'submit', 'escape' => false,'class' => 'btn btn-sm btn-primary-custom']) ?>
        </div>
        <br/>
        <div class="ibox-title">
            <h5><?= __('Category'); ?></h5>
        </div>
        <div class="ibox-content">
            <div class="row" style="height: 150px; overflow-y: scroll;">
            <?=$this->Form->input('categories._ids', ['templates' => ['checkboxWrapper' => '<div class="col-sm-12 checkbox">{{label}}</div>'],'label' => false,'options' => $categories, 'multiple' => 'checkbox', 'type' => 'select']);?>
            </div>
        </div>
        <br/>
        <div class="ibox-title">
            <h5><?= __('Tags'); ?></h5>
        </div>
        <div class="ibox-content" ng-controller="tagsCtrl">
            <tags-input ng-model="tags" add-on-paste="true" display-property="name" replace-spaces-with-dashes="false" on-tag-added="tagAdded($tag)" on-tag-removed="tagRemoved($tag)" placeholder="<?= __('Add a tag'); ?>">
                    <auto-complete source="loadTags($query)" min-length="0" load-on-focus="true" select-first-match="true"></auto-complete>
            </tags-input>
            <?= __('Separate tags with commas'); ?>
        </div>
        <br>
        <div class="ibox-title">
            <h5><?= __('Featured image'); ?></h5>
        </div>
        <div class="ibox-content" ng-controller="tagsCtrl">
            <?= __('Set featured image'); ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>
<?= $this->Html->css(['CakeNews.jquery-ui.min.css','CakeNews.ng-tags-input.min.css'], ['fullBase' => true]) ?>
<?= $this->Html->script(['CakeNews.tinymce/tinymce.min.js', 'CakeNews.speakingurl.js', 'CakeNews.jquery-ui.min.js', 'CakeNews.angular.min.js', 'CakeNews.ng-tags-input.min.js'], ['fullBase' => true]); ?>

<script type="text/javascript">

    angular.module('App',['ngTagsInput']);
    angular.module('App').controller('tagsCtrl',['$scope','$http',function(scope,http){

        scope.tags = <?= json_encode($post->tags); ?>;

        scope.tagAdded = function(tag) {
// pode ser melhorado
            if(undefined == tag.id){
                $.ajax({
                    method: "POST",
                    url: "<?= $this->Url->build(["controller" => "Tags", "action" => "newTag"]); ?>",
                    data: { name: tag.name, posts:{_ids:<?= $post->id?>}}
                });

            }else{
                $.ajax({
                    method: "POST",
                    url: "<?= $this->Url->build(["controller" => "Tags", "action" => "newTag"]); ?>",
                    data: { id: tag.id, name: tag.name, posts:{_ids:<?= $post->id?>}}
                });
            }

        };

        scope.tagRemoved = function(tag){
            var tags =   tag.id;
            if(undefined == tag.id)
                tags =   tag.name;

            $.ajax({
                method: "POST",
                url: "<?= $this->Url->build(["controller" => "Tags", "action" => "remove"]); ?>",
                data: { tag_id:tags, post_id: <?= $post->id?>}
            });
        };

        scope.loadTags = function($query) {

            return http.get('<?= $this->Url->build(["controller" => "Tags","action" => "showTags"]); ?>?term='+$query, { cache: true}).then(function(response) {
                var tags = response.data;
                return tags.filter(function(tag) {
                    return tag.name.toLowerCase().indexOf($query.toLowerCase()) != -1;
                });
            });
        };

    }]);

    $(document).ready( function() {

        $('#title').keyup(function(){
            $('#slug').val(getSlug($(this).val(), { truncate: 255 }));
        });

        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });

    tinymce.init({
        selector: '#content',
        height: 500,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });
</script>