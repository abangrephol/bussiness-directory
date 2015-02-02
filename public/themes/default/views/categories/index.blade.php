<div id="page-content" class="home-slider-content">
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-md-push-3">
                <div class="page-content">
                    <div class="product-details-list view-switch">
                        <div class="tab-content">
                            @foreach (\Category::hasParent()->get() as $subcategory)
                            <div class="tab-pane {{ ($slug==$subcategory->slug)?'active':'' }}" id="{{ $subcategory->slug }}">
                                <h2>{{ $subcategory->name }}</h2>
                                <div class="change-view">

                                    <div class="filter-input">
                                        <input type="text" placeholder="Filter by Keywords">
                                    </div>
                                    <button class="grid-view"><i class="fa fa-th"></i></button>
                                    <button class="list-view active"><i class="fa fa-bars"></i></button>

                                    <div class="sort-by">

                                        <div class="uou-custom-select">
                                            <select class="" data-placeholder="-sort by-">
                                                <option value="option1">Name</option>
                                                <option value="option2">Tupe</option>
                                                <option value="option3">Name</option>
                                                <option value="option4">Type</option>
                                            </select>

                                        </div>

                                    </div>

                                    <ul class="pagination">
                                        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>

                                </div>
                                <div class="row clearfix">
                                    @foreach ( $subcategory->companies as $company)
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="single-product">
                                            <figure>
                                                <img src="{{URL::to('/')}}/themes/default/assets/img/content/post-img-1.jpg" alt="">

                                                <div class="rating">

                                                    <ul class="list-inline">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>

                                                    <p>Featured</p>

                                                </div> <!-- end .rating -->

                                                <figcaption>
                                                    <div class="bookmark">
                                                        <a href="#"><i class="fa fa-bookmark-o"></i> Bookmark</a>
                                                    </div>

                                                    <div class="read-more">
                                                        <a href="#"><i class="fa fa-angle-right"></i> Read More</a>
                                                    </div>

                                                </figcaption>
                                            </figure>

                                            <h4><a href="{{ URL::to('/companies/detail/'.$company->id)}}">{{ $company->name }}</a></h4>

                                            <h5><a href="#">Category</a>, <a href="#">Another Category</a></h5>

                                            <p>{{ $company->short_description }}</p>

                                            <a class="read-more" href="#"><i class="fa fa-angle-right"></i>Read More</a>

                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3 col-md-pull-9 category-toggle">
                {{ Theme::partial('sidebarAccordion') }}
            </div>
        </div>
    </div>
</div>