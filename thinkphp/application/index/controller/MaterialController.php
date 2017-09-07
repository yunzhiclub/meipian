<?php
namespace app\index\controller;

use think\Request;
use app\index\controller\IndexController;
use app\index\service\Materialservice;

/**
 * 
 * @authors zhuchenshu
 * @date    2017-09-07 08:52:09
 * @version $Id$
 */

class MaterialController extends IndexController {
	protected $materialService = null;

    //构造函数实例化ArticleService
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        //实例化服务层
        $this->materialService = new Materialservice();
    }
    // 素材管理界面
    public function index() {
    	// 
    	return $this->fetch();
    }
    // 添加界面
    public function add() {
    	return $this->fetch();
    }
    // 添加操作
    public function addOperate() {
    	//接受参数
        $param = Request::instance();

        //调用service中的保存方法
        $message =  $this->materialService->materialAdd($param);
    	// 返回保存的数据
    	//返回相应的界面
        if ($message['status'] === 'success') {
            //跳转成功的界面
            $this->success($message['message'], url($message['route']));

        } else {
            //跳转失败的界面
            $this->error($message['message'], url($message['route']));
        }
    }
    // 编辑操作
    
    /**
     * 素材删除
     */
    public function delete()
    {
        // 接受参数
        $param = Request::instance();

        // 调用Service层的删除方法
        $message = $this->materialService->deleteMaterial($param);

        // 返回相应的结果
        if ($message['status'] === 'success') {
            // 跳转成功界面
            $this->success($message['message'], url($message['route']));

        } else {
            // 跳转失败界面
            $this->error($message['message'], url($message['route']));
        }
    }

    

}