<?php
use \LaravelBook\Ardent\Ardent;
class CustomWebsiteData extends  Ardent {
    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    protected $fillable = ['custom_website_id','data_key','data_value']; //
    protected $guarded = ['id'];
    public static $customAttributes  = array(
        'custom_website_id'=>'Custom Website'
    );

    public static $relationsData = array(
        'custom_website' => array(self::BELONGS_TO,'CustomWebsite'),
    );
    public static $rules = array(
        'data_key'                  => 'required',
        'data_value'                  => '',
        'custom_website_id'                => 'required',
    );

    public static function get_key($id,$key){
        $data = CustomWebsiteData::where('custom_website_id',$id)
                ->where('data_key',$key)
                ->get();
        if($data->count()>0)
            return $data->first()->data_value;
        else
            return false;
    }
    public static function set_key($id,$key,$value){
        $data = CustomWebsiteData::firstOrNew(array(
            'custom_website_id' => $id,
            'data_key' => $key
        ));
        if(isset($value) && strlen($value)>0){
            $data->data_value = $value;
            $data->save();
        }

        return $data->data_value;
    }
}