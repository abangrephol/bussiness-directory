<?php
namespace Admin;

use Illuminate\Support\Facades\Input;

class CategoriesController extends BaseController {
    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {
        //return var_dump(\Category::find(6)->getAncestors()->first()->name);
        return \Datatable::collection(\Category::withDepth()->get())
            ->showColumns('name','slug')
            ->addColumn('parent',function($model){
                $parents = '';
                $parentsModel = $model->getAncestors();
                $parentCount = $parentsModel->count();
                foreach( $parentsModel as $parent){
                    $class = 'label-info';
                    //if(\Category::withDepth()->find($parent->id)->depth > 0) $class = 'label-info';
                    $parents .= '<a href="'.route('admin.categories.show',array('id'=>$parent->id))
                        .'" class="mr5 label '.$class.'">'.$parent->name.'</a>';
                    if($parentsModel->last() != $parent) $parents .= '<i class="fa fa-chevron-right text-success mr5" style="padding-top:3px;"></i>';
                }
                return $parents;
            })
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.categories'))->render();
            })
            ->searchColumns('name','slug')
            ->orderColumns('id')
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
        $this->theme->setPageTitle('Categories');

        $routeUrl = 'dt.category';
        $columns = array('Name','Slug','Parent Category','Action');

        $data = array("columns" => $columns,'routeUrl'=>$routeUrl);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/categories'))->add('Categories', \URL::current());
        return $this->theme->scope('categories.index',$data)->render();
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

        return $this->theme->scope('categories.create',$data)->render();
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
