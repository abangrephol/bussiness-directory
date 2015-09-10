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
        $this->theme->setPageTitle('Create New User');
        $this->theme->asset()->serve('chosen');
        $groupsData = Sentry::findAllGroups();
        $groups = [];
        foreach($groupsData as $group){
            $groups[$group->id] = $group->name;
        }
        $data = array(
            'groups'=> $groups
        );
        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Users', \URL::route('admin/users'))
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
        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password'),
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'activated' => true,
            ));

            // Find the group using the group id
            $group = Sentry::findGroupById(Input::get('group'));

            // Assign the group to the user
            $user->addGroup($group);
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully create new user');
            return \Redirect::route('admin.users.edit',array('id'=>$user->id))->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'Login field is required.');
            return \Redirect::route('admin.users.create')->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {

            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'Password field is required.');
            return \Redirect::route('admin.users.create')->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $message = 'User with this login already exists.';
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'User with this login already exists.');
            return \Redirect::route('admin.users.create')->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $message = 'Group was not found.';
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'Group was not found.');
            return \Redirect::route('admin.users.create')->with('messages',$messages);
        }

        /*$validator = \Validator::make($data = Input::all(), \Category::$rules);
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
        }*/
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
        $user = Sentry::findUserById($id);
        $user->group_id = $user->getGroups()->first()->id;
        $this->theme->setPageTitle('Update User')->setPageSubTitle($user->first_name);

        $this->theme->asset()->serve('chosen');
        $groupsData = Sentry::findAllGroups();
        $groups = [];
        foreach($groupsData as $group){
            $groups[$group->id] = $group->name;
        }
        $data = array(
            'data'=>$user,
            'groups'=> $groups
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Categories', \URL::route('admin/categories'))
            ->add($user->first_name);

        return $this->theme->scope('users.edit',$data)->render();
    }

    /**
     * Update the specified category in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try
        {
            // Create the user
            $user = Sentry::findUserById($id);


            $user->email     = Input::get('email');
            $user->password  = Input::get('password');
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');



            // Find the group using the group id
            $curGroup = $user->getGroups()->first();

            $group = Sentry::findGroupById(Input::get('group'));

            // Assign the group to the user

            if ($user->removeGroup($curGroup))
            {
                $user->addGroup($group);
            }
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully update user');
            return \Redirect::route('admin.users.edit',array('id'=>$user->id))->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'Login field is required.')->add('error',true);
            return \Redirect::route('admin.users.edit',array('id'=>$user->id))->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {

            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'Password field is required.')->add('error',true);
            return \Redirect::route('admin.users.edit',array('id'=>$user->id))->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $message = 'User with this login already exists.';
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'User with this login already exists.')->add('error',true);
            return \Redirect::route('admin.users.edit',array('id'=>$user->id))->with('messages',$messages);
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $message = 'Group was not found.';
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'Group was not found.')->add('error',true);
            return \Redirect::route('admin.users.edit',array('id'=>$user->id))->with('messages',$messages);
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
