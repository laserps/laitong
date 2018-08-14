<?php 
require_once("thumbnail.inc.php");
function FC_GENID(){
$GEN_TIME=time();
$GEN_RAND=rand(11111,99999);
$GEN_NAME=md5($GEN_TIME.$GEN_RAND);
return $GEN_NAME;
}
function upLoadimage($fileupload,$fileupload_name,$path,$pic1_w,$pic1_h,$pic2_w,$pic2_h){
if(!empty($fileupload)){
    $path_parts=pathinfo($fileupload_name);
    $lastname=$path_parts["extension"];
    if($lastname=='gif' or $lastname=='jpg' or $lastname=='jpeg' or $lastname=='png' or $lastname=='bmp' or $lastname=='swf'){
        $file_tmp=$path.'tmp_image.'.$lastname;
        @copy($fileupload,$file_tmp);
        @unlink($fileupload);

        $ori_size=getimagesize($file_tmp);
        $ori_w = $ori_size[0];
        $ori_h = $ori_size[1];

        $GEN_NAME=FC_GENID().'.'.$lastname;
		///รูปหนึ่ง/////
        $thumb = new Thumbnail($file_tmp);
        if($ori_w > $pic1_w or $ori_h > $pic1_h){$thumb->resize($pic1_w,$pic1_h);}
        $thumb->save($path.$GEN_NAME);
		//รูป2/////
        $thumb = new Thumbnail($file_tmp);
        if($ori_w > $pic2_w or $ori_h > $pic2_h){$thumb->resize($pic2_w,$pic2_h);}
        $thumb->save($path.'../thumb/'.$GEN_NAME);
		///
		//
        @unlink($file_tmp);
        return $GEN_NAME;
    }
}}
?>