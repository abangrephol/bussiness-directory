<?php
namespace Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class CustomWidgetsController extends BaseController {
    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {
        //return var_dump(\Category::find(6)->getAncestors()->first()->name);
        return \Datatable::collection(\CustomWidget::where('theme_id' ,\Session::get('thid'))->get())
            ->showColumns('name')
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.custom-widget'))->render();
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
        $this->theme->setPageTitle('Custom Widgets');

        \Session::put('thid', \Input::get('thid'));
        $routeUrl = 'dt.custom-widget';
        $columns = array('Name','Actions');

        $data = array("columns" => $columns,'routeUrl'=>$routeUrl);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-widget'))->add('Custom Widget', \URL::current());
        return $this->theme->scope('custom-widgets.index',$data)->render();
    }
    public function create()
    {
        $this->theme->setPageTitle('Create New Widgets');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('ckeditor');
        $this->theme->asset()->serve('codemirror');
        $this->theme->asset()->serve('jquery.serialize');

        $data = array('thid'=>\Session::get('thid'));

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->scope('custom-widgets.create',$data)->render();
    }
    public function store()
    {
        $widget = new \CustomWidget();
        if($widget->validate()){
            $formData = [];
            $inputData = \Input::get('inputData');
            $inputDataGroup = \Input::get('inputDataGroup');
            for($i=0; $i < count($inputData) ; $i++){
                $formData[] = json_decode($inputData[$i]) ;
            }
            for($i=0; $i < count($inputDataGroup) ; $i++){
                $formDataGroup[] = json_decode($inputDataGroup[$i]) ;
            }
            $widget->data = json_encode(['form'=>$formData,'group'=>$formDataGroup]);
            $widget->save();
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully create new widget');
            return \Redirect::route('admin.custom-widget.edit',array('id'=>$widget->id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to create new widget');
            return \Redirect::route('admin.widget.create')
                ->withErrors($widget->errors())
                ->withInput()
                ->with('messages',$messages);
        }
    }
    public function edit($id)
    {
        $this->theme->setPageTitle('Edit Widget');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('ckeditor');
        $this->theme->asset()->serve('codemirror');
        $this->theme->asset()->serve('jquery.serialize');
        $widget = \CustomWidget::find($id);
        $data = array(
            'data'=> $widget,
            'thid'=>\Session::get('thid')
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->scope('custom-widgets.edit',$data)->render();
    }
    public function update($id)
    {
        //dd(\Input::get('categories'));
        $widget = \CustomWidget::find($id);
        if($widget->validate()){
            $formData = [];
            $inputData = \Input::get('inputData');
            $inputDataGroup = \Input::get('inputDataGroup');
            for($i=0; $i < count($inputData) ; $i++){
                $formData[] = json_decode($inputData[$i]) ;
            }
            for($i=0; $i < count($inputDataGroup) ; $i++){
                $formDataGroup[] = json_decode($inputDataGroup[$i]) ;
            }
            $widget->data = json_encode(['form'=>$formData,'group'=>$formDataGroup]);
            $widget->save();
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully update widget');
            return \Redirect::route('admin.custom-widget.edit',array('id'=>$id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to update widget');
            return \Redirect::route('admin.widget.edit',array('id'=>$id))

                ->withErrors($widget->errors())
                ->withInput()
                ->with('messages',$messages);
        }

    }
    public function widgetList($editor)
    {
        $widgets = \CustomWidget::where('theme_id',\Session::get('thid-editor'))->get();




        $data = array(
            'data'=>$widgets
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->layout('widgets')->scope('custom-widgets.widgetList',$data)->render();
    }
    public function widgetData(){
        $widget = \CustomWidget::find(\Input::get('id'));

        return $widget->template;
    }
    public function widgetForm($id)
    {
        $widgets = \CustomWidget::find($id);


        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('mustache');

        $data = array(
            'data'=>$widgets
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->layout('widgets')->scope('custom-widgets.widgetForm',$data)->render();
    }
}