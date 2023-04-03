<?include 'sql.php';?>

<?php
$wwwrootdir=__DIR__;/*拿到根目录*/
$action=$_GET['action'];
if($action=='login'){//登录
	$user=$_POST['user'];
	$pass=md5($_POST['pass']);
	$sql="select * from `rookie_user` where user='$user'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{  
		print_r(json_encode(array("code"=>0,"info"=>"账号不存在","key"=>""),320));	
	}  
    else  
	{
		if($pass!==$row['pass']){
			print_r(json_encode(array("code"=>0,"info"=>"密码错误","key"=>""),320));	
		}else{
			$keys=md5($pass.time());
			$sql="update `rookie_user` SET `keys`='$keys' WHERE `user` = '$user'"; 
			mysqli_query($con,$sql);
			setcookie('keys',$keys);
			print_r(json_encode(array("code"=>200,"info"=>"登录成功","key"=>$keys),320));
		}			
	}  
exit;
}
if($action=='reg'){//注册
	$name=$_POST['name'];
	$user=$_POST['user'];
	$pass=md5($_POST['pass']);
	
	$sql="select * from `rookie_user` where user='$user'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{  
		$sql = "insert into `rookie_user`(name,user,pass) values('$name','$user','$pass')";
		mysqli_query($con,$sql);
		print_r(json_encode(array("code"=>200,"info"=>"注册成功"),320));
	}else{
		print_r(json_encode(array("code"=>0,"info"=>"已存在的账户"),320));
	}
	
exit;	
}
	//注册登录以外的命令,都需要验证key,否则无法调用
	$keys=$_COOKIE['keys'];
	$sql="select * from `rookie_user` where `keys`='$keys'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{  
		//keys不存在
		header("Location:index.php");
	}  
	$userid=$row['id'];
	
