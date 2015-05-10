<?php
namespace Admin;

class CustomTemplatesController extends BaseController {
    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {
        //return var_dump(\Category::find(6)->getAncestors()->first()->name);
        return \Datatable::collection(\CustomWebsite::get())
            ->showColumns('name','domain','tld')
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.categories'))->render();
            })
            ->searchColumns('name','slug')
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
        $this->theme->setPageTitle('Custom Websites');

        $routeUrl = 'dt.custom-website';
        $columns = array('Name','Domain','TLD','Company','Action');

        $data = array("columns" => $columns,'routeUrl'=>$routeUrl);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-website'))->add('Custom Websites', \URL::current());
        return $this->theme->scope('custom-websites.index',$data)->render();
    }
}