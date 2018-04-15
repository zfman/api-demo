# HpuTimetableAPI
[HPU课表]软件的后台对外开放接口

- 收录了河南理工大学2017-2018第二学期的全校课程库
- 23个学院、901个班级、5647个课程、20241条课程记录
- 蹭课功能
- 分享课程
- 扫码导入
- 无需账号登录

### 提示
- 下列接口中的请求地址不是完整的请求地址，API服务已部署在我的服务器上。
	所以使用API时要加上一个基地址`http://www.liuzhuangfei.com/timetable/`
- 下列API的参数请求均为POST方式
- 状态码只需要知道200为成功即可，其他状态时只需要Toast msg的内容即可
- 各个接口的测试页面为`http://www.liuzhuangfei.com/timetable/post.html`,如果返回结果与以下示例有出入，以测试页面结果为准
- 如果想将项目部署在自己的服务器上，要导入数据库结构，数据库是extras文件夹下的timetable.sql文件，建立一个名为timetable的数据库，导入该文件即可.

### API

**1.搜索专业**
```java
Url:
	index.php?c=Timetable&a=findMajor

Params:
	major：关键字

Return Example:（参数 major:软件）
	{
	"code": 200,
	"msg": "成功",
	"data": [{
		"id": "775",
		"name": "软件15-1"
	}, {
		"id": "776",
		"name": "软件15-2"
	}, {
		"id": "777",
		"name": "软件15-3"
	}, {
		"id": "778",
		"name": "软件15-4"
	}, {
		"id": "779",
		"name": "软件16-1"
	}, {
		"id": "780",
		"name": "软件16-2"
	}, {
		"id": "781",
		"name": "软件16-3"
	}, {
		"id": "782",
		"name": "软件16-4"
	}]
}

```


**2.按专业搜索课程**

返回的`data`有两类，`havetime`表示有时间安排的课程,此时`start`,`step`,`day`都不为0,当这三个值为0时表示该课程没有时间安排

`notime`表示没有时间安排的课程,`day=1`表示的是周一上课,`start=1`表示第一节开始,`step=2`表示该课程维持的节数
```java
Url:
	index.php?c=Timetable&a=getByMajor

Params:
	major：专业全称

Return Example:（参数 major:软件15-1）
	{
	"code": 200,
	"msg": "成功",
	"data": {
		"havetime": [{
			"id": "4952",
			"term": "2017-2018学年秋",
			"name": "编译原理",
			"room": "计算机综合楼205",
			"major": "软件15-1",
			"teacher": "陈峰",
			"weeks": "1-12周上",
			"start": "1",
			"step": "2",
			"day": "1"
		}, {
			"id": "4953",
			"term": "2017-2018学年秋",
			"name": "物联网移动应用开发",
			"room": "计算机综合楼202",
			"major": "软件15-1",
			"teacher": "刘永利",
			"weeks": "6-12,14周上",
			"start": "3",
			"step": "2",
			"day": "1"
		}, {
			"id": "4954",
			"term": "2017-2018学年秋",
			"name": "创业基础与就业指导",
			"room": "3号教学楼3303",
			"major": "软件15-1",
			"teacher": "邵水军",
			"weeks": "1-12周上",
			"start": "5",
			"step": "2",
			"day": "1"
		}, {
			"id": "4955",
			"term": "2017-2018学年秋",
			"name": "网络与信息安全",
			"room": "计算机综合楼106",
			"major": "软件15-1",
			"teacher": "汤永利",
			"weeks": "1-6周上",
			"start": "9",
			"step": "2",
			"day": "1"
		}, {
			"id": "4956",
			"term": "2017-2018学年秋",
			"name": "操作系统",
			"room": "计算机综合楼203",
			"major": "软件15-1",
			"teacher": "张磊",
			"weeks": "1-12周上",
			"start": "3",
			"step": "2",
			"day": "2"
		}, {
			"id": "4957",
			"term": "2017-2018学年秋",
			"name": "游戏编程",
			"room": "计算机综合楼110",
			"major": "软件15-1",
			"teacher": "赵英刚",
			"weeks": "1-9周上",
			"start": "9",
			"step": "2",
			"day": "2"
		}, {
			"id": "4958",
			"term": "2017-2018学年秋",
			"name": "编译原理",
			"room": "计算机综合楼205",
			"major": "软件15-1",
			"teacher": "陈峰",
			"weeks": "1-12周上",
			"start": "1",
			"step": "2",
			"day": "3"
		}, {
			"id": "4959",
			"term": "2017-2018学年秋",
			"name": "软件质量保证与测试",
			"room": "计算机综合楼202",
			"major": "软件15-1",
			"teacher": "鲁保云",
			"weeks": "1-12周上",
			"start": "3",
			"step": "2",
			"day": "3"
		}, {
			"id": "4960",
			"term": "2017-2018学年秋",
			"name": "物流管理",
			"room": "经管综合楼1104",
			"major": "软件15-1",
			"teacher": "范志强",
			"weeks": "1-8周上",
			"start": "5",
			"step": "2",
			"day": "3"
		}, {
			"id": "4961",
			"term": "2017-2018学年秋",
			"name": "网络与信息安全",
			"room": "计算机综合楼106",
			"major": "软件15-1",
			"teacher": "汤永利",
			"weeks": "1-6周上",
			"start": "9",
			"step": "2",
			"day": "3"
		}, {
			"id": "4962",
			"term": "2017-2018学年秋",
			"name": "操作系统",
			"room": "计算机综合楼202",
			"major": "软件15-1",
			"teacher": "张磊",
			"weeks": "1-12周上",
			"start": "1",
			"step": "2",
			"day": "4"
		}, {
			"id": "4963",
			"term": "2017-2018学年秋",
			"name": "游戏编程",
			"room": "计算机综合楼110",
			"major": "软件15-1",
			"teacher": "赵英刚",
			"weeks": "1-9周上",
			"start": "3",
			"step": "2",
			"day": "4"
		}, {
			"id": "4964",
			"term": "2017-2018学年秋",
			"name": "物流管理",
			"room": "经管综合楼1104",
			"major": "软件15-1",
			"teacher": "范志强",
			"weeks": "1-8周上",
			"start": "5",
			"step": "2",
			"day": "4"
		}, {
			"id": "4965",
			"term": "2017-2018学年秋",
			"name": "物联网移动应用开发",
			"room": "计算机综合楼106",
			"major": "软件15-1",
			"teacher": "刘永利",
			"weeks": "6-12,14周上",
			"start": "1",
			"step": "2",
			"day": "5"
		}, {
			"id": "4966",
			"term": "2017-2018学年秋",
			"name": "软件质量保证与测试",
			"room": "计算机综合楼202",
			"major": "软件15-1",
			"teacher": "鲁保云",
			"weeks": "1-12周上",
			"start": "3",
			"step": "2",
			"day": "5"
		}, {
			"id": "4967",
			"term": "2017-2018学年秋",
			"name": "形势与政策-5",
			"room": "2号教学楼2106",
			"major": "软件15-1",
			"teacher": "张秀丽",
			"weeks": "6周上",
			"start": "5",
			"step": "4",
			"day": "7"
		}, {
			"id": "4968",
			"term": "2017-2018学年秋",
			"name": "程序设计模式",
			"room": "计算机综合楼202",
			"major": "软件15-1",
			"teacher": "马永强",
			"weeks": "9-12,14-17周上",
			"start": "9",
			"step": "2",
			"day": "1"
		}, {
			"id": "4969",
			"term": "2017-2018学年秋",
			"name": "程序设计模式",
			"room": "计算机综合楼202",
			"major": "软件15-1",
			"teacher": "马永强",
			"weeks": "9-12,14-17周上",
			"start": "9",
			"step": "2",
			"day": "3"
		}],
		"notime": [{
			"id": "201",
			"term": "2017-2018学年秋",
			"name": "当前环境热点问题",
			"room": "",
			"major": "软件15-1",
			"teacher": "王明仕",
			"weeks": "全周上课",
			"start": "0",
			"step": "0",
			"day": "0"
		}]
	}
}

```

