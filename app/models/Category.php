<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends \Kalnoy\Nestedset\Node implements SluggableInterface {

    use SluggableTrait;
    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );
	protected $fillable = ['parent_id','name','slug','active'];
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
}