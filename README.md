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
| 6  |    点歌     |    ✔   |   ✔    |    ✔       |   ✘     |   ✘     |    ✘    |
| 7  |    顶歌     |    ✘   |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |   
| 三、| **【歌曲】**|        |         |           |         |         |         |
| 1   |    播放     |   ✔   |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |
| 2   |    上传     |  ✔    |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |
| 3   |    下载     |  ✔    |   ✔     |    ✘      |   ✘     |   ✘     |    ✘    |
| 4   | 搜索(按热度)|   ~    |   ~    |     ✘      |   ✘     |   ✘     |    ✘    |
| 5   | 搜索(按拼音)|   ~    |   ~     |    ✘      |   ✘     |   ✘     |    ✘    |
| 6   | 搜索(按类型)|   ~    |   ~     |  ✘        |   ✘     |   ✘     |    ✘    |
| 7   | 搜索(按笔画)|   ~    |   ~     |  ✘        |   ✘     |   ✘     |    ✘    |
| 8   | 搜索(关键字)|   ~    |   ~     |  ✔        |   ✘     |   ✘     |    ✘    |
| 9   |  播放列表   |   ~    |   ~     |  ✔        |   ✘     |   ✘     |    ✘    |
| 四、| **【歌手】**|        |         |           |         |         |         |
| 1   |    添加    |   ~     |  ~      |    ✘     |   ✘     |   ✘     |    ✘    |
| 2   | 搜索(按地域) |  ~      |  ~      |   ✘     |   ✘     |   ✘     |    ✘    |
| 五、| **【房间】**|        |         |           |         |         |         |
| 1   |   创建      |  ✘     |   ✘     |    ✔     |   ✘     |   ✘     |    ✘    |
| 2   |   加入      |  ✘     |   ✘    |    ✔     |    ✘    |    ✘    |     ✘   |
| 3   |   查看周围  |   ✘    |    ✘   |      ✔    |    ✘     |   ✘     |    ✘     |      
| 六、 | **【推荐】**| ✘      |  ✘      |  ✘      |    ✘    |  ✘      |   ✘     |

## 主色调

- 黑:#121214;
- 橘:#gd3d1a;
- 白:#000000;

## 期限安排

- 开发周期：2016.10.12-2016.12.6
- 测试微调：2016.11.24-2016.12.6(陆续进入测试微调)
- 开启内测：2016.12.7
- 开启公测：2016.12.13
- 发布正式版：2016.12.20

## 人员分工

|         do          |  who                    | 
|:-------------------:| :----------------------:|
| **总体设计、分工和文档写作**|           冯益青          |
| **视觉设计**           |           胡兰心          | 
| **前端开发**           |           伍珍妮     |
| 主页面              |          王海淋          |
| 播放页面            |          胡兰心               |
| **后台开发**             |         刘浩、何畅         |
| 项目测试             |             何畅        |

## API

### 用户

* **登录**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/user/login`

       * 查询值：`POST`

         ``` json
         {
             "uid":      "账号",
             "passwd":   "密码"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status": 200,
           "msg": "ok",
           "data":""
         }
         // error
         http header Status Code: 不为200
         {
           "status": "不为200",
           "msg": "具体的信息",
           "data": ""
         }
         ```
* **注册**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/user/register`

       * 查询值：`POST`

         ``` json
         {
             "uid":      "账号",
             "username": "昵称",
             "passwd":   "密码"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":""
         }
         // error
         http header Status Code: 不为200
         {
           "status": "不为200",
           "msg": "具体的信息",
           "data": ""
         }
         ```

* **搜索(在线)**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/search/get?key=陈奕迅`

       * 查询值：`GET`

         ``` json
         {
             "key":      "搜索的内容,歌曲 歌手均可",
             "page":    "页码"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":[
                {
                    "id":   "歌曲id",
                    "name": "歌曲名",
                    "artists": {
                        "id":   "歌手id",
                        "name": "歌手名字",
                        "pic":  "图片地址"
                    },
                    "album":{
                        "id":   "专辑id",
                        "name": "专辑名"
                    }
                }
           ]
         }
         // error
         http header Status Code: 不为200
         { 
           "status":"不为200",
           "msg": "具体的信息",
           "data": " "
         }
         ```
         
* **专辑详情(在线)**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/search/get_album_info?id=34735139`

       * 查询值：`GET`

         ``` json
         {
             "id":      "专辑id"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":[
                {
                    "id":   "专辑id",
                    "name": "专辑名",
                    "pic":  "图片",
                    "songs":[{
                        "id":   "歌曲id",
                        "name": "歌曲名",
                        "pic":  "图片",
                        "artists":{
                            "id":   "歌手id",
                            "name": "歌手名字",
                            "pic":  "歌手图片"
                        }
                    }
                    ]
                }
           ]
         }
         // error
         http header Status Code: 不为200
         { 
           "status":"不为200",
           "msg": "具体的信息",
           "data": " "
         }
         ```
         
* **歌曲详情(在线)**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/search/music_detail?id=438801672`

       * 查询值：`GET`

         ``` json
         {
             "id":      "歌曲id"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":[
                {
                    "id":   "歌曲id",
                    "name": "歌曲名",
                    "playtime":"播放时间",
                    "url":  "歌曲地址url",
                    "lyric":   "歌词",
                    "pic":  "歌曲图片",
                    "album":{
                        "id":   "专辑id",
                        "name": "专辑名"
                    }
                }
           ]
         }
         // error
         http header Status Code: 不为200
         { 
           "status":"不为200",
           "msg": "具体的信息",
           "data": " "
         }
         ```
         
* **查看附近的房间**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/room/show?page=1`

       * 查询值：`GET`

         ``` json
         {
             "page":      "页码,一页20条,可不传,则默认第一页"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":[
                {   "r_id": "1"     //房间id
                    "name": "123"   //房间名字
                    "creater":"1"   //创建者
                    "status":"1"    //状态 1:使用中  0:未使用
                    "create_time":"2016-11-19 15:34:15" //创建时间
                }
           ]
         }
         // error
         http header Status Code: 不为200
         { 
           "status":"不为200",  
           "msg": "具体的信息",
           "data": ""
         }
         ```
         
         
* **创建房间**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/room/add`

       * 查询值：`POST`

         ``` json
         {
             "name":      "要创建的房间名",
             "uid":       "创建者的uid"
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":{
                "id":   "1",        //房间id
                "name": "123",      //房间名称
                "passwd": "123456"  //房间密码 6位|随机
           }
         }
         // error
         http header Status Code: 不为200
         { 
           "status":"不为200",  // 400:参数错误 403:房间名重复 404:用户账号不存在 
           "msg": "具体的信息",
           "data": ""
         }
         ```
* **加入房间**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/member/join`

       * 查询值：`POST`

         ``` json
         {
             "roomid":"24",      //要加入房间的id
             "uid":"3",          //用户uid
             "passwd":"625102"   //房间密码
         }
         ```

       * 返回值：

         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":""
         }
         // error
         http header Status Code: 不为200
         { 
           "status":"不为200",  // 203:已经在房间 400:参数错误 403:密码错误 404:房间不存在 
           "msg": "具体的信息",
           "data": ""
         }
         ```
         
**退出房间**
  *    地址：`http://ktvcms.xiaohaozi.com.cn/ktv/member/quit`
  
       * 查询值：`POST`
  
         ``` json
         {
             "roomid":"24",      //要加入房间的id
             "uid":"3",          //用户uid
         }
         ```
  
       * 返回值：
  
         ``` json
         // success
         http header Status Code:200 OK
         {
           "status":200,
           "msg": "ok",
           "data":""
         }
         // error
         http header Status Code: 不为200
         { 
           "status":"不为200",  //400:参数错误 401:退出房间异常 404:房间不存在或不在房间内             "msg": "具体的信息",
           "data": ""
         }
         ```