<?php
namespace Admin;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Request;

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
                return $model->company()->first()->name;
            })
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.custom-website'))->render();
            })
            ->searchColumns('name','slug')
            ->orderColumns('id')
            ->make();
    }
    public function getWebsitePages()
    {
        return \Datatable::collection(\CustomWebsitePage::where('custom_website_id',\Session::get('websiteId'))->get())
            ->showColumns('name','title')
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumnPages", array("model" => $model))->render();
            })
            ->searchColumns('name','title')
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
            //return \Redirect::route('admin/custom-website/pages',array('id'=>$customwebsite->id))->with('messages',$messages);
            return \Redirect::route('custom-website.chooseTemplate',array(
                'id'=>$customwebsite->id
            ))->with('messages',$messages);
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
        if(\CustomWebsite::find($id)->template_id==null)
            return \Redirect::route('custom-website.chooseTemplate',array(
                'id'=>$id
            ));
        else
            return \Redirect::route('custom-website.pages',array(
                'id'=>$id
            ));
            /*return \Redirect::route('custom-website.builder',array(
                'id'=>$id,
                'templateId'=>\CustomWebsite::find($id)->template_id
            ));*/
    }

    public function update($id){
        $type = \Input::get('setting-type');
        if(isset($type) && $type=='site'){
            $logo = \CustomWebsiteData::set_key($id,'logo',\Input::get('logo'));
            $header_email = \CustomWebsiteData::set_key($id,'header-email',\Input::get('header-email'));
            $header_phone = \CustomWebsiteData::set_key($id,'header-phone',\Input::get('header-phone'));
            $footer_about = \CustomWebsiteData::set_key($id,'footer-about',\Input::get('footer-about'));
            return \Redirect::route('custom-website.pages',array(
                'id'=>$id
            ));
        }else{
            $customwebsite = \CustomWebsite::find($id);
            if($customwebsite->validate()){
                $customwebsite->save();
                $messages = new \Illuminate\Support\MessageBag;
                $messages->add('message', 'You have successfully create new Custom Website');
                //return \Redirect::route('admin/custom-website/pages',array('id'=>$customwebsite->id))->with('messages',$messages);
                return \Redirect::route('custom-website.pages',array(
                    'id'=>$customwebsite->id
                ))->with('messages',$messages);
            }else{
                $messages = new \Illuminate\Support\MessageBag;
                $messages
                    ->add('error',true)
                    ->add('message', 'Failed to create new company');
                return \Redirect::route('custom-website.pages')
                    ->withErrors($customwebsite->errors())
                    ->withInput()
                    ->with('messages',$messages);
            }
        }
    }
    public function chooseTemplates($id){
        $templateId = \Input::get('templateId');
        if(isset($templateId)){
            $cw = \CustomWebsite::find($id);
            $cw->template_id = $templateId;
            $cw->save();
            return \Redirect::route('custom-website.pages',array('id'=>$id));
        }
        if(!isset($id))
            return \Redirect::route('admin.custom-website');

        $this->theme->asset()->serve('chosen');
        $this->theme->setPageTitle('Choose a Template');

        $data = array(
            'id' => $id,
            'templates' => \CustomTheme::getAll()
        );

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-website'))->add('Custom Websites', \URL::current());
        return $this->theme->scope('custom-websites.choose-template',$data)->render();
    }

    public function pages($id){
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('fileupload');

        $this->theme->asset()->serve('datatable');
        $this->theme->setPageTitle('Custom Websites - Pages');

        $routeUrl = 'dt.custom-website-pages';
        $columns = array('Name','Title','Action');

        $data = array(
            "columns" => $columns,
            'routeUrl'=>$routeUrl,
            'id'=>$id,
            'templateId'=>\CustomWebsite::find($id)->template_id,
            'data' => isset($id)?\CustomWebsite::find($id):null,
            'companies' => \Company::getCompanyLists()
        );
        \Session::put('websiteId', $id);
        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-website'))->add('Custom Websites', \URL::current());
        return $this->theme->scope('custom-websites.pages',$data)->render();
    }
    public function builder ($id,$templateId){
        if(!isset($id) || !isset($templateId))
            return \Redirect::route('admin.custom-website.pages',compact('id'));

        $this->theme->asset()->serve('iframe');
        $this->theme->asset()->serve('builder');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('color-picker');
        $this->theme->asset()->serve('fileupload');
        $this->theme->setPageTitle('Choose a Template');
        $pageId = \Input::get('pageId');
        $pageData = isset($pageId)?\CustomWebsitePage::find($pageId):null ;
        $data = array(
            'id' => $id,
            'templateId' => $templateId,
            'templates' => \CustomTheme::getAll(),
            'pageId' => isset($pageId)?$pageId:0,
            'data' => $pageData
        );
        if($pageData!=null && isset($pageData->custom_data)){

            $custom_data = json_decode($pageData->custom_data);
            $data['banners'] = isset($custom_data->banners)?$custom_data->banners:null;
            $data['background_color'] = isset($custom_data->background_color)?$custom_data->background_color:null;
            $data['body_font'] = isset($custom_data->body_font)?$custom_data->body_font:null;
            //$data = array_filter($data);
        }

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/custom-website'))->add('Custom Websites', \URL::current());
        return $this->theme->scope('custom-websites.builder',$data)->render();
    }

    public function builderEditor ($id,$templateId){

        $this->theme = \Theme::uses(\CustomTheme::find($templateId)->theme_name)->layout('default');
        $this->theme->asset()->serve('editor');
        $pageId = \Input::get('pageId');

        $data = array(
            'id' => $id
        );
        session_start();
        $_SESSION["RF"]["subfolder"] = "$id";
        echo $path = public_path().'/uploads/images/' . $id;
        \File::makeDirectory($path, $mode = 0777, true);
        if(isset($pageId) && $pageId!=0){
            $data['data'] = \CustomWebsitePage::find($pageId);
            $custom_data = json_decode(\CustomWebsitePage::find($pageId)->custom_data);

            if(isset($custom_data->body_font)){
                $this->theme->asset()->add('custom-font','//fonts.googleapis.com/css?family='.urlencode($custom_data->body_font));
                $this->theme->asset()->writeStyle('inline-style', 'body,p { font-family: "'.$custom_data->body_font.'" !important; }', array());
            }
            if(isset($custom_data->banners)){
                $data['banners'] = $custom_data->banners;
            }
        }
        return $this->theme->scope('template.index',$data)->render();
    }

    public function builderSave ($id){
        $pageId = \Input::get('pageId');
        if(isset($pageId) && $pageId!=0){
            $customwebsite = \CustomWebsitePage::find($pageId);
            parse_str(\Input::get('input'),$input);

            $custom_data = array(
                'background_color'=>$input['background-color'],
                'banners' => array_filter($input['banner']),
                'body_font' => $input['body-font']
            );

            $customwebsite->custom_website_id = $id;
            $customwebsite->content = \Input::get('content');
            $customwebsite->isHome = isset($input['isHome'])?1:0;
            $customwebsite->slug = $input['slug'];
            $customwebsite->title = $input['title'];
            $customwebsite->status = $input['status'];
            $customwebsite->name = $input['name'];
            $customwebsite->custom_data = json_encode(array_filter($custom_data));
            if($customwebsite->validate()){
                $customwebsite->save();
                return \Response::json(array('result'=>'success','message'=>'Saved.','type'=>'update'));
            }else{
                return \Response::json(array('result'=>'fail','message'=>$customwebsite->errors()));

            }
        }else{
            $customwebsite = new \CustomWebsitePage;
            parse_str(\Input::get('input'),$input);
            $custom_data = array(
                'background-color'=>$input['background-color'],
                'banners' => array_filter($input['banner']),
                'body-font' => $input['body-font']
            );
            $customwebsite->custom_website_id = $id;
            $customwebsite->content = \Input::get('content');
            $customwebsite->isHome = isset($input['isHome'])?1:0;
            $customwebsite->slug = $input['slug'];
            $customwebsite->title = $input['title'];
            $customwebsite->status = $input['status'];
            $customwebsite->name = $input['name'];
            $customwebsite->custom_data = json_encode(array_filter($custom_data));
            if($customwebsite->validate()){
                $customwebsite->save();
                return \Response::json(array('result'=>'success','message'=>'Saved.','type'=>'new','id'=>$customwebsite->id));
            }else{
                return \Response::json(array('result'=>'fail','message'=>$customwebsite->errors()));

            }
        }

    }
}