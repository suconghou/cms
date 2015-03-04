// admin.js for cms
window.app=window.app||{};
app.admin=
{
	init:function()
	{
		this.frameInit();
		this.listener();
		this.pageInit();
		$.getScript('/static/js/jquery.tipMessage.js');
	},
	listener:function()
	{

		$(document).on('click','[data-page]',function(e) //注册指令1. data-page 加载页面指令
		{
			e.preventDefault();
			app.admin.pageEvent($(this),e);

		}).on('click','[data-cmd]',function(e) //注册指令2. data-cmd 功能按钮捕获 
		{
			e.preventDefault();
			app.admin.cmdEvent($(this),e);

		}).on('click','[data-show]',function(e) //注册指令3. data-show 显示指令,同时隐藏同级 
		{
			e.preventDefault();
			app.admin.showEvent($(this),e);

		});
	
	},

	// 初始化页面框架 
	frameInit:function()
	{
		// 宽高适应
		(function(){
			var docu=$(document);
			var docuH=docu.height();
			var docuW=docu.width();
			var data={'height':docuH-100,'width':docuW-180};
			$('#wrapper').css(data);
		})();
	},
	pageInit:function()
	{
		var data=app.admin.get('recent');
		var page=app.admin.get('recent-page');
		if(data)
		{
			$('#page-container').html(data);
		}
		else if(page)
		{
			app.admin.loadPage(page,{'event':'pageInit'});
		}
		if(page&&/^\w+$/.test(page))
		{
			$("[data-page="+page||'index'+"]").addClass('active');
		}

	},
	// window.resize 事件绑定
	resize:function()
	{
		app.admin.frameInit();
	},
	pageEvent:function($this,e)
	{
		var page=$this.data('page');
		if($this.parent().hasClass('menu'))
		{
			$this.addClass('active').siblings().removeClass('active');
		}
		if(page)
		{
			app.admin.loadPage(page,{event:'pageEvent'});
		}
	},
	cmdEvent:function($this,e)
	{
		var cmd=$this.data('cmd');
		var fun=app.admin[cmd];
		if(typeof fun == 'function')
		{
			fun($this,e);
		}
	},
	showEvent:function($this,e)
	{
		(function(){
			var id=$this.data('show');
			$this.addClass('active').siblings().removeClass('active');
			$('#'+id).show().siblings().hide();
		})();


	},

	get:function(key)
	{
		return window.localStorage.getItem(key);
	},
	set:function(key,data)
	{
		return window.localStorage.setItem(key,data);
	},
	loadPage:function(page,data,hook)
	{
		var url="/admin/tpl/"+page;
		$('#page-container').load(url,data,function(response,status,xhr)
		{
			if(status=='success')
			{
				if(typeof hook != 'function')
				{
					var hook=function()
					{
						app.admin.set('recent',response);
						app.admin.set('recent-page',page);
					}
				}
				hook(response,status,xhr);
			}
			else
			{
				console.warn('Get Page Error '+url);
			}
		});
	},
	alert:function(msg,type)
	{
		$.tipMessage(msg,type);
	},
	logout:function()
	{
		$.getJSON('/admin/do_admin_logout',function(data){
			if(data.code==0)
			{
				location.href=data.msg;
			}
			else
			{
				$.tipMessage(data.msg,2);
			}
		});
	},
	updateshow:function()
	{
		var id=$(this).data('id');
	},
	updatework:function()
	{

	},
	deleteuser:function($this)
	{
		var id=$this.data('id');
		if(confirm("确认删除用户"+id+"吗?"))
		{
			$.get('/admin/delete/user/'+id,function(data)
			{
				if(data.code==0)
				{
					$.tipMessage(data.msg);
					app.admin.loadPage(app.admin.get('recent-page'));
				}
				else
				{
					$.tipMessage(data.msg,2);
				}

			},'json');
		}
	},
	freezeuser:function($this)
	{
		var id=$this.data('id');
		if(confirm("确认冻结用户"+id+"吗?"))
		{
			$.get('/admin/freeze/user/'+id,function(data)
			{
				if(data.code==0)
				{
					$.tipMessage(data.msg);
					app.admin.loadPage(app.admin.get('recent-page'));
				}
				else
				{
					$.tipMessage(data.msg,2);
				}

			},'json');
		}
	}
}

$(function(){
	app.admin.init();
});
document.addEventListener("DOMContentLoaded", app.admin.resize, false);
window.onresize = app.admin.resize;