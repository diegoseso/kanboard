<div class="page-header">
    <h2><?= t('Edit a task') ?></h2>
</div>
<form class="popover-form" method="post" action="<?= $this->url->href('taskmodification', 'update', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>" autocomplete="off">

    <?= $this->form->csrf() ?>

    <div class="form-column">

        <?= $this->form->label(t('Title'), 'title') ?>
        <?= $this->form->text('title', $values, $errors, array('autofocus', 'required', 'maxlength="200"', 'tabindex="1"')) ?>

        <?= $this->form->label(t('Description'), 'description') ?>
        <div class="form-tabs">
            <div class="write-area">
                <?= $this->form->textarea(
                    'description',
                    $values,
                    $errors,
                    array(
                        'placeholder="'.t('Leave a description').'"',
                        'tabindex="2"',
                        'data-mention-search-url="'.$this->url->href('UserHelper', 'mention', array('project_id' => $task['project_id'])).'"'
                    )
                ) ?>
            </div>
            <div class="preview-area">
                <div class="markdown"></div>
            </div>
            <ul class="form-tabs-nav">
                <li class="form-tab form-tab-selected">
                    <i class="fa fa-pencil-square-o fa-fw"></i><a id="markdown-write" href="#"><?= t('Write') ?></a>
                </li>
                <li class="form-tab">
                    <a id="markdown-preview" href="#"><i class="fa fa-eye fa-fw"></i><?= t('Preview') ?></a>
                </li>
            </ul>
        </div>

        <?= $this->render('task/color_picker', array('colors_list' => $colors_list, 'values' => $values)) ?>
    </div>

    <div class="form-column">
        <?= $this->form->hidden('id', $values) ?>
        <?= $this->form->hidden('project_id', $values) ?>

        <?= $this->form->label(t('Assignee'), 'owner_id') ?>
        <?= $this->form->select('owner_id', $users_list, $values, $errors, array('tabindex="3"')) ?>

        <?= $this->form->label(t('Category'), 'category_id') ?>
        <?= $this->form->select('category_id', $categories_list, $values, $errors, array('tabindex="4"')) ?>

        <?= $this->form->label(t('Complexity'), 'score') ?>
        <?= $this->form->number('score', $values, $errors, array('tabindex="6"')) ?>

        <?= $this->task->selectPriority($project, $values) ?>

        <?= $this->form->label(t('Due Date'), 'date_due') ?>
        <?= $this->form->text('date_due', $values, $errors, array('placeholder="'.$this->text->in($date_format, $date_formats).'"', 'tabindex="8"'), 'form-date') ?>
        <div class="form-help"><?= t('Others formats accepted: %s and %s', date('Y-m-d'), date('Y_m_d')) ?></div>
    </div>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue" tabindex="10">
        <?= t('or') ?>
        <?= $this->url->link(t('cancel'), 'task', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, 'close-popover') ?>
    </div>
</form>