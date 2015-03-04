<?php

/**
* 通用文件上传接口
* 通用文件下载接口
*/
class upload
{
	
	function __construct()
	{
		
	}
	/**
	 * 默认上传到本地
	 * @return [type] [description]
	 */
	function index()
	{
		$this->upload();
	}
	/**
	 * 文件上传表单名为upfile
	 * @return [type] [description]
	 */
	function upload()
	{
		$ret=S('class/uploader')->upload('upfile');
		//上传成功
		if($ret['code']==0)
		{
			$filepath=ltrim($ret['msg'],baseUrl());
			$filesize=byteFormat(filesize($filepath));
			$data=array(
				'filepath'=>$filepath,
				'filesize'=>$filesize,
				'fileurl'=>$ret['msg'],
				'upload_time'=>time()
				);
			M('cms')->addFile($data);
		}
		json($ret);
	}

	function download($id=null)
	{

	}
}