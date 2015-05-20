<h5 class="sidebartitle">Navigation</h5>
<ul class="nav nav-pills nav-stacked nav-bracket">
    <?php
    $user = Sentry::getUser();
    $menusAdmin = array(
        'dashboard' => array(
            'link' => 'dashboard',
            'icon' => 'fa-home',
            'title' => 'Dashboard',

        ),
        'companies' => array(
            'link' => 'companies',
            'icon' => 'fa-building',
            'title' => 'Companies',
            'items' => array(
                array(
                    'link' => 'companies',
                    'icon' => 'fa-building',
                    'title' => 'Companies Lists'
                ),
                array(
                    'link' => 'companies/create',
                    'icon' => 'fa-building',
                    'title' => 'Create Companies'
                ),

            )
        ),
        'custom-website' => array(
            'link' => 'custom-website',
            'icon' => 'fa-building',
            'title' => 'Custom Websites',
            'items' => array(
                array(
                    'link' => 'custom-website',
                    'icon' => 'fa-building',
                    'title' => 'Custom Websites List'
                ),
                array(
                    'link' => 'custom-template',
                    'icon' => 'fa-building',
                    'title' => 'Themes  List'
                ),
            )
        ),
        'categories' => array(
            'link' => 'categories',
            'icon' => 'fa-bookmark',
            'title' => 'Categories'
        ),
    );
    $menusUser = array(
        'dashboard' => array(
            'link' => 'dashboard',
            'icon' => 'fa-home',
            'title' => 'Dashboard',

        ),
        'companies' => array(
            'link' => 'companies',
            'icon' => 'fa-building',
            'title' => 'Edit Companies'
        ),
        'custom-website' => array(
            'link' => 'custom-website',
            'icon' => 'fa-building',
            'title' => 'Custom Websites'
        )
    );


    // Get the user groups
    $group = $user->getGroups()->first()->name;
    if($group=='Admin'){
        $menus = $menusAdmin;
    }elseif($group=="User"){
        $menus = $menusUser;
    }
    foreach($menus as $menu){
        $childShow = 'display:none';

        if(Request::is("admin/".$menu['link']) || Request::is("admin/".$menu['link']."/*")) {
            $active = "active";
            $childShow = 'display:block';
        }
        else {
            $active = '';
        }
        $parent = '';
        if(array_key_exists('items',$menu) && count($menu['items'])>0) $parent = 'nav-parent';
        echo '<li class="' . $active .' '.$parent. '"><a href="' . URL::route("admin/".$menu['link']).'">'
        .'<i class="fa '.$menu['icon'].'"></i><span>' . $menu['title']
        . '</span></a>';
        //echo HTML::clever_link("admin/".$menu['link'], $menu['title'],'fa '.$menu['icon'] );
        if(array_key_exists('items',$menu)){
            echo '<ul class="children" style="'.$childShow.'">';
            foreach($menu['items'] as $menuChild){
                if(Request::path()=='admin/'.$menuChild['link']){ //if(Request::is("admin/".$menuChild['link']) || Request::is("admin/".$menuChild['link']."/*")) { //
                    $active = "class = 'active'";
                }
                else {
                    $active = '';
                }
                echo '<li ' . $active . '><a href="' . URL::to("admin/".$menuChild['link']).'">'
                    .'<i class="fa '.$menuChild['icon'].'"></i><span>' . $menuChild['title']
                    . '</span></a>';
                echo "</li>";
            }
            echo '</ul>';
        }
        echo "</li>";
    }
    ?>


    <!--li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>Forms</span></a>
        <ul class="children" style="display: none;">
            <li><a href="general-forms.html"><i class="fa fa-caret-right"></i> General Forms</a></li>
            <li><a href="form-layouts.html"><i class="fa fa-caret-right"></i> Form Layouts</a></li>
            <li><a href="form-validation.html"><i class="fa fa-caret-right"></i> Form Validation</a></li>
            <li><a href="form-wizards.html"><i class="fa fa-caret-right"></i> Form Wizards</a></li>
            <li><a href="wysiwyg.html"><i class="fa fa-caret-right"></i> Text Editor</a></li>
            <li><a href="code-editor.html"><i class="fa fa-caret-right"></i> Code Editor</a></li>
        </ul>
    </li-->
</ul>