<?php

namespace Roy688\Config;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class ConfigController
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function(Content $content) {
            $content->header('Config');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function(Content $content) use ($id) {
            $content->header('Edit Config');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function(Content $content) {
            $content->header('Add Config');
            $content->body($this->form());
        });
    }

    public function grid()
    {
        return Admin::grid(ConfigModel::class, function(Grid $grid) {
            $grid->id('#')->sortable();
            $grid->name()->editable();
            $grid->title()->display(function($title) {
                return '<strong>'.ucfirst($title).'</strong>';
            });
            $grid->value();
            $grid->description();

            $grid->filter(function($filter) {
                $filter->disableIdFilter();
                $filter->like('name');
                $filter->like('value');
            });

        });
    }

    public function form()
    {
        return Admin::form(ConfigModel::class, function(Form $form) {
            $form->display('id', 'ID');
            $form->select('type', ConfigModel::getTypeSelectOptions());
            $form->text('name')->rules('required');
            $form->text('title')->rules('required');
            $form->textarea('value')->rules('required');
            $form->textarea('description');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
