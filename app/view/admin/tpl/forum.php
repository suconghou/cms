<div id="users">
    <div class="location-bar">
        <ul>
            <li data-show="userlist">板块列表</li>
            <li data-show="adduser">添加板块</li>
        </ul>
    </div>
    <div class="page-content">
        
        <div id="userlist">
           <table class="table">
                <thead>
                    <tr>
                        <th>板块ID</th>
                        <th>版块名称</th>
                        <th>板块图标</th>
                        <th>版主列表</th>
                        <th>创建时间</th>
                        <th>描述</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $item):?>
                    <tr>
                        <td><?=$item['id']?></td>
                        <td><?=$item['name']?></td>
                        <td><img src="<?=$item['logo']?>" class="forum-logo-sm" alt=""></td>
                        <td><?=$item['manager_id']?></td>
                        <td><?=date('Y-m-d H:i:s',$item['create_time'])?></td>
                        <td><?=$item['description']?></td>
                        <td><?=$item['state']?></td>
                        <td>
                            <button class="info click" data-page="editshow/<?=$item['id']?>">编辑板块</button>
                            <button class="warning click" data-cmd="deleteshow" data-id="<?=$item['id']?>">停用板块</button>
                            <button class="danger click" data-cmd="deleteshow" data-id="<?=$item['id']?>">删除板块</button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="pager">
                <ul>
                    <?php for($i=1;$i<=$page;$i++):?>
                    <li><?=$i?></li>
                    <?php endfor;?>
                </ul>
            </div>
        
        </div>      
        <div id="adduser" class="hide">
            <div class="padding-box">
                <p>
                    <label for="">用户名:</label>
                    <input type="text" placeholder="用户名">
                </p>
                <p>
                    <label for="">密码:</label>
                    <input type="text" placeholder="密码">
                </p>
                <p>
                    <label for="">积分:</label>
                    <input type="text" placeholder="积分">
                </p>
                <p>
                    <button class="success">添加用户</button>
                </p>
            </div>
        </div>     
        

    </div>
</div>