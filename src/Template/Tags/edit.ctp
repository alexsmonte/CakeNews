<div class="row">
    <div class="col-lg-12">
        <?= $this->Form->create($tag) ?>
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?= $this->Form->input('name', ['label' => __('Name'),'class' => 'form-control', 'placeholder' => __('Tag')]); ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?= $this->Form->button(__('Update'), ['type' => 'submit', 'escape' => false,'class' => 'btn btn-sm btn-primary-custom']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>