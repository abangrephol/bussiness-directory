<?php
namespace Admin;

class CustomComponentsController extends BaseController {

    public function getDatatableAll()
    {

        return \Datatable::collection(\CustomComponent::where('theme_id' ,\Session::get('thid'))->get())
            ->showColumns('name')
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumnWidget", array("model" => $model,'route'=>'custom-component'))->render();
            })
            ->searchColumns('name')
            ->orderColumns('id')
            ->make();
    }

    public function index($themeId){
        $this->theme->asset()->serve('datatable');
        $this->theme->setPageTitle('Custom Components');

        \Session::put('thid', $themeId);
        $routeUrl = 'dt.custom-component';
        $columns = array('Name','Actions');

        $data = array("columns" => $columns,'routeUrl'=>$routeUrl,'thid'=> $themeId);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-component'))->add('Custom Components', \URL::current());
        return $this->theme->scope('custom-component.index',$data)->render();
    }

    public function create($themeId){
        $this->theme->setPageTitle('Create New Widgets');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('ckeditor');
        $this->theme->asset()->serve('codemirror');
        $this->theme->asset()->serve('jquery.serialize');

        $data = array('thid'=>$themeId);

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->scope('custom-widgets.create',$data)->render();
    }
}