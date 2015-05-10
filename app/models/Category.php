<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends \Kalnoy\Nestedset\Node implements SluggableInterface {

    use SluggableTrait;
    public static $icons = array(
        'fa-building-o' => 'Building',
        'fa-tree' => 'Tree',
        'fa-shopping-cart' => 'Cart',
        'fa-car' => 'Car',
        'fa-briefcase' => 'Briefcase',
        'fa-desktop' => 'Desktop',
        'fa-wrench' => 'Wrench',
        'fa-mortar-board' => 'Mortar Board',
        'fa-bed' => 'Bed',
        'fa-institution' => 'Institution',
        'fa-laptop' => 'Laptop',
        'fa-newspaper-o' => 'Newspaper',
        'fa-paw' => 'Pet',
        'fa-phone' => 'Phone',
        'fa-mobile-phone' => 'Mobile Phone',
        'fa-truck' => 'Truck',
        'fa-child' => 'Child',
        'fa-camera' => 'Camera',
        'fa-beer' => 'Beer',
        'fa-flash' => 'Flash',
        'fa-heart' => 'Heart',
        'fa-home' => 'home',
        'fa-legal' => 'Legal',
        'fa-money' => 'Money',
        'fa-music' => 'Music',
        'fa-diamond' => 'Diamond',
        'fa-book' => 'Book',
        'fa-align-left' => 'Other'
    );
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );
	protected $fillable = ['parent_id','name','slug','active','icon'];
    public static $rules = array(
        'name'                  => 'required|between:4,50',
    );

    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }
    public static function treeBuild($categories){
        //global $tree;
        foreach ($categories as $list ) {

            if ($list->getDescendants()->count()>0) {
                $tree[$list->name] = \Category::treeBuild($list->getDescendants());
            }else{
                $tree[$list->id] = $list->name;
            }
        }
        return  $tree;
    }
    public function companies(){
        return Category::belongsToMany('Company')->withPivot('id');
    }
}