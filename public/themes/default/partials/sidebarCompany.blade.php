<button><i class="fa fa-briefcase"></i></button>
<div class="page-sidebar company-sidebar">

    <ul class="company-category nav nav-tabs home-tab" role="tablist">
        <li class="active">
            <a href="#company-profile" role="tab" data-toggle="tab"><i class="fa fa-newspaper-o"></i> Profile</a>
        </li>

        <li>
            <a href="#company-product" role="tab" data-toggle="tab"><i class="fa fa-cubes"></i>Product</a>
        </li>

        <li>
            <a href="#company-portfolio" role="tab" data-toggle="tab"><i class="fa fa-file-image-o"></i>Portfolio</a>
        </li>

        <li>
            <a href="#company-events" role="tab" data-toggle="tab"><i class="fa fa-list"></i>Events</a>
        </li>

        <li>
            <a href="#company-blog" role="tab" data-toggle="tab"><i class="fa fa-keyboard-o"></i>blog</a>
        </li>

        <li>
            <a href="#company-contact" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i>Contact</a>
        </li>
    </ul>

    <div class="own-company">
        <a href="#"><i class="fa fa-question-circle"></i>Own This Company</a>
    </div>

    <div class="contact-details">
        <h2>Contact Details</h2>

        <ul class="list-unstyled">
            <li>
                <strong>Name</strong>
                <span>{{ Theme::getCompany()->name }}</span>
            </li>

            <li>
                <strong>Full Address</strong>
                <span>{{ Theme::getCompany()->address_1 }} {{ Theme::getCompany()->address_2 }}</span>
            </li>

            <li>
                <strong>ZIP Code</strong>
                <span>{{ Theme::getCompany()->postcode }}</span>
            </li>

            <li>
                <strong>Phone</strong>
                <span>*********<i class="fa fa-question-circle"></i></span>
            </li>

            <li>
                <strong>Fax</strong>
                <span>*********<i class="fa fa-question-circle"></i></span>
            </li>

            <li>
                <strong>Website</strong>
                <span>{{ Theme::getCompany()->website }}</span>
            </li>

            <li>
                <strong>E-mail</strong>
                <span>{{ Theme::getCompany()->email }}</span>
            </li>

        </ul>
    </div>

    <!--div class="opening-hours">
        <h2>Openig Hours</h2>

        <ul class="list-unstyled">
            <li>
                <strong>Mo-Fr:</strong>
                <span>9AM-5PM</span>
            </li>

            <li>
                <strong>Sa:</strong>
                <span>10AM-3PM</span>
            </li>

            <li>
                <strong>Su:</strong>
                <span>Closed</span>
            </li>
        </ul>
    </div>

    <!--div class="square-button">
        <a href="#"><img src="img/content/square-button.png" alt=""></a>
        <a href="#"><img src="img/content/square-button.png" alt=""></a>
        <a href="#"><img src="img/content/square-button.png" alt=""></a>
        <a href="#"><img src="img/content/square-button.png" alt=""></a>
    </div> <!-- end .sqare-button -->

</div>