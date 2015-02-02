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
                    <div class="product-details">
                        <div class="tab-pane active">
                            <h3>Globo <span>Categories</span></h3>
                            <div class="row clearfix">
                                @foreach (\Category::withDepth()->having('depth','=',0)->get() as $category )
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="category-item">

                                        <a href="/companies/{{ $category->slug }}"><i class="fa fa-university"></i>{{ $category->name }}</a>
                                    </div>
                                </div>
                                @endforeach
                                <div class="view-more">
                                    <a class="btn btn-default text-center" href="#"><i class="fa fa-plus-square-o"></i>View More</a>
                                </div>

                            </div>
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