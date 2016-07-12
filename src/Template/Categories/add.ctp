<div class="row">
    <?= $this->Form->create($category,['class' => 'form-horizontal']); $this->Form->templates( ['inputContainer' => '{{content}}']); ?>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="form-group">
                    <div class="col-lg-4">
                        <?= $this->Form->input('parent_id', ['options' => $parentCategories, 'class' => 'form-control', 'empty' => true, 'label' => __('Parent')]); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3">
                        <?= $this->Form->input('name', ['label' => __('Name'),'class' => 'form-control', 'required' => true]); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3">
                        <?= $this->Form->input('slug', ['label' => __('Slug'),'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3">
                        <?= $this->Form->button(__('Save'), ['type' => 'submit', 'escape' => false,'class' => 'btn btn-primary-custom']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script(['CakeNews.speakingurl.js'], ['fullBase' => true]); ?>
<script type="text/javascript">
    $(document).ready( function() {
        $('#name').keyup(function(){
            $('#slug').val(getSlug($(this).val(), { truncate: 255 }));
        });

    });
</script>