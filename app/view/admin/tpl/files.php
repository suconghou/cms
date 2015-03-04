<div id="users">
    <div class="location-bar">
        <ul>
            <li data-show="userlist" class="active">文件列表</li>
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
                        <th>文件ID</th>
                        <th>显示文件名</th>
                        <th>文件路径</th>
                        <th>文件大小</th>
                        <th>文件网址</th>
                        <th>上传时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $item):?>
                    <tr>
                        <td><?=$item['id']?></td>
                        <td><?=$item['filename']?></td>
                        <td><?=$item['filepath']?></td>
                        <td><?=$item['filesize']?></td>
                        <td><?=$item['fileurl']?></td>
                        <td><?=date('Y-m-d H:i:s',$item['upload_time'])?></td>
                        <td>
                            <button class="info click" data-page="editshow/<?=$item['id']?>">编辑信息</button>
                            <button class="danger click" data-cmd="deleteuser" data-id="<?=$item['id']?>">删除文件</button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="pager">
                <ul class="list">
                    <?php for($i=1;$i<=$page;$i++):?>
                    <li data-page='files/<?=$i?>' <?=$current==$i? 'class="active"' :null ?> ><?=$i?></li>
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