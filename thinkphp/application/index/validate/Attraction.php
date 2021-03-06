<?php

namespace app\index\validate;
use think\Validate;
/**
 * Created by PhpStorm.
 * User: zhuchenshu
 * Date: 17-9-30
 * Time: 下午3:19
 */
class Attraction extends Validate {
    protected $rule = [
        'trip'  => 'require',
        'date'  => 'require',
        // 'guide'  => 'require',
        'description'  => 'require|max:500',
        'meal'  => 'require'
        // 'hotel_id'  => 'require',
    ];

    protected $message = [
        'trip'  => '行程信息不为空',
        'date'  => '日期不为空',
        // 'guide'  => '导游信息不为空',
        'description'  => '描述最多允许添加500字',
        'meal'  => '用餐信息不为空'
        // 'hotel_id'  => '酒店信息不为空'
    ];
}  