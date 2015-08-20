<?php
namespace Admin;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Input;

class UsersController extends BaseController {
    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {
        //return var_dump(\Category::find(6)->getAncestors()->first()->name);

        $users = new \Illuminate\Database\Eloquent\Collection;
        foreach(\Sentry::findAllUsers() as $user){

            $users->add($user);
        }

        return \Datatable::collection($users)
            ->showColumns('first_name','last_name','email')
            ->addColumn('type',function($model){
                return @$model->getGroups()->first()->name;
            })
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.users'))->render();
            })
            ->searchColumns('first_name','last_name','email')
            ->orderColumns('id','first_name','last_name','email')
            ->make();
    }
    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {
        $this->theme->asset()->serve('datatable');
        $this->theme->setPageTitle('Users');

        $routeUrl = 'dt.user';
        $columns = array('First Name','Last Name','Email','Group','Action');

        $data = array("columns" => $columns,'routeUrl'=>$routeUrl);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/categories'))->add('Users', \URL::current());
        return $this->theme->scope('users.index',$data)->render();
    }

    /**
     * Show the form for creating a new category
     *
     * @return Response
     */
    public function create()
    {
        $this->theme->setPageTitle('Create New Category');
        $this->theme->asset()->serve('chosen');
        $data = array(
            'selectValue'=>\Category::withDepth()->having('depth','=',0)->lists('name','id'),
            'icons' => [''=>'']+\Category::$icons
        );
        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Categories', \URL::route('admin/categories'))
            ->add('Create');

        return $this->theme->scope('users.create',$data)->render();
    }

    /**
     * Store a newly created category in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = \Validator::make($data = Input::all(), \Category::$rules);
        if($validator->valid()){
            $attributes = array(
                'name'=>Input::get('name')
            );

            $parentId = Input::get('parent_id');
            if(isset($parentId))
                $parent = \Category::find(Input::get('parent_id'));
            else
                $parent = null;
            $category = \Category::create($attributes,$parent);
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully create new category');
            return \Redirect::route('admin.categories.edit',array('id'=>$category->id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to create new category');
            return \Redirect::route('admin.categories.create')
                ->withErrors($validator)
                ->withInput()
                ->with('messages',$messages);
        }
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return View::make('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = \Category::find($id);
        $this->theme->setPageTitle('Update Category')->setPageSubTitle($category->name);

        $this->theme->asset()->serve('chosen');
        $data = array(
            'selectValue'=>[''=>'']+\Category::withDepth()->having('depth','=',0)->where('id','!=',$id)->lists('name','id'),
            'data'=>$category,
            'icons' => [''=>'']+\Category::$icons
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Categories', \URL::route('admin/categories'))
            ->add($category->name);

        return $this->theme->scope('categories.edit',$data)->render();
    }

    /**
     * Update the specified category in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $validator = \Validator::make($data = Input::all(), \Category::$rules);
        if($validator->valid()){
            $attributes = array(
                'name'=>Input::get('name')
            );

            $category = \Category::find($id);
            $category->update(Input::all());
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully create new category');
            return \Redirect::route('admin.categories.edit',array('id'=>$category->id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to create new category');
            return \Redirect::route('admin.categories.create')
                ->withErrors($validator)
                ->withInput()
                ->with('messages',$messages);
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return Redirect::route('categories.index');
    }

}
