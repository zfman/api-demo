# Scenery

 一个依托于位置、好友等方式的周边美景分享软件的后台API。

### 提示
- 下列接口中的请求地址不是完整的请求地址，API服务已部署在我的服务器上。
	所以使用API时要加上一个基地址`http://www.liuzhuangfei.com/scenery/`，如登录API：
	```java
	http://www.liuzhuangfei.com/scenery/index.php?c=User&a=login
	```
- 以下的接口的返回值可能不是最新的，如果与实际返回值不同，以实际返回值为主,你可以在以下地址页面测试：
[http://www.liuzhuangfei.com/scenery/post.html](http://www.liuzhuangfei.com/scenery/post.html)
- 先登录，每次请求其他接口时需要携带cookie，cookie是有过期时间的
- 下列API的参数请求均为POST方式，未指定的参数类型均为String，返回值类型均为String
- 状态码只需要知道200为成功即可，其他状态时只需要Toast msg的内容即可
- 数据库结构可以参考sql文件夹下的scenery.sql，建立一个名为scenery的数据库，导入该文件即可.
- 如果出现问题，请发Issues : [Scenery-Issues](https://github.com/zfman/Scenery/issues)

### Version
[版本管理](https://github.com/zfman/Scenery/releases)

### API

**1.注册**
```java
Url:
	index.php?c=User&a=register

Params:
	name：昵称
	tel：手机号
	passwd：密码

Return:
	code:Int 状态码
	msg:状态信息

Example:
	{"code":200,"msg":"成功"}

```

**2.登录**
```java
Url:
	index.php?c=User&a=login

Params:
	tel:手机号
	passwd:密码

Return:
	code:Int 状态码
	msg:状态信息
	data:Map
		username:用户昵称

成功时:
	{"code":200,"msg":"成功","data":{"username":"zfman"}}

出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**3.查找用户**
```java
Url:
	index.php?c=User&a=query

Params:
	value：关键字

Return:
	code:Int 状态码
	msg:状态信息
	data:数组元素为以下对象：
		uid:用户ID
		uname:用户昵称
		utel:用户手机号
		uimage:用户头像地址

成功时:
	{"code":200,"msg":"成功","data":[{"uid":"fb0fca095f51ccaa6a20d9f23f2681d4","uname":"liuzhuangfei","utel":"18839161373","uimage":null}]}

出现错误时：
	{"code":300,"msg":"后台处理发生错误"}
	
```

**4.获取个人资料**

返回值应该在下个版本修改为Map，如下：

```java
{"code":200,"msg":"成功","data":{"uid":"56bb813c7638ac210eb8ca4fe4e43d0a","uname":"zfman","utel":"13937267417","uimage":null}]}
```
```java
Url:
	index.php?c=User&a=info

Params:
	无

Return:
	code:Int 状态码
	msg:String 状态信息
	data:Map
		uid:用户Id
		uname:昵称
		utel:手机号
		uimage:图片地址

成功时:
	{"code":200,"msg":"成功","data":{"uid":"56bb813c7638ac210eb8ca4fe4e43d0a","uname":"zfman","utel":"13937267417","uimage":null}]}

出现错误时：
	{"code":300,"msg":"后台处理发生错误"}
	
```

**5.注销登录**
```java
Url:
	index.php?c=User&a=logout

Params:
	无

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**6.修改昵称**
```java
Url:
	index.php?c=User&a=username

Params:
	username:新昵称

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**7.修改密码**
```java
Url:
	index.php?c=User&a=passwd

Params:
	passwd:新密码

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**8.添加好友**
```java
Url:
	index.php?c=Friend&a=add

Params:
	target:待添加用户ID

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**9.好友列表**
```java
Url:
	index.php?c=Friend&a=query

Params:
	无

Return:
	code:Int 状态码
	msg:状态信息
	data:数组元素为以下对象：
		uid:用户ID
		fid:好友ID，删除好友时需要
		uname:用户昵称
		utel:用户手机号
		uimage:用户头像地址

成功时:
	{"code":200,"msg":"成功","data":[{"uid":"2fce00147a76002934a9e04bcd83c729","fid":"9","uname":"壮飞","utel":"18737211793","uimage":null}]}

出现错误时：
	{"code":300,"msg":"后台处理发生错误"}
	
```

**10.删除好友**
```java
Url:
	index.php?c=Friend&a=delete

Params:
	fid:好友ID

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**11.发布Scenery**
```java
Url:
	index.php?c=Scenery&a=publish

Params:
	article:内容
	longitude:Float 经度
	latitude:Float 纬度
	location:位置

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**12.我发布的Scenery**
```java
Url:
	index.php?c=Scenery&a=query

Params:
	无

Return:
	code:Int 状态码
	msg:String 状态信息
	data:数组,
		sid:Scenery Id
		sarticle:内容
		sowner:该Scenery持有者的用户Id
		stime:发布的时间
		slongitude:经度
		slatitude:纬度
		slocation:位置

成功时:
	{"code":200,"msg":"成功","data":[{"sid":"10","sarticle":"这是Scenery","sowner":"56bb813c7638ac210eb8ca4fe4e43d0a","stime":"1519297104","slongitude":"114.578","slatitude":"35.4055","slocation":"白露村"}]}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**13.图片上传**
```java
Url:
	index.php?c=Scenery&a=upload

Params:
	无

Return:
	code:Int 状态码
	msg:String 状态信息
	data:Map,
		url:图片的网络地址
		width:Int 图片的宽度
		height:Int 图片的高度
		info:自定义的地址、宽高的拼接格式，可用其定义Scenery图文混排中的图片格式

成功时:
	{"code":200,"msg":"成功","data":{"url":"http:\/\/119.29.190.39\/scenery\/images\/855ed1787df2ec09a67e7b2c8b072494.png","width":320,"height":320,"info":"![img](http:\/\/119.29.190.39\/scenery\/images\/855ed1787df2ec09a67e7b2c8b072494.png 320 320)"}}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}
	
```

**14.删除Scenery**
```java
Url:
	index.php?c=Scenery&a=delete

Params:
	sid:Scenery Id

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}
```

**15.所有的Scenery**
```java
Url:
	index.php?c=Scenery&a=all

Params:
	无

Return:
	code:Int 状态码
	msg:String 状态信息
	data:数组,
		sid:Scenery Id
		sarticle:内容
		sowner:该Scenery持有者的用户Id
		stime:发布的时间
		slongitude:经度
		slatitude:纬度
		slocation:位置

成功时:
	{"code":200,"msg":"成功","data":[{"sid":"10","sarticle":"这是Scenery","sowner":"56bb813c7638ac210eb8ca4fe4e43d0a","stime":"1519297104","slongitude":"114.578","slatitude":"35.4055","slocation":"白露村"}]}

出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**16.收藏Scenery**
```java
Url:
	index.php?c=Collect&a=collect

Params:
	sid:待收藏的Scenery Id

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```

**17.收藏列表**
```java
Url:
	index.php?c=Collect&a=query

Params:
	无

Return:
	code:Int 状态码
	msg:String 状态信息
	data:数组,
		cid:收藏 Id，取消收藏时有用
		sid:Scenery Id
		sarticle:内容
		sowner:该Scenery持有者的用户Id
		stime:发布的时间
		slongitude:经度
		slatitude:纬度
		slocation:位置

成功时:
	{"code":200,"msg":"成功","data":[{"cid":"4","sid":"10","sarticle":"这是Scenery","sowner":"56bb813c7638ac210eb8ca4fe4e43d0a","stime":"1519297104","slongitude":"114.578","slatitude":"35.4055","slocation":"白露村"}]}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}

```


**18.取消收藏**
```java
Url:
	index.php?c=Collect&a=cancel

Params:
	cid:待取消收藏的收藏 Id

Return:
	code:Int 状态码
	msg:String 状态信息

成功时:
	{"code":200,"msg":"成功"}
	
出现错误时：
	{"code":300,"msg":"后台处理发生错误"}
```


### 状态码
|code         | msg|
| :-----: | :-----:|
| 200|  成功 |
| 300|  后台处理发生错误 |
| 301|  参数不全,请补充完整 |
| 302|  密匙错误,请联系1193600556@qq.com |
| 303|  你还没登录 |
| 304|  cookie过期，请重新登录 |
| 305|  未知异常|
| 306|  数据库连接失败 |
| 307|  本手机号已注册 |
| 308|  账号或密码错误 |
| 309|  好友不存在 |
| 310|  对方已是你的好友 |
| 320|  文件类型错误！只允许上传PNG|JPG|JPEG|GIF |
| 321|  文件损坏，请重试! |
| 322|  查询的id无效 |
| 323|  没有操作的权限或对象不存在 |
| 324|  已处于在线状态 |
| 325|  不能添加自己为好友 |
| 326|  不能与原值相同 |