if($action=='uppng'){//上传图片
	$appid=$_GET['appid'];
	$png=$_GET['png'];
	if ($_FILES['data']["error"] > 0)
	{
		print_r(json_encode(array("code"=>1,"info"=>"上传失败".$_FILES["data"]["error"]),320));
		
	}else{
		if($_FILES['data']["size"] ==0){
			print_r(json_encode(array("code"=>1,"info"=>"上传失败,文件不能是空白的"),320));exit;
		}
		if(substr($_FILES['data']["name"], strrpos($_FILES['data']["name"], '.')+1)!=='png'){
			print_r(json_encode(array("code"=>1,"info"=>"只能上传png格式的图片"),320));exit;
		}
		if($_FILES['data']["size"] >1024*1024){
			print_r(json_encode(array("code"=>1,"info"=>"只能接受最大1M的图片"),320));exit;
		}
		$file_id='./img/'.md5(time()).'.png';
		$time=time();
		$type=substr($_FILES['data']["name"], strrpos($_FILES['data']["name"], '.')+1);
		copy($_FILES['data']["tmp_name"],$file_id);
		//拿到了图片,向数据库里插入,是谁上传的,路径在哪儿,什么时间上传的
		$img_info = getimagesize($file_id);
		$size=$img_info[0].'*'.$img_info[1];
		$sql = "insert into `rookie_png`(file,type,size,time,userid) values('$file_id','$type','$size','$time','$userid')";
		mysqli_query($con,$sql);
		//插入完了资源库,还要修改项目库
		if($png=="1"){$sql="update `rookie_temp` SET `logo`='$file_id' WHERE `userid` = '$userid' and `id`='$appid'";mysqli_query($con,$sql);}
		if($png=="2"){$sql="update `rookie_temp` SET `openpng`='$file_id' WHERE `userid` = '$userid' and `id`='$appid'";mysqli_query($con,$sql);}
		 
		
		print_r(json_encode(array("code"=>200,"info"=>"上传成功,刷新页面可见"),320));exit;
		
		
		
	}
}
if($action=='delfile'){//删除图片
	$fileid=$_GET['fileid'];
	$sql="select * from `rookie_png` where `userid`='$userid' and `id`='$fileid'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{ 
		print_r(json_encode(array("code"=>1,"info"=>"删除失败,资源不存在"),320));exit;
	}  
	//从数据库删除记录
	$sql="DELETE FROM `rookie_png` where `id`='$fileid'";
	mysqli_query($con,$sql);
	unlink($row['file']);//删除物理文件
	print_r(json_encode(array("code"=>200,"info"=>"删除成功"),320));exit;
}
if($action=='delapp'){//删除项目
	$id=$_GET['id'];
	$sql="select * from `rookie_temp` where `userid`='$userid' and `id`='$id'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{ 
		print_r(json_encode(array("code"=>1,"info"=>"删除失败,资源不存在"),320));exit;
	}  
	//从数据库删除记录
	$sql="DELETE FROM `rookie_temp` where `id`='$id'";
	mysqli_query($con,$sql);
	print_r(json_encode(array("code"=>200,"info"=>$row['name']."删除成功"),320));exit;
}
if($action=='delapk'){//删除项目
	$id=$_GET['id'];
	$sql="select * from `rookie_app` where `userid`='$userid' and `id`='$id'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{ 
		print_r(json_encode(array("code"=>1,"info"=>"删除失败,资源不存在"),320));exit;
	}  
	//从数据库删除记录
	$sql="DELETE FROM `rookie_app` where `id`='$id'";
	mysqli_query($con,$sql);
	unlink($wwwrootdir.$row['down']);
	print_r(json_encode(array("code"=>200,"info"=>$row['name']."删除成功"),320));exit;
}
if($action=='store'){//保存项目
	$api=$_POST['api'];
	$appid=$_GET['appid'];
	$name=$_POST['name'];
	$tion=$_POST['tion'];
	$pack=$_POST['pack'];
	$time=$_POST['time'];
	$keyuser=$_POST['keyuser'];
	$keypass=$_POST['keypass'];
	$list=$_POST['list'];
	$url=$_POST['url'];
	$sql="select * from `rookie_temp` where `userid`='$userid' and `id`='$appid'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{  
		print_r(json_encode(array("code"=>0,"info"=>"您要保存的应用不存在"),320));exit;
	}
	if($api==1)
	{
		$sql="update `rookie_temp` SET `name`='$name',`tion`='$tion',`pack`='$pack',`url`='$url' WHERE userid='$userid' and id='$appid'";mysqli_query($con,$sql);
	}
	if($api==2)
	{
		$sql="update `rookie_temp` SET `opentime`='$time' WHERE userid='$userid' and id='$appid'";mysqli_query($con,$sql);
	}
	if($api==3)
	{
		$sql="update `rookie_temp` SET `keysuser`='$keyuser',`keyspass`='$keypass',`dq`='$list' WHERE userid='$userid' and id='$appid'";mysqli_query($con,$sql);
	}
	$time=time();
	$sql="update `rookie_temp` SET `time`='$time' WHERE `userid`='$userid' and `id`='$appid'"; mysqli_query($con,$sql);
	print_r(json_encode(array("code"=>200,"info"=>"保存完成"),320));exit;
}
if($action=='compile'){//编译项目
	$appid=$_GET['appid'];
	$C_Patch=$_SERVER['DOCUMENT_ROOT'];
	$sql="select * from `rookie_temp` where `userid`='$userid' and `id`='$appid'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result, 3);  
    if (!mysqli_num_rows($result))  
	{  
		print_r(json_encode(array("code"=>0,"info"=>"项目不存在"),320));exit;
	}  
	$dir=$C_Patch .'/user_temp/'.$row['file'];
	if(is_dir($dir)){system_delDir($dir);}//删除缓存
	$appid=$row['id'];
	$sql="update `rookie_temp` SET `state`='生成项目中' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
	copy_dir($C_Patch .'/apk_temp/Template01',$dir);//复制一个项目出来
	if(!is_dir($dir)){print_r(json_encode(array("code"=>0,"info"=>"编译失败"),320));$sql="update `rookie_temp` SET `state`='生成失败' WHERE `id` = '$appid'"; mysqli_query($con,$sql);exit;}//判断目录是否复制成功了
	print_r(json_encode(array("code"=>200,"info"=>"指令提交成功"),320));
	include './code/system.php';//引入修改APK的核心文件
	//开始检测证书
	$sql="update `rookie_temp` SET `state`='正在编译中...',`state_id`='1' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
	
	$system_jar_dir=$wwwrootdir.'/system/lib/lib.jar';//jar文件
	$system_dist_dir=$dir."/dist/".$row['file'].'.apk';//未签名的APK文件路径
	$system_jdk_dir=$wwwrootdir.'/system/jdk/bin/';//JDK路径,命令行之前都要调用此路径
	$cmd="{$system_jdk_dir}java -jar $system_jar_dir b $dir  2>&1";
	exec($cmd,$out,$var);
	unset($out);
	if (!file_exists($system_dist_dir)){ 
		$sql="update `rookie_temp` SET `state`='编译失败',`state_id`='0' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
		if($autotemp){
			system_delDir($dir);//删除生成的缓存
		}
		exit;
	}
	
	$sql="update `rookie_temp` SET `state`='正在签名' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
	//目录,密码,新apk文件路径,未签名的APK文件位置,证书别名
	$system_key_dir=$row['keys'];
	if(!file_exists($row['keys'])){
		$system_key_dir=$wwwrootdir.'/system/keystore/mykey.keystore';
		$key_pass='mykeymykey';
		$key_alias='mykey';
	}
	$time=time();
	$system_sign_dir=$wwwrootdir.'/user_apk/'.md5($row['file'].$time).'.apk';
	$system_dist_dir=$wwwrootdir.'/user_temp/'.$row['file']."/dist/".$row['file'].'.apk';
	$cmd="{$system_jdk_dir}jarsigner -keystore $system_key_dir -storepass $key_pass -signedjar $system_sign_dir $system_dist_dir $key_alias 2>&1";
	exec($cmd,$out,$var);
	unset($out);
	//签名完了,删除缓存目录
	system_delDir($dir);
	//检测新APK是否存在
	if (!file_exists($system_sign_dir)){ 
		$sql="update `rookie_temp` SET `state`='签名失败',`state_id`='0' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
		exit;
	}
	$sql="update `rookie_temp` SET `state`='APK对齐中' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
	if($row['dq']=='true'){
		$system_zipalign_dir=$wwwrootdir.'/system/lib/';//zipalign文件
		$system_sign_dir_dir=$wwwrootdir.'/user_apk/';
		$name=md5($row['file'].$time);
		$cmd="{$system_zipalign_dir}zipalign -v 4 $system_sign_dir {$system_sign_dir_dir}rookie{$name}.apk 2>&1";
		exec($cmd,$out,$var);
		unset($out);
		unlink($system_sign_dir);//删除未对齐的文件
		$system_sign_dir=$system_sign_dir_dir."/rookie{$name}.apk";
		if (!file_exists($system_sign_dir)){ 
		$sql="update `rookie_temp` SET `state`='对齐失败',`state_id`='0' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
		exit;
	}
	}
	
	$sql="update `rookie_temp` SET `state`='等待上传' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
	
	$down="/user_apk/rookie{$name}.apk";
	
	//________________________________________________
	$sql="select * from `rookie_config`";
	$result = mysqli_query($con,$sql);
	$rows = mysqli_fetch_array($result, 3);
	if($rows['upcode']=='true'){
		$cookie="Cookie:phpdisk_info= ".$rows['cookie']." ;";
		//上传到蓝奏云
		$down_lz='';
		copy('.'.$down,'./'.$row['file'].'.apk');
		$data=lanzou_updata('./'.$row['file'].'.apk',$row['name'].'.apk');
		unlink('./'.$row['file'].'.apk');
		if($data==''){
			$data='上传失败01';
		}else{
			$json=json_decode($data,true);
			if($json['info']!=='上传成功'){
				$data='上传失败02';
			}else{
				$data='编译完成';
				$down_lz=$json['text'][0]['is_newd'].'/'.$json['text'][0]['f_id'];
			}
		}
	}else{
		$data='编译完成';
		$down_lz='管理员未启用上传云';
	}
	
	$sql="update `rookie_temp` SET `state`='$data',`state_id`='0' WHERE `id` = '$appid'"; mysqli_query($con,$sql);
	$sql = "insert into `rookie_app`(name,tion,logo,time,pack,down,userid,down_lz) values('{$row['name']}','{$row['tion']}','{$row['logo']}','$time','{$row['pack']}','$down','$userid','$down_lz')";mysqli_query($con,$sql);
}

