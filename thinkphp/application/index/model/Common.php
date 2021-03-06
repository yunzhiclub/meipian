<?php

namespace app\index\model;

use app\index\model\Paragraph;
use think\File;

class Common
{

    // 通过序列化与反序列化拷贝对象
    public static function deepCopy($oldObject) {
        $n = serialize($oldObject);
        $newObject = unserialize($n);
        return $newObject;
    }

    /**
     * Created by PhpStorm.
     * User: zhangxishuo
     * Date: 2017/8/30
     * Time: 16:54
     * @uploadImage 上传文件
     * @param 需要上传的文件
     * @return 文件存储后的路径
     */
    public static function uploadImage($file)
    {
        $info = $file->validate(['size'=>2048000])->move(PUBLIC_PATH);

        if ($info) {
            return $info->getSaveName();
        } else {
            return $file->getError();
        }
    }
    /**
     * Created by PhpStorm.
     * User: zhuchenshu
     * @uploadImage 克隆图片,将克隆后的图片放在upload/$style/里面
     * @param $dir 原图片地址, $style 上传图片类型
     * @return 文件存储后的路径
     */
    public static function mvImage($dir, $style)
    {
        $fileDir = PUBLIC_PATH.DS.$style.DS;
        $time = intval((time()+microtime())*100).'.jpg'; // 当前时间戳

        if (!is_null($dir)) {
            if(!file_exists($fileDir)) {
                mkdir($fileDir,0777,true);
                fopen($fileDir.$time, 'w');
            }

            if (is_array($dir)) {
                $imagePaths = [];

                foreach ($dir as $key => $value) {
                    // 时间更新比foreach慢，因此让时间戳加上$key以区分文件
                    $time = intval(time()) + $key.'.jpg';
                    copy(PUBLIC_PATH.DS.$value, $fileDir.$time);
                    array_push($imagePaths, DS.$style.DS.$time);
                }
                return json_encode($imagePaths);
            } else {
                copy(PUBLIC_PATH.DS.$dir, $fileDir.$time);
                return DS.$style.DS.$time;
            }
        }
        
        return null;
    }


    // 删除指定文件夹下的图片
    public static function deleteImage($imagePath)
    {
        if($imagePath !== 'upload/') {
            //拼接一个完整的文件路径
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }
    }

    public static function deleteManyImages($imagePaths) {
        $imagePaths = json_decode($imagePaths);
        foreach ($imagePaths as $imagePath) {
            $imagePath = PUBLIC_PATH . '/' .$imagePath;
            self::deleteImage($imagePath);
        }
    }

    // 获取上一页面url
    public static function getPreUrl() {
        return $_SERVER['HTTP_REFERER'];
    }
}