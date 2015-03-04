<?php
/**
* 后台
* ajax 方法通常以do_开头
*/
class admin
{
	private static $db;
	/**
	 * 此处需设定访问权限
	 */
	function __construct()
	{
		define('SITENAME','CMS网站');
		self::$db=M('cms');
	}
	/**
	 * 后台主页
	 */
	function index()
	{
		V('admin/index');
	}

	/**
	 * 加载模板
	 */
	function tpl($tpl='index',$page=1)
	{
		/**
		 * 有些模板需要提供数据
		 */
		switch ($tpl)
		{
			case 'index':
			case 'system':
				# code...
				break;
			case 'users':
				$data=self::$db->listUser($page);
				break;
			case 'posts':
				$data=self::$db->listPost($page);
				break;
			case 'files':
				$data=self::$db->listFile($page);
				break;
			case 'forum':
				$data['list']=self::$db->getforumList();
				$data['page']=6;
				break;
			default:
				$data=array();
				break;
		}
		// var_dump($data);die;
		$path='admin/tpl/'.$tpl;
		if(is_file(VIEW_PATH.$path.'.php'))
		{
			$data['current']=$page;
			V('admin/tpl/'.$tpl,$data);
		}
		else
		{
			echo "模板不存在".$tpl;
		}
	}


	/**
	 * 管理员退出
	 * @return [type] [description]
	 */
	function do_admin_logout()
	{
		$data=array('code'=>0,'msg'=>'/');
		json($data);
	}

}