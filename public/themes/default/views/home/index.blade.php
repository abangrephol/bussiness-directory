<div id="page-content" class="home-slider-content">
    <div class="container">
        <div class="home-with-slide">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="change-view">
                        <div class="filter-input">
                            <input type="text" placeholder="Filter by Keywords">
                        </div>
                    </div>
                    <div class="product-details-list">
                        <div class="tab-content">
                            <div class="tab-pane active" id="all">
                                <h3>All <span>Categories</span></h3>
                                <div class="row clearfix">
                                    @foreach (\Category::withDepth()->having('depth','>',0)->get() as $subcategory )

                                    <!--div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="category-item">

                                            <a href="/companies/{{ $subcategory->slug }}"><i class="fa fa-university"></i>{{ $subcategory->name }}</a>
                                        </div>
                                    </div-->

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
                                                            <a href="{{ URL::to('/companies/detail/'.$company->id)}}"><i class="fa fa-angle-right"></i> Read More</a>
                                                        </div>

                                                    </figcaption>
                                                </figure>

                                                <h4><a href="{{ URL::to('/companies/detail/'.$company->id)}}">{{ $company->name }}</a></h4>

                                                <h5><a href="#">Category</a>, <a href="#">Another Category</a></h5>

                                                <p>{{ $company->short_description }}</p>

                                                <a class="read-more" href="{{ URL::to('/companies/detail/'.$company->id)}}"><i class="fa fa-angle-right"></i>Read More</a>

                                            </div>
                                        </div>
                                        @endforeach



                                    @endforeach
                                    <div class="view-more">
                                        <a class="btn btn-default text-center" href="#"><i class="fa fa-plus-square-o"></i>View More</a>
                                    </div>

                                </div>
                            </div>
                            @foreach (\Category::withDepth()->having('depth','=',0)->get() as $category )
                            <div class="tab-pane" id="{{ $category->slug }}">
                                <h3>{{ $category->name }}</h3>
                                <div class="row clearfix">
                                    @if($category->getDescendants()->count()>0)
                                    @foreach ($category->getDescendants() as $subcategory )
                                    <!--div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="category-item">

                                            <a href="/companies/{{ $subcategory->slug }}"><i class="fa fa-university"></i>{{ $subcategory->name }}</a>
                                        </div>
                                    </div-->
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
                                                            <a href="{{ URL::to('/companies/detail/'.$company->id)}}"><i class="fa fa-angle-right"></i> Read More</a>
                                                        </div>

                                                    </figcaption>
                                                </figure>

                                                <h4><a href="{{ URL::to('/companies/detail/'.$company->id)}}">{{ $company->name }}</a></h4>

                                                <h5><a href="#">Category</a>, <a href="#">Another Category</a></h5>

                                                <p>{{ $company->short_description }}</p>

                                                <a class="read-more" href="{{ URL::to('/companies/detail/'.$company->id)}}"><i class="fa fa-angle-right"></i>Read More</a>

                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    @endforeach
                                    <div class="view-more">
                                        <a class="btn btn-default text-center" href="#"><i class="fa fa-plus-square-o"></i>View More</a>
                                    </div>
                                    @else
                                    <div class="col-md-3 col-sm-4 col-xs-6">No sub categories</div>
                                    @endif

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="advertisement">
                            <p>Advertisement</p>
                            <img src="{{ URL::to('/themes/default/assets')}}/img/add.jpg" alt="">
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-md-pull-9 category-toggle">
                    {{ Theme::partial('sidebar') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).ready(function(){
        $("#map_canvas").goMap({

            maptype: 'ROADMAP',
            scrollwheel: false,
            zoom: 6,
            markers: [
                {{ $marker }}
            ]
        });
        $.goMap.fitBounds();

    })
</script>