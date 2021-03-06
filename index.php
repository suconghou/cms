<?php

define('ROOT',dirname(__FILE__).DIRECTORY_SEPARATOR);//根路径
define('APP_PATH',ROOT.'app'.DIRECTORY_SEPARATOR);//APP路径
define('VAR_PATH',ROOT.'var'.DIRECTORY_SEPARATOR);//缓存路径
define('LIB_PATH',APP_PATH.'system'.DIRECTORY_SEPARATOR);//系统路径
define('MODEL_PATH',APP_PATH.'model'.DIRECTORY_SEPARATOR);//模型路径
define('VIEW_PATH',APP_PATH.'view'.DIRECTORY_SEPARATOR);//视图路径
define('CONTROLLER_PATH',APP_PATH.'controller'.DIRECTORY_SEPARATOR); //控制器路径
require LIB_PATH.'core.php';//载入核心

define('MAX_URL_LENGTH',100); //URL最大长度限制
define('REGEX_ROUTER',1);  //是否启用正则路由

define('DEFAULT_CONTROLLER','home'); //默认的控制器
define('DEFAULT_ACTION','index'); ///默认的动作

define('GZIP',0);  //是否开启GZIP,在SAE若出错请关闭
//0自动记录错误日志(自定义的error和自动捕获的程序错误),不显示错误详情,忽略notice,显示404,500错误页(若已定义).建议上线使用
//1自动记录全部日志(error ,debug 和自动捕获的程序错误),显示错误详情,忽略notice,不使用404,500错误页.建议测试时使用
//2自动记录全部日志(error ,debug 和自动捕获的程序错误),显示错误详情,捕获所有,不使用404,500错误页.建议开发时使用
define('DEBUG',2);

//smtp配置
define('MAIL_SERVER','smtp.126.com');
define('MAIL_PORT',25);
define("MAIL_AUTH",true);
define('MAIL_USERNAME','suconghou@126.com');
define('MAIL_PASSWORD','123456');
define('MAIL_NAME',baseUrl());


//自定义404,500路由,若设定请确保必须存在,系统定义Error404,Error500
define('ERROR_PAGE_404',''); //Error404
define('ERROR_PAGE_500','');//Error500

//mysql数据库配置
define('DB_HOST','127.0.0.1');
define('DB_PORT',3306);
define('DB_NAME','cms');
define('DB_USER','root');
define('DB_PASS','root');

//sqlite 数据库配置
define('SQLITE',APP_PATH.'data.db');
//配置使用何种数据库,0为mysql,1为sqlite
define('DB',0);

///添加一个正则路由,数组第一个为控制器,第二个为方法,前面的将作为该方法的第一个实参,以此类推

app::route('\/page\/(\d{1,9})\.html',array('page','id'));
app::route('\/read\/(\d{1,9})\.html',array('read','id'));
app::route('\/(\d{1,9})\.html',array('home','id'));
app::route('\/fm\/(\d{1,9}).fm',array('fm','id'));
app::route('\/about',array('home','about'));

//也可以添加自动加载,或者加载程序设置
S('functions');//加载扩展函数库
S('app_config');// 加载应用程序配置,你也可以将数据库,正则,smtp等配置信息移入应用设置文件
M('cms');
//配置完,可以启动啦
app::start();