//________________________________________自定义函数区域
function copy_dir($src,$dst) {
  $dir = opendir($src);
  @mkdir($dst);
  while(false !== ( $file = readdir($dir)) ) {
    if (( $file != '.' ) && ( $file != '..' )) {
      if ( is_dir($src . '/' . $file) ) {
        copy_dir($src . '/' . $file,$dst . '/' . $file);
        continue;
      }
      else {
        copy($src . '/' . $file,$dst . '/' . $file);
      }
    }
  }
  closedir($dir);
}
function system_delDir($dir){//系统内部调用,删除目录
	//先删除目录下的文件：
	$dh=opendir($dir);
	while ($file=readdir($dh)) {
		if($file!="." && $file!="..") {
			$fullpath=$dir."/".$file;
			if(!is_dir($fullpath)){
				unlink($fullpath);
			}else {
				system_delDir($fullpath);
			}
		}
	}
	closedir($dh);
	//删除当前文件夹：
	if(rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}

function lanzou_updata($file_path,$filename){//蓝奏云上传调用方法
	if (!file_exists(iconv('UTF-8','GB2312',$file_path))){ 
		return('本地文件不存在');
		exit;
	}
	$post_data = array(
		"task" => "1",
		"folder_id_bb_n" => "3997965",//上传位置,-1为根目录
		"ve" => "2",
		"id" => "WU_FILE_0",
		//"name" => basename($file_path),
		"name" => $filename,
		"type" => "application/x-msdownload",
		"lastModifiedDate" => "Thu Dec 18 2014 10:03:40 GMT 0800 (中国标准时间)",
		"size" => filesize($file_path),
		"upload_file" => new CURLFile(realpath(basename($file_path)))
	);
	
	return updata("https://pc.woozooo.com/fileup.php",$post_data,$GLOBALS['cookie']);
}
function updata($sUrl,$data,$cookie){//蓝奏云上传函数
    $header = array();
    $user_agent  = 'User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36';
	$header[] = $cookie;
	$oCurl = curl_init();
	curl_setopt($oCurl, CURLOPT_URL, $sUrl);
	curl_setopt($oCurl, CURLOPT_HTTPHEADER,$header);
	curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
	curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($oCurl, CURLOPT_USERAGENT,$user_agent);
	curl_setopt($oCurl, CURLOPT_POST,1);
	curl_setopt($oCurl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($oCurl,CURLOPT_INFILESIZE,$data['size']);
	$handles = curl_exec($oCurl);
	curl_close($oCurl);
	return $handles;
}
?>