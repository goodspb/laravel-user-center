# LaravelUserCenter

> Laravel 5.1 + AdminLTE2 + Oauth2.0 + User Management Functions = LaravelUserCenter

> 感谢 Laravel & AdminLTE , 让开发变得这么简单, :-D

### 使用方向

    问: 什么情况可以使用本项目来做开发的基础
    答: 用户中心。公司有多个项目, 但是只需要统一的用户数据。 例如: 商城、App、论坛、网页都用同一套用户体系


### 安装

1. composer install
2. 修改根目录下 .env 文件 , CACHE_DRIVER 请使用 redis / memcached , file 模式不被支持
3. 执行 `php artisan key:generate` , 生成随机 key
4. 执行 `php artisan migrate --seed` , 导入表结构和数据内容
5. 执行 `php artisan ide-helper:generate` , 生成 _ide-helper.php
6. 配置 nginx , 指向目录 `public`
7. 设置 `storage` 和 `bootstrap/cache` 和 `public/upload` 可写权限
8. 完事大吉

### 开发

> 若需要开发, 请留意以下知识点 :

1. Laravel 5.1
2. AdminLTE2 模板
3. 权限包 Entrust , [文档](https://github.com/Zizaco/entrust)
4. Oauth2.0 的原理和规范, 请查看 [阮一峰老师的博文](http://www.ruanyifeng.com/blog/2014/05/oauth_2_0.html)
5. oauth2-server-laravel包, [文档](https://github.com/lucadegasperi/oauth2-server-laravel/tree/master/docs#readme)

### 现在的 Oauth 接口说明

直接查看本项目的 [wiki](https://github.com/goodspb/laravel-user-center)

### Todo List

<table>
<thead>
    <tr>
        <th>内容</th>
        <th>完成</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>加入地址选项</td>
        <td>YES</td>
    </tr>
    <tr>
        <td>加入 Oauth2.0 接口, 完善 用户中心 概念</td>
        <td>YES</td>
    </tr>
    <tr>
        <td>加入号码短讯手机验证</td>
        <td>NO</td>
    </tr>
    <tr>
        <td>加入单元测试</td>
        <td>NO</td>
    </tr>
    <tr>
        <td>加入第三方登录</td>
        <td>NO</td>
    </tr>
</tbody>
</table>

### 截图 

![后台管理页](http://img.goodspb.net/wp-content/uploads/2016/07/%E5%B1%8F%E5%B9%95%E5%BF%AB%E7%85%A7-2016-07-22-%E4%B8%8B%E5%8D%8811.58.09.png)
![授权页面](http://img.goodspb.net/wp-content/uploads/2016/07/屏幕快照-2016-07-22-下午11.57.48.png)
![用户列表](http://img.goodspb.net/wp-content/uploads/2016/07/屏幕快照-2016-07-22-下午11.58.34.png)
![用户资料页](http://img.goodspb.net/wp-content/uploads/2016/07/屏幕快照-2016-07-22-下午11.59.02.png)
![个人资料](http://img.goodspb.net/wp-content/uploads/2016/07/屏幕快照-2016-07-23-上午12.01.03.png)
![授权API调用](http://img.goodspb.net/wp-content/uploads/2016/07/屏幕快照-2016-07-23-上午12.00.28.png)
