<?php

namespace app\index\controller;

use app\index\model\Common;
use app\index\model\Hotel;
use app\index\service\HotelService;
use think\Request;

/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/9/12
 * Time: 9:30
 */

class HotelController extends IndexController {

    function __construct(Request $request = null) {
        parent::__construct($request);

        $this->HotelService = new HotelService();
    }

    public function index() {
        $city = Request::instance()->get('city');

        $Hotel = new Hotel();

        if (!empty($city)) {
            $Hotel->where('city', 'like', '%' . $city . '%');
        }
        $pageSize = config('paginate.var_page');

        // 按条件查询并调用分页
        $hotels = $Hotel->order('id desc')->paginate($pageSize, false, [
            'query' =>[
                'city' => $city,
                ],
                'var_page' => 'page',
            ]);

        $this->assign('common', new Common());
        $this->assign('hotels', $hotels);
        return $this->fetch();
    }

    public function add() {
        $hotel = $this->HotelService->getNullHotel();

        $this->assign('hotel', $hotel);
        return $this->fetch();
    }

    public function save() {
        $param = Request::instance();
        $message = $this->HotelService->saveHotel($param);

        if($message['status'] == 'success') {
            return $this->success($message['message'], url('hotel/index'));
        } else {
            return $this->error($message['message'], url('hotel/index'));
        }
    }

    public function edit() {
        $hotelId = Request::instance()->param('hotelId');
        $hotel = Hotel::get($hotelId);

        $this->assign('hotel', $hotel);
        return $this->fetch('add');
    }

    public function update() {
        $param = Request::instance();
        $message = $this->HotelService->updateHotel($param);

        if($message['status'] == 'success') {
            return $this->success($message['message'], url('hotel/index'));
        } else {
            return $this->error($message['message'], url('hotel/index'));
        }
    }

    public function delete() {
        $param = Request::instance();
        $message = $this->HotelService->deleteHotel($param);
        if($message['status'] == 'success') {
            return $this->success($message['message'], url('hotel/index'));
        } else {
            return $this->error($message['message'], url('hotel/index'));
        }
    }
}