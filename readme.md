# LaravelUserCenter

> Laravel 5.1 + AdminLTE2 + User Management Functions = LaravelUserCenter

> 感谢 Laravel & AdminLTE , 让开发变得这么简单, :-D

### 安装

1. composer install
2. 修改根目录下 .env 文件 , CACHE_DRIVER 请使用 redis / memcached , file 模式不被支持
3. 执行 `php artisan key:generate` , 生成随机 key
4. 执行 `php artisan migrate --seed` , 导入表结构和数据内容
5. 配置 nginx , 指向目录 `public`
6. 完事大吉

### 开发

> 若需要开发, 请留意以下知识点 :

1. Laravel 5.1 
2. AdminLTE2 模板
3. 权限包 Entrust , [文档](https://github.com/Zizaco/entrust) 

### Todo 

<table>
<thead>
    <tr>
        <th>内容</th>
        <th>完成</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>加入 Oauth2.0 接口, 完善 用户中心 概念</td>
        <td>NO</td>
    </tr>
    <tr>
        <td>加入第三方登录</td>
        <td>NO</td>
    </tr>
</tbody>
</table>

### 截图

