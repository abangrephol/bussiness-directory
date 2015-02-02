<div id="page-content" class="home-slider-content">
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-md-push-3">
                <div class="page-content company-profile">
                <div class="tab-pane active" id="company-profile">
                <h2>Company Name</h2>
                <h5>
                    @foreach($company->categories()->get() as $category)
                    <a href="#">{{$category->name}}</a>
                    @endforeach
                </h5>

                <div class="social-link text-right">
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>

                <div class="company-text">
                    {{ $company->description }}
                </div> <!-- end company-text -->




                </div>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-9 category-toggle">
                {{ Theme::partial('sidebarCompany') }}
            </div>
        </div>
    </div>
</div>