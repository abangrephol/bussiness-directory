<?php
namespace Admin;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class CustomWebsitesController extends BaseController {
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
            ->addColumn('company',function($model){
                return $model->company_id;
            })
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.custom-website'))->render();
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
    public function create()
    {
        $this->theme->asset()->serve('chosen');
        $this->theme->setPageTitle('Custom Websites');

        $data = array(
            'companies' => \Company::getCompanyLists()
        );

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-website'))->add('Custom Websites', \URL::current());
        return $this->theme->scope('custom-websites.create',$data)->render();
    }
    public function store(){
        $customwebsite = new \CustomWebsite;
        if($customwebsite->validate()){
            $customwebsite->save();
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully create new Custom Website');
            return \Redirect::route('admin/custom-website/pages',array('id'=>$customwebsite->id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to create new company');
            return \Redirect::route('admin.custom-website.create')
                ->withErrors($customwebsite->errors())
                ->withInput()
                ->with('messages',$messages);
        }
    }

    public function edit($id){
        return \Redirect::route('custom-website.builder',array(
            'id'=>$id,
            'templateId'=>\CustomWebsite::find($id)->template_id
        ));
    }
    public function chooseTemplates($id){
        if(!isset($id))
            return \Redirect::route('admin.custom-website');

        $this->theme->asset()->serve('chosen');
        $this->theme->setPageTitle('Choose a Template');

        $data = array(
            'id' => $id,
            'templates' => \CustomTemplate::getAll()
        );

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-website'))->add('Custom Websites', \URL::current());
        return $this->theme->scope('custom-websites.choose-template',$data)->render();
    }

    public function builder ($id,$templateId){
        if(!isset($id) || !isset($templateId))
            return \Redirect::route('admin.custom-website');

        $this->theme->asset()->serve('iframe');
        $this->theme->asset()->serve('builder');
        $this->theme->setPageTitle('Choose a Template');

        $data = array(
            'id' => $id,
            'templateId' => $templateId,
            'templates' => \CustomTemplate::getAll()
        );
        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-website'))->add('Custom Websites', \URL::current());
        return $this->theme->scope('custom-websites.builder',$data)->render();
    }

    public function builderEditor ($id,$templateId){
        $this->theme = \Theme::uses(\CustomTemplate::find($templateId)->theme_name)->layout('default');

        return $this->theme->scope('template.index')->render();
    }
}