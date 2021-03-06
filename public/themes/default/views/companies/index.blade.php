<div id="page-content" class="home-slider-content">
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-md-push-3">
                <div class="page-content company-profile">
                <div class="tab-pane active" id="company-profile">
                <h2>{{$company->name}}</h2>
                <h5>
                    @foreach($company->categories()->get() as $category)
                    <a href="#">{{$category->name}} ,</a>
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
<script>
    jQuery(document).ready(function(){
        $("#company_map_canvas").goMap({

            maptype: 'ROADMAP',
            zoom: 15,
            scrollwheel: false,
            address: '{{ $company->address_1 }},{{$company->address_2}}, {{$company->city}} ',
            markers: [{
                address: '{{ $company->address_1 }},{{$company->address_2}}, {{$company->city}} ',
                icon: '{{URL::to("/themes/default/assets")}}/img/content/map-marker-company.png',
                html: '{{$company->name}}'
            }]
        });

        // gmap for street view
        panorama = GMaps.createPanorama({
            el: '#company_map_canvas_street',
            lat : 37.7762546,
            lng : -122.43277669999998,
        });

    });


</script>