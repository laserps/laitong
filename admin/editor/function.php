<?php
function resizeImage($source, $target, $name, $width) {
	$imageinfo = getImageSize($source);
	if ($imageinfo[0] > $width || $imageinfo[1] > $width) { // ปรับขนาดรูปถ้า $source มีขนาดใหญ่กว่าค่า $width
		//คำนวณขนาดใหม่
		if ($imageinfo[0] <= $imageinfo[1]) { //รูปสูงกว่ากว้าง
			$h = $width;
			$w = round($h * $imageinfo[0] / $imageinfo[1]);
		} else {
			$w = $width;
			$h = round($w * $imageinfo[1] / $imageinfo[0]);
		}
		switch ($imageinfo[mime]) {
		case 'image/gif':
			$o_im = imageCreateFromGIF($source);
			break;
		case 'image/jpg':
		case 'image/jpeg':
		case 'image/pjpeg':
			$o_im = imageCreateFromJPEG($source);
			break;
		case 'image/png':
		case 'image/x-png':
			$o_im = imageCreateFromPNG($source);
			break;
		}
		// สร้าง รูป jpg จากรูปที่ส่งเข้ามา
		$o_wd = @imagesx($o_im);
		$o_ht = @imagesy($o_im);
		
		$t_im = @ImageCreateTrueColor($w, $h); 	// สร้าง image ใหม่ ขนาดที่กำหนดมา
		@ImageCopyResampled($t_im, $o_im, 0, 0, 0, 0, $w + 1, $h + 1, $o_wd, $o_ht); 		// วาดลงบน image ใหม่
		$newname = $name.'.jpg';  		// jpg เท่านั้น
		if (!@ImageJPEG($t_im, $target.$newname)) {
			$ret = false;
		} else {
			$ret[name] = $newname;
			$ret[width] = $w;
			$ret[height] = $h;
		}
		@imageDestroy($o_im);
		@imageDestroy($t_im);
		return $ret;
	} elseif (@copy($source, $target.$name.'.jpg')) {
		$ret[name] = $name;
		$ret[width] = $imageinfo[0];
		$ret[height] = $imageinfo[1];
		return $ret;
	}
	return false;
}

function resizeImageu($source, $target, $name, $width) {
	$imageinfo = getImageSize($source);
	if ($imageinfo[0] > $width || $imageinfo[1] > $width) { // ปรับขนาดรูปถ้า $source มีขนาดใหญ่กว่าค่า $width
		//คำนวณขนาดใหม่
		if ($imageinfo[0] <= $imageinfo[1]) { //รูปสูงกว่ากว้าง
			$w = $width;
			$h = round($w * $imageinfo[1] / $imageinfo[0]);
		} else {
			$h = $width;
			$w = round($h * $imageinfo[0] / $imageinfo[1]);
		}
		switch ($imageinfo[mime]) {
		case 'image/gif':
			$o_im = imageCreateFromGIF($source);
			break;
		case 'image/jpg':
		case 'image/jpeg':
		case 'image/pjpeg':
			$o_im = imageCreateFromJPEG($source);
			break;
		case 'image/png':
		case 'image/x-png':
			$o_im = imageCreateFromPNG($source);
			break;
		}
		// สร้าง รูป jpg จากรูปที่ส่งเข้ามา
		$o_wd = @imagesx($o_im);
		$o_ht = @imagesy($o_im);
		
		$t_im = @ImageCreateTrueColor($w, $h); 	// สร้าง image ใหม่ ขนาดที่กำหนดมา
		@ImageCopyResampled($t_im, $o_im, 0, 0, 0, 0, $w + 1, $h + 1, $o_wd, $o_ht); 		// วาดลงบน image ใหม่
		$newname = $name.'.jpg';  		// jpg เท่านั้น
		if (!@ImageJPEG($t_im, $target.$newname)) {
			$ret = false;
		} else {
			$ret[name] = $newname;
			$ret[width] = $w;
			$ret[height] = $h;
		}
		@imageDestroy($o_im);
		@imageDestroy($t_im);
		return $ret;
	} elseif (@copy($source, $target.$name.'.jpg')) {
		$ret[name] = $name;
		$ret[width] = $imageinfo[0];
		$ret[height] = $imageinfo[1];
		return $ret;
	}
	return false;
}
?>
