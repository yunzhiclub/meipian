<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article;
use app\index\model\Common;
use app\index\model\Attraction;
use app\index\model\Plan;
use app\index\model\Paragraph;
use app\index\service\Articleservice;

/**
 * 
 * @authors 朱晨澍、朴世超、张喜硕
 * @date    2017-08-30 09:08:35
 * @version $Id$
 */

class ArticleController extends Controller {

    protected $articleService = null;

    //构造函数实例化ArticleService
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        //实例化服务层
        $this->articleService = new Articleservice();
    }

    public function index()
	{
        $PageSize = config('paginate.var_page');
	    $articles = Article::order('id desc')->paginate($PageSize);
	    $this->assign('articles', $articles);
		return $this->fetch();
	}
    // 返回firstadd界面
    public function firstadd(){
        $id = Request::instance()->param('id/d');
        // 判断是否为重写界面
        if( is_null($id)){
            $this->assign('title', '');
            $this->assign('summery', '');
            $this->assign('cover', '');
            $this->assign('haveid', '');
            return $this->fetch();
        }else{
            $Article = Article::get($id);
            $this->assign('title', $Article->title);
            $this->assign('summery', $Article->summery);
            $this->assign('cover', $Article->cover);
            $this->assign('haveid', $id);
            return $this->fetch();
        }
    }
    // firstadd界面完成后触发时间
    public function addfirst(){

        //接受参数
        $param = Request::instance();

        //调用service中的保存方法
        $message =  $this->articleService->addOrEditAriticle($param);

        //返回相应的界面
        if ($message['status'] === 'success') {
            //跳转成功的界面
            $this->success($message['message'], url($message['route'], ['id' => $message['param']['id']]));

        } else {
            //跳转失败的界面
            $this->error($message['message'], url($message['route']));
        }
    }
    // 返回secondadd界面
    public function secondadd(){
        // 接收参数
        $param = Request::instance();

        // 获取并传输plan
        $id = Request::instance()->param('id');
        $plan = new Plan();
        $plans = $plan->getPlanByArticleId($id);
        $this->assign('plans', $plans);

        // 调用service中的保存方法
        $message =  $this->articleService->secondAriticle($param);
        // 将serve中处理的数据传给前台
        // 标题
        $this->assign('title', $message['title']);
        // 摘要
        $this->assign('summery', $message['summery']);
        // 封面
        $this->assign('cover', $message['cover']);
        // 文章id
        $this->assign('id', $message['id']);
        //景点信息
        $this->assign('attraction', $message['attraction']);
        // 景点数量
        $this->assign('length', $message['length']);
        // 段落（景点上）
        $this->assign('paragraphup', $message['paragraphup']);
        // 段落（景点下）
        $this->assign('paragraphdown', $message['paragraphdown']);
        // 酒店
        $this->assign('hotel',$message['hotel']);
        // 判断是否有酒店
        if(sizeof($message['hotel'])==0){
            $this->assign('judgeHotel','0');
        }else{
            $this->assign('judgeHotel','1');
        }
        // 返回v层数据
    	return $this->fetch();

    }
    public function addsecond(){
        $this->success('文章编辑成功',url('index'));
    }
    public function delete() {
        // 接收参数
        $param = Request::instance();
        //调用service中的方法
        $message =  $this->articleService->deleteAttraction($param);

        $this->success('文章删除成功',url('index'));
    }

    public function preview() {
        return $this->fetch();
    }

    public function upAttraction() {
        // 接收参数
        $param = Request::instance();
        $id = Request::instance()->param('articleId/d');
        //调用service中的方法
        $message =  $this->articleService->upAttraction($param); 
        $this->success('向上排序成功',url('secondadd',['id'=>$id]));
    }
    public function downAttraction() {
        // 接收参数
        $param = Request::instance();
        $id = Request::instance()->param('articleId/d');
        //调用service中的方法
        $message =  $this->articleService->downAttraction($param); 
        $this->success('向下排序成功',url('secondadd',['id'=>$id]));
    }
}