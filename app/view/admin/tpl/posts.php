<div id="users">
    <div class="location-bar">
        <ul>
            <li data-show="postlist" class="active">帖子列表</li>
            <li data-show="addpost">添加帖子</li>
            <li data-show="adduser">搜索帖子</li>
            <li data-show="adduser">帖子回收站</li>
        </ul>
    </div>
    <div class="page-content">
        
        <div id="postlist">
           <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>标题</th>
                        <th>邮箱</th>
                        <th>发表时间</th>
                        <th>更新时间</th>
                        <th>浏览量</th>
                        <th>回复数</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $item):?>
                    <tr>
                        <td><?=$item['id']?></td>
                        <td><?=$item['title']?></td>
                        <td><?=$item['title']?></td>
                        <td><?=date('Y-m-d H:i:s',$item['create_time'])?></td>
                        <td><?=date('Y-m-d H:i:s',$item['update_time'])?></td>
                        <td><?=$item['views']?></td>
                        <td><?=$item['state']?></td>
                        <td>
                            <button class="info click" data-page="editshow/<?=$item['id']?>">编辑帖子</button>
                            <button class="warning click" data-cmd="lockpost" data-id="<?=$item['id']?>">锁定帖子</button>
                            <button class="danger click" data-cmd="deletepost" data-id="<?=$item['id']?>">删除帖子</button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="pager">
                <ul>
                    <?php for($i=1;$i<=$page;$i++):?>
                    <li data-page='posts/<?=$i?>' <?=$current==$i? 'class="active"' :null ?> ><?=$i?></li>
                    <?php endfor;?>
                </ul>
            </div>
        
        </div>      
        <div id="addpost" class="hide">
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