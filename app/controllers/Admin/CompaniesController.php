<?php
namespace Admin;

class CompaniesController extends BaseController {
    /**
     * Display a listing of the resource.
     * GET /dt/users
     *
     * @return Response
     */
    public function getDatatableAll()
    {

        return \Datatable::collection(\Company::all())
            ->showColumns('name','contact_name','phone')
            ->addColumn('action',function($model){
                return \Theme::widget("buttonColumn", array("model" => $model,'route'=>'admin.companies'))->render();
            })
            ->searchColumns('name','contact_name','phone')
            ->orderColumns('name','contact_name','phone')
            ->make();
    }
	/**
	 * Display a listing of the resource.
	 * GET /companies
	 *
	 * @return Response
	 */
	public function index()
	{
        $this->theme->asset()->serve('datatable');
        $this->theme->setPageTitle('Companies');

        $routeUrl = 'dt.company';
        $columns = array('Company Name','Contact','Telephone','Action');

        $data = array("usersColumn" => $columns,'routeUrl'=>$routeUrl);

        $this->theme->breadcrumb()->add('Dashboard', \URL::route('admin/dashboard'))->add('Companies', \URL::current());
        return $this->theme->scope('companies.index',$data)->render();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /companies/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->theme->setPageTitle('Create New Company');
        $this->theme->asset()->serve('tags');
        $this->theme->asset()->serve('ckeditor');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('gmap');

        $data = array(
            'state'=> \State::getState(189),
            'category'=>\Category::treeBuild(\Category::withDepth()->having('depth','=',0)->get()),
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add('Create');

        return $this->theme->scope('companies.create',$data)->render();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /companies
	 *
	 * @return Response
	 */
	public function store()
	{
		$company = new \Company;
        if($company->validate()){
            $company->save();
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully create new company');
            return \Redirect::route('admin.companies.edit',array('id'=>$company->id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to create new company');
            return \Redirect::route('admin.companies.create')
                ->withErrors($company->errors())
                ->withInput()
                ->with('messages',$messages);
        }
	}

	/**
	 * Display the specified resource.
	 * GET /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $this->theme->breadcrumb()->add('label', 'http://...')->add('label2', 'http:...');
        return $this->theme->scope('site.index')->render();
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /companies/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$company = \Company::find($id);
        $this->theme->setPageTitle('Update Company')->setPageSubTitle($company->name.' by '.$company->contact_name);

        $this->theme->asset()->serve('tags');
        $this->theme->asset()->serve('ckeditor');
        $this->theme->asset()->serve('chosen');
        $this->theme->asset()->serve('gmap');

        $categories = $company->categories()->get(['categories.id']);
        $tmp = array();
        foreach($categories as $category){
            $tmp[] = $category->id;
        }
        $data = array(
            'state'=> \State::getState(189),
            'data'=>$company,
            'category'=>[''=>'']+\Category::treeBuild(\Category::withDepth()->having('depth','=',0)->get()),
            'categories'=>$tmp
        );

        $this->theme->breadcrumb()
            ->add('Dashboard', \URL::route('admin/dashboard'))
            ->add('Companies', \URL::route('admin/companies'))
            ->add($company->name);

        return $this->theme->scope('companies.edit',$data)->render();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //dd(\Input::get('categories'));
        $company = \Company::find($id);
        if($company->validate()){
            $company->save();
            $company->categories()->withTimestamps()->sync(array_filter(\Input::get('categories')));
            $messages = new \Illuminate\Support\MessageBag;
            $messages->add('message', 'You have successfully update company info');
            return \Redirect::route('admin.companies.edit',array('id'=>$id))->with('messages',$messages);
        }else{
            $messages = new \Illuminate\Support\MessageBag;
            $messages
                ->add('error',true)
                ->add('message', 'Failed to update company');
            return \Redirect::route('admin.companies.edit',array('id'=>$id))

                ->withErrors($company->errors())
                ->withInput()
                ->with('messages',$messages);
        }

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}