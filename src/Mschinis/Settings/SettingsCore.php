<?php

namespace Mschinis\Settings;
use \Config,\Lang;
use Mschinis\Settings\Setting\Eloquent\SettingModel as SettingModel;

class SettingsCore {
    private $settingModel;
    private $allSettings;

    public function __construct(){
        $this->settingModel = new SettingModel();
        $this->allSettings = $this->settingModel->all();
    }
    public function all(){
        return $this->allSettings;
    }
    public function get($key,$default = null){
        try{
            $setting = self::getIfExistsOrFail($key);
            return $setting->first()->value;
        }catch (\Exception $e){
            if (isset($default)){
                return $default;
            }
            throw new \Exception("Setting not found.");
        }
    }
    public function getObject($key){
        $setting = self::getIfExistsOrFail($key);
        return $setting;
    }
    public function set($key, $value){
        try{
            $query = new SettingModel();
            $setting = $query->where('key',$key)->firstOrFail();
            $setting->value = $value;
            $setting->save();
        }catch (\Exception $e){
            $newSetting = new SettingModel();
            $newSetting->key = $key;
            $newSetting->value = $value;
            $newSetting->save();
        }
        self::refresh();
    }
    public function forget($key){
        $query = new SettingModel();
        $query->where('key',$key)->delete();
        self::refresh();
    }
    public function exists($key){
        $result = $this->allSettings->filter(function($item) use ($key){
            return $item->key === $key;
        });
        if ($result->count() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function getIfExistsOrFail($key){
        $result = $this->allSettings->filter(function($item) use ($key){
            return $item->key === $key;
        });
        if ($result->count() > 0){
            return $result;
        }else{
            throw new \Exception("Setting not found.");
        }
    }
    public function refresh(){
        $this->allSettings = $this->settingModel->all();
    }
}