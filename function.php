<?php
/*
程序名:PHP一键逆向修改APK系统
源码来自:企业猫源码网 www.qymao.cn
开发环境:PHP7.0+IIS7+WIN7+JAVA1.8
优点:
1.后端直接全自动修改APK
2.直接完整签名
3.支持APK对齐
4.自动检测系统环境
5.提供自定义函数文件,可自由扩展修改APK
6.支持自动清理缓存
7.支持多线程,可同时进行多个任务
8.支持修改包名,名称,图标,版本号,资源文件等
9.支持集成JDK,不会设置环境变量也没问题

如有疑问或需要购买开源,请联系开发者




此文件为自定义函数文件,请自行开发,例如,需要修改APK的哪些地方,都请在此处开发
以下为开放变量
$system_temp_dir 这个变量是此次工程的缓存根目录,
用法,例如,要读取AndroidManifest.xml文件,则完整路径是 $system_temp_dir.'/AndroidManifest.xml'

$system_icon_dir 图标预选目录,也就是icon目录

*/

//示例修改assets资源
$file_dir=$system_temp_dir.'/assets/1.txt';//要修改的文件为1.txt路径,在assets资源中   如果在根目录里,则填写  ./1.txt
$str = fopen($file_dir, 'wb');//用写入的方式打开1.txt文件,不存在就创建,用 $str变量来储存这个打开的文件
$content="https://www.so.com";//需要写入1.txt的内容
fwrite($str, $content);//将要写入的内容二进制写入到$str变量中(也就是打开的/assets/1.txt)文件中	
fclose($str);//因为$str现在是处于打开状态,写完了就需要关闭掉这个文件了

//示例修改应用名称
$file_dir=$system_temp_dir.'/res/values/strings.xml';
$content=str_replace("测试模板","新的名称",file_get_contents($file_dir));//读取修改
$str = fopen($file_dir, 'wb');//开始写入
fwrite($str, $content);
fclose($str);

//示例修改应用包名(新包名不能有中文)
$file_dir=$system_temp_dir.'/AndroidManifest.xml';
$content=str_replace('package="com.ceshimuban"','package="com.new.appp"',file_get_contents($file_dir));//读取修改(包名不可直接替换,而是连着package一起,不然全部替换了报错)
$str = fopen($file_dir, 'wb');//开始写入
fwrite($str, $content);
fclose($str);

//示例修改应用版本号(新版本号不能有中文)
$file_dir=$system_temp_dir.'/apktool.yml';
$content=str_replace("versionName: '1.0'","versionName: '1.0.9.25'",file_get_contents($file_dir));//读取修改
$str = fopen($file_dir, 'wb');//开始写入
fwrite($str, $content);
fclose($str);

//示例修改应用图标
copy($system_icon_dir.'/1.png',$system_temp_dir.'/res/drawable/icon.png');
copy($system_icon_dir.'/1.png',$system_temp_dir.'/res/drawable-hdpi-v4/icon.png');
copy($system_icon_dir.'/1.png',$system_temp_dir.'/res/drawable-xhdpi-v4/icon.png');
copy($system_icon_dir.'/1.png',$system_temp_dir.'/res/drawable-xxhdpi-v4/icon.png');


?>