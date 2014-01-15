<?php foreach (Modeller_I18n::available_languages(TRUE) as $language) : ?>

    <?php $column = $field->name().'_'.$language->iso; ?>

    <?php echo Form::input($column, $field->model()->$column, array_merge(array(
        'data-language' => $language->iso,
        'style' => 'background-image: url("'.BASE_URL.'assets/imgs/flags/'.$language->iso.'.png");',
    ), $field->attributes(), array('class' => 'form-control form-control-18n'))); ?>

<?php endforeach; ?>