<?
ini_set('memory_limit', '-1');
ini_set("max_execution_time", "1800");
header("Content-Type:text/html;charset=utf-8");
$dir=__DIR__;/*拿到根目录*/
/*先检查系统环境和配置文件的完整性,以防报错*/
if(substr(PHP_VERSION,0,3)<7.0){
	print_r(json_encode(array("code"=>99,"info"=>"此套程序最低支持PHP5.4,您的PHP版本为".substr(PHP_VERSION,0,3)),320));
	header("Location:/error/99.html");
	exit;
}

if (!file_exists($dir.'/system/lib/lib.jar')){ 
	print_r(json_encode(array("code"=>101,"info"=>"系统核心文件丢失,无法进行相关操作"),320));
	header("Location:/error/101.html");
	exit;
}
if (!function_exists("exec")){ 
	print_r(json_encode(array("code"=>104,"info"=>"当前PHP环境不支持此程序的运行,请检查相关安全配置"),320));
	header("Location:/error/104.html");
	exit;
}
$cmd="java 2>&1";
exec($cmd,$out,$var);
if (!$var){ 
	print_r(json_encode(array("code"=>105,"info"=>"无法执行命令行,请检查相关权限"),320));
	exit;
}
if(!strstr(PHP_OS,"WIN")){
	print_r(json_encode(array("code"=>107,"info"=>"此套程序仅支持WIN系统的服务器"),320));
	exit;
}

?>