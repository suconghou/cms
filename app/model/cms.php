<?php
/** 
 * API设计 
 * 数据提供者table::表名(ID)
 * table::wp_posts(1),取得表`wp_posts`ID为1的一行数据为一个数组,此方式必须存在ID字段
 * table::wp_posts($where), $where为键值对的数组,取得条件$where后的结果为一个二维数组
 * table::wp_posts($where,'id,post_title'); 参数二为要取得的元组,默认为*
 * table::wp_posts();空参数取得此表的所有数据
 * table::wp_posts(null,'id,post_title');或者取得指定元组的表所有数据
 * table::tableGeter('wp_posts',1);当表名不合法或为系统关键字时，采用此种方式变通,只需在前面添加一个参数表名
 *
 * table::config('site_name') //获取设置 site_name
 * table::config('site_name','new name'); //设置参数site_name
 * table::config() //空参数,则获取所有的设置为一个一维map数组
 * 
 * 可以直接取得数据库某个表,某一列,某一行,某一条件
 * 魔术函数
 * cms::table()
 * cms::表名()
 */
class cms extends database
{
	const userTable='user';
	const fileTable='file';
	const postTable='post';
	const commentTable='comment';
	const configTable='config';

	/**
	 * 分页大小
	 */
	const pageSize=10;

	/**
	 * 用户的可用状态
	 */
	const ustateDelete=0; //已删除,不可恢复,不删除其关联数据,不解除邮箱占用
	const ustateFreeze=1;  //冻结,不能登录,可以解冻,占用邮箱
	const ustateDefault=2; //默认,注册未验证
	const ustateReg=3; //注册已验证


	public function __construct()
	{
		
	}
	public function __call($method,$args=null)
	{
		
	}

	public function __destruct()
	{
		
	}

	###################################### 数据抽象层 #########################################
	/**
	 * insert or update for config
	 * 
	 */
	function insertOrUpdate($key,$value)
	{
		$sql="INSERT INTO  ".self::configTable." VALUES ('{$key}','{$value}') ON DUPLICATE KEY UPDATE `value`='{$value}' ";
		return $this->runSql($sql);
	}

	public static function aa()
	{

	}



	#################################### 业务逻辑层 ############################################
   
	##################用户相关#####################
	
	function userExist($id)
	{
		return $this->selectById(self::userTable,$id,'id');
	}
	
	function userExistByName($username)
	{
		return $this->selectWhere(self::userTable,array('username'=>$username),' limit 1 ');
	}
	/**
	 * 指定邮箱的用户是否存在
	 */
	function userExistByEmail($email)
	{
		return $this->selectWhere(self::userTable,array('email'=>$email),' limit 1 ');
	}

	function loginUser($email,$password)
	{
		return $this->selectWhere(self::userTable,array('email'=>$email,'password'=>$password));

	}

	function loginUserByName($username,$password)
	{
		return $this->selectWhere(self::userTable,array('username'=>$username,'password'=>$password));
	}
	/**
	 * 更新用户信息
	 */
	function updateUserInfo($id,$arr)
	{
		return $this->updateById(self::userTable,$id,$arr);
	}
	/**
	 * 删除一个用户
	 */
	function deleteUser($id)
	{
		$data=array('state'=>self::ustateDelete);
		return $this->updateById(self::userTable,$id,$data);
	}

	function createUser($username,$password,$email)
	{
		$data['username']=$username;
		$data['password']=$password;
		$data['email']=$email;
		$data['logtime']=$data['regtime']=time();
		return $this->insertData(self::userTable,$data);
	}

	function listUser($page=1,$pageSize=cms::pageSize)
	{
		return $this->getList(self::userTable,$page); 
	}

	#################文章相关######################
	
	function listPost($page=1,$pageSize=cms::pageSize)
	{
		return $this->getList(self::postTable,$page);
	}

	function updatePost($id,$data)
	{

		return $this->updateById(self::postTable,$id,$data);

	}

	function addPostViews($id)
	{
		return $this->incrById(self::postTable,'views',$id);
	}


	###############文件相关#######################
	
	function addFile($data)
	{
		return $this->insertData(self::fileTable,$data);
	}

	function deleteFile($id)
	{
		return $this->deleteById(self::fileTable,$id);
	}

	function updateFile($id,$data)
	{
		return $this->updateById(self::fileTable,$id,$data);
	}

	function listFile($page=1,$pageSize=cms::pageSize)
	{
		return $this->getList(self::fileTable,$page);
	}

	###################################### 其他扩展 ####################################
	





}


/**
* 全部的静态方法调用
*/
final class table extends cms
{

	public function __construct()
	{
		
	}
	
	public function __call($name,$args=null)
	{

	}

	public static function __callStatic($name,$args=null)
	{
		return call_user_func_array(array(__CLASS__,'tableGeter'),array_merge(array($name),$args));
	}

	public function __destruct()
	{

	}

	/**
	 * 取得cms对象实例
	 * @return [type] [description]
	 */
	private static function getCms()
	{
	   return M('cms');
	}
	/**
	 * 数据表映射
	 * @param  [type] $table  [description]
	 * @param  [type] $args   [description]
	 * @param  string $column [description]
	 * @return [type]         [description]
	 */
	public static function tableGeter($table=null,$args=null,$column='*')
	{

		if(is_int($args)||preg_match('/^\d+$/', $args))
		{
			return self::getCms()->selectById($table,$args,$column);
		}
		else if(is_array($args) or !empty($args))
		{
			return self::getCms()->selectWhere($table,$args,null,$column);
		}
		else if(!$args)
		{
			return self::getCms()->selectWhere($table,null,null,$column);
		}
		else
		{
		   return false;
		}
	}
	/**
	 * 映射config表
	 * @return [type] [description]
	 */
	public static function config($key=null,$value=null)
	{
		if(is_null($value)&&$key)
		{
			$cache=app::get("cms::config-{$key}");
			if($cache)
			{
				return $cache;
			}
			else
			{
				$where=array('key'=>$key);
				$ret=self::getCms()->selectWhere(cms::configTable,$where,null,'value');
				$res=isset($ret[0]['value'])?$ret[0]['value']:null;
				is_null($res)||app::set("cms::config-{$key}",$res);
				return $res;
			}
			
		}
		else if(is_string($key))
		{
			return self::getCms()->insertOrUpdate($key,$value);
		}
		else
		{
			$cache=app::get('cms::config');
			if($cache)
			{
				return $cache;
			}
			else
			{
				$ret=self::getCms()->selectWhere(cms::configTable);
				if($ret)
				{
					$res=array();
					foreach ($ret as $item)
					{
						$res[$item['key']]=$item['value'];
					}
					app::set('cms::config',$res);
					return $res;	
				}
				else
				{
					return null;
				}
			}
		}
	}


}