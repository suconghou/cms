<?php

/**
 * 应用程序设置
 */


/**
 * 根据状态变换背景色
 */
function ucolor($state)
{
	static $ucolorMap=array(
			cms::ustateDelete=>'danger',
			cms::ustateFreeze=>'warning',
			cms::ustateDefault=>'info',
			cms::ustateReg=>'success'
		);
	return isset($ucolorMap[$state])?$ucolorMap[$state]:null;

}

/**
 * 由用户状态转变为字符
 * 需要与m_bbs设置保持一致
 */
function ustate($state)
{
	static $ustateMap=array(
			cms::ustateDelete=>'已删除',
			cms::ustateFreeze=>'已冻结',
			cms::ustateDefault=>'新注册',
			cms::ustateReg=>'已验证'
		);
	return isset($ustateMap[$state])?$ustateMap[$state]:'状态异常';

}