**2.按课程名搜索课程**

返回的`data`中,`start`,`step`,`day`都不为0,表示有时间安排的课程,当这三个值为0时表示该课程没有时间安排,`major=null`表示该课是选修课

`day=1`表示的是周一上课,`start=1`表示第一节开始,`step=2`表示该课程维持的节数
```java
Url:
	index.php?c=Timetable&a=getByName

Params:
	name:关键字

Return Example:（参数 name:计算机在化学）
	{
	"code": 200,
	"msg": "成功",
	"data": [{
		"id": "238",
		"term": "2017-2018学年秋",
		"name": "计算机在化学中的应用",
		"room": "理化综合楼207",
		"major": null,
		"teacher": "赵晓雷",
		"weeks": "16周上",
		"start": "3",
		"step": "2",
		"day": "2"
	}, {
		"id": "239",
		"term": "2017-2018学年秋",
		"name": "计算机在化学中的应用",
		"room": "理化综合楼207",
		"major": null,
		"teacher": "赵晓雷",
		"weeks": "10-12,14-15周上",
		"start": "3",
		"step": "2",
		"day": "2"
	}, {
		"id": "247",
		"term": "2017-2018学年秋",
		"name": "计算机在化学中的应用",
		"room": "理化综合楼207",
		"major": null,
		"teacher": "赵晓雷",
		"weeks": "10-12,14-15周上",
		"start": "1",
		"step": "2",
		"day": "4"
	}]
}

```


**3.存储**

本接口可以用于课表扫码导入的功能，当分享课程时，可以将数据存储到数据库，将返回的id生成二维码，当导入时只需要根据该id提取数据即可
```java
Url:
	index.php?c=Timetable&a=putValue

Params:
	value:内容

Return Example:（参数 value:本接口可以用于课表扫码导入的功能，当分享课程时，可以将数据存储到数据库，将返回的id生成二维码，当导入时只需要根据该id提取数据即可"）
	{
	"code": 200,
	"msg": "成功",
	"data": {
		"id": "11314891510b664ac8e20938c9c715ba",
		"value": "本接口可以用于课表扫码导入的功能，当分享课程时，可以将数据存储到数据库，将返回的id生成二维码，当导入时只需要根据该id提取数据即可"
	}
}

```

**4.提取**
```java
Url:
	index.php?c=Timetable&a=getValue

Params:
	id:标识

Return Example:（参数 id:11314891510b664ac8e20938c9c715ba）
	{
	"code": 200,
	"msg": "成功",
	"data": {
		"id": "11314891510b664ac8e20938c9c715ba",
		"value": "本接口可以用于课表扫码导入的功能，当分享课程时，可以将数据存储到数据库，将返回的id生成二维码，当导入时只需要根据该id提取数据即可"
	}
}

```
