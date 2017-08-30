<?php

namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 20:49
 */

class AttractionModel {
    public function saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id) {
        $attraction = new Attraction();
        $attraction->title = $title;
        $attraction->description = $content;
        $attraction->name = $name;
        $attraction->meal = $meal;
        $attraction->car = $car;
        $attraction->guide = $guide;
        $attraction->image = $image;
        $attraction->weight = $this->getAttractionWeight($article_id);
        $attraction->hotel_id = $hotel->id;
        $attraction->article_id = $article_id;
        if(!$attraction->save()) {
            return false;
        } else {
            return true;
        }
    }

    public function getAttractionWeight($article_id) {
        $map = ['article_id' => $article_id];
        $attractions = Attraction::where($map)->select();
        return sizeof($attractions)+1;
    }
}