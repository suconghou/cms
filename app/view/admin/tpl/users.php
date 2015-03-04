<div id="users">
    <div class="location-bar">
        <ul>
            <li data-show="userlist" class="active">会员列表</li>
            <li data-show="adduser">添加会员</li>
            <li data-show="adduser">最新会员</li>
            <li data-show="adduser">搜索会员</li>
        </ul>
    </div>
    <div class="page-content">
        
        <div id="userlist">
           <table class="table">
                <thead>
                    <tr>
                        <th>用户ID</th>
                        <th>登陆名</th>
                        <th>邮箱</th>
                        <th>注册时间</th>
                        <th>最后活跃</th>
                        <th>昵称</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $item):?>
                    <tr>
                        <td><?=$item['id']?></td>
                        <td><?=$item['username']?></td>
                        <td><?=$item['email']?></td>
                        <td><?=date('Y-m-d H:i:s',$item['regtime'])?></td>
                        <td><?=dateFormat($item['logtime'])?></td>
                        <td><?=$item['nicename']?></td>
                        <td class="<?=ucolor($item['state'])?>">
                            <?=ustate($item['state'])?>
                        </td>
                        <td>
                            <button class="info click" data-page="editshow/<?=$item['id']?>">编辑资料</button>
                            <?php if($item['state']==cms::ustateFreeze):?>
                            <button class="warning click" data-cmd="unfreezeuser" data-id="<?=$item['id']?>">激活用户</button>
                            <?php else:?>
                            <button class="warning click" data-cmd="freezeuser" data-id="<?=$item['id']?>">冻结用户</button>
                            <?php endif;?>
                            <button class="danger click" data-cmd="deleteuser" data-id="<?=$item['id']?>">删除用户</button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="pager">
                <ul class="list">
                    <?php for($i=1;$i<=$page;$i++):?>
                    <li data-page='users/<?=$i?>' <?=$current==$i? 'class="active"' :null ?> ><?=$i?></li>
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