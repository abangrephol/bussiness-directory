<?php
namespace Admin;

class CustomThemesController extends BaseController {
    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {
        //return var_dump(\Category::find(6)->getAncestors()->first()->name);
        return \Datatable::collection(\CustomTheme::get())
            ->showColumns('name','author')
            ->addColumn('action',function($model){
                //return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.custom-theme'))->render();
                $buttons = '<div class="btn-group btn-group-sm ">'
                                .'<a href="'.\URL::route('admin/custom-template', array('thid'=>$model->id)).'" class="btn btn-primary"><i class="fa fa-edit mr5"></i>Templates</a>'
                                .'<a href="'.\URL::route('admin/custom-widget', array('thid'=>$model->id)).'" class="btn btn-primary"><i class="fa fa-edit mr5"></i>Widgets</a>'
                                .'<a href="'.\URL::route('admin/custom-component', array('thid'=>$model->id)).'" class="btn btn-primary"><i class="fa fa-edit mr5"></i>Components</a>'
                                .'<a href="'.\URL::route('admin.custom-theme.edit', array()).'" class="btn btn-primary"><i class="fa fa-edit mr5"></i>Edit</a>'
                                .'<a href="'. \URL::route('admin.custom-theme.destroy', array()) .'" class="btn btn-danger"><i class="fa fa-trash-o mr5"></i>Delete</a>'
                            .'</div>';
                return $buttons;
            })
            ->searchColumns('name','author')
            ->orderColumns('id')
            ->make();
    }
    /**
     * Display a listing of Custom websites
     *
     * @return Response
     */
    public function index()
    {
        $this->theme->asset()->serve('datatable');
        $this->theme->setPageTitle('Custom Website Themes');

        $routeUrl = 'dt.custom-theme';
        $columns = array('Name','Author','Action');

        $data = array("columns" => $columns,'routeUrl'=>$routeUrl);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-theme'))->add('Custom Themes', \URL::current());
        return $this->theme->scope('custom-themes.index',$data)->render();
    }
}