<?php

namespace app\index\model;

use think\Model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 15:37
 */

class Attraction extends Model {
    public function saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id) {
        $this->title = $title;
        $this->description = $content;
        $this->designation = $name;
        $this->meal = $meal;
        $this->car = $car;
        $this->guide = $guide;
        $this->image = $image;
        $this->weight = Attraction::where('article_id', '=', $article_id)->count()+1;
        $this->article_id = $article_id;

        if(!is_null($hotel)){
            $this->hotel_id = $hotel->id;
        }

        if(!$this->save()) {
            return false;
        } else {
            return true;
        }
    }
}