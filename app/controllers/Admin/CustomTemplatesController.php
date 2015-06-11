<?php
namespace Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

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
        return \Datatable::collection(\CustomTemplate::where('theme_id' ,\Session::get('thid'))->get())
            ->showColumns('name')
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.custom-template'))->render();
            })
            ->searchColumns('name')
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
        $this->theme->setPageTitle('Custom Template');

        \Session::put('thid', \Input::get('thid'));
        $routeUrl = 'dt.custom-template';
        $columns = array('Name','Actions');

        $data = array("columns" => $columns,'routeUrl'=>$routeUrl);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-template'))->add('Custom Template', \URL::current());
        return $this->theme->scope('custom-templates.index',$data)->render();
    }
    public function create()
    {
        $this->theme->setPageTitle('Create New Template');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('ckeditor');
        $this->theme->asset()->serve('codemirror');

        $data = array('thid'=>\Session::get('thid'));

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->scope('custom-templates.create',$data)->render();
    }
    public function store()
    {
        $template = new \CustomTemplate();
        if($template->validate()){
            $template->save();
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully create new template');
            return \Redirect::route('admin.custom-template.edit',array('id'=>$template->id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to create new company');
            return \Redirect::route('admin.companies.create')
                ->withErrors($template->errors())
                ->withInput()
                ->with('messages',$messages);
        }
    }
    public function edit($id)
    {
        $this->theme->setPageTitle('Edit Template');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('ckeditor');
        $this->theme->asset()->serve('codemirror');

        $data = array(
            'data'=>\CustomTemplate::find($id),
            'thid'=>\Session::get('thid')
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->scope('custom-templates.edit',$data)->render();
    }
    public function update($id)
    {
        //dd(\Input::get('categories'));
        $template = \CustomTemplate::find($id);
        if($template->validate()){
            $template->save();
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully update template');
            return \Redirect::route('admin.custom-template.edit',array('id'=>$id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to update company');
            return \Redirect::route('admin.companies.edit',array('id'=>$id))

                ->withErrors($template->errors())
                ->withInput()
                ->with('messages',$messages);
        }

    }
    public function templateList()
    {
        $templates = \CustomTemplate::where('theme_id',\Session::get('thid-editor'))->get();
        $response = Response::make();
        $response->header('Content-Type', 'application/javascript');
        $content = "CKEDITOR.addTemplates( 'default', {";
        $content .= "templates: [ ";
        foreach($templates as $template){
            $content .= "{";
            $content .= "title: '$template->name',
                        description: '$template->description',";
            $content .= "html:'".addslashes(preg_replace( "/\r|\n/", "", $template->template ))."'";
            $content .= "},";
        }
        $content .= "] } );";
        return $content;
    }
}