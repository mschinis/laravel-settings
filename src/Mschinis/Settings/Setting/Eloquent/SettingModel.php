<?php
namespace Mschinis\Settings\Setting\Eloquent;

use \Config, \Lang, \Eloquent;

class SettingModel extends Eloquent {
    protected $table;
    protected $fillable = [];
    public $timestamps = false;

    public function __construct(){
        $this->table = Config::get('settings::table');
    }
    public function getDescriptionAttribute($val){
        return Lang::get('settings::'.$val);
    }
}