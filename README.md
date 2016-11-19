# KTVCMS

##简介

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─index        模块目录
│  │  ├─controller      控制器目录
|  |  |  └─
│  │  ├─model           模型目录
|  |  |  └─
│  ├─command.php        命令行工具配置文件
│  ├─common.php         公共函数文件
│  ├─config.php         公共配置文件
│  ├─route.php          路由配置文件
│  ├─tags.php           应用行为扩展定义文件
│  └─database.php       数据库配置文件
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~

## 项目进度

> `✘`表示未完成、`✔`表示已完成、`~`表示在完善

| 编号 | 功能        | 设计初稿 | 前端界面 | 后台接口  | 数据交互 | 测试   | 微调定稿 |
|:---:| ----------- |:------: |:------:  |:------:  |:------: |:------:| :------:|
| 一、| **【主页】**|    ✔    |    ✔     |         |         |         |         |
| 二、| **【用户】**|        |         |           |         |         |         |
| 1   |    登录     |    ✔  |    ✔    |    ✔      |   ✘     |    ✘    |    ✘    |
| 2   |    注册     |   ✔   |   ✔     |   ~       |   ✘     |    ✘    |    ✘    |
| 3   |  创建房间   |    ✔  |    ✔    |    ✔       |   ✘     |    ✘    |    ✘    |
| 4   |  加入房间   |    ✔   |   ✔     |    ✔      |   ✘     |   ✘     |    ✘    |
| 5  |    退出房间  |    ✔   |   ✔    |    ✔       |   ✘     |   ✘     |    ✘    |
| 6  |    点歌     |    ✔   |   ✔    |    ✘       |   ✘     |   ✘     |    ✘    |
| 7  |    顶歌     |    ✘   |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |   
| 三、| **【歌曲】**|        |         |           |         |         |         |
| 1   |    播放     |   ✔   |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |
| 2   |    上传     |  ✔    |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |
| 3   |    下载     |  ✔    |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |
| 4   | 搜索(按热度)|   ~    |   ~    |     ✘      |   ✘     |   ✘     |    ✘    |
| 5   | 搜索(按拼音)|   ~    |   ~     |    ✘      |   ✘     |   ✘     |    ✘    |
| 6   | 搜索(按类型)|   ~    |   ~     |  ✘        |   ✘     |   ✘     |    ✘    |
| 7   | 搜索(按笔画)|   ~    |   ~     |  ✘        |   ✘     |   ✘     |    ✘    |
| 四、| **【歌手】**|        |         |           |         |         |         |
| 1   |    添加    |   ~     |  ~      |    ✘     |   ✘     |   ✘     |    ✘    |
| 2   | 搜索(按地域) |  ~      |  ~      |   ✘     |   ✘     |   ✘     |    ✘    |
| 五、| **【房间】**|        |         |           |         |         |         |
| 1   |   创建      |  ✘     |   ✘     |    ✔     |   ✘     |   ✘     |    ✘    |
| 2   |   加入      |  ✘     |   ✘    |    ✔     |    ✘    |    ✘    |     ✘   |
| 3   |   查看周围  |   ✘    |    ✘   |      ✔    |    ✘     |   ✘     |    ✘     |      
| 六、   | **【推荐】**| ✘      |  ✘      |  ✘      |    ✘    |  ✘      |   ✘     |


## API

### 用户

* **登录**
  *    地址：`http://localhost/homework/ktvcms/public/user/login`

       * 查询值：`POST`

         ``` json
         {
             "uid":      "账号"
             "passwd":   "密码"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "msg": "ok"
           "data":""
         }
         // error
         http header Status Code: 不为200
         {
           "msg": "具体的信息"
           "data": ""
         }
         ```
* **注册**
  *    地址：`http://localhost/homework/ktvcms/public/user/register`

       * 查询值：`POST`

         ``` json
         {
             "uid":      "账号"
             "username": "昵称"
             "passwd":   "密码"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "msg": "ok"
           "data":""
         }
         // error
         http header Status Code: 不为200
         {
           "msg": "具体的信息"
           "data": "
         }
         ```
