<style type="text/css">
<!--
.style1 {color: #000066}
.style3 {font-weight: bold}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include('smtp.php');
	$name = @$_REQUEST['name'];
	$mail = @$_REQUEST['mail'];
	$dienthoai = @$_REQUEST['dienthoai'];
	$diachi = @$_REQUEST['diachi'];
	$noidung = @$_REQUEST['noidung'];
	$content = '<b>Họ và tên:</b>'.$name.' <br> <b> Email:</b> '.$mail.' <br> <b>Điện thoại:</b>'.$dienthoai.' <br> <b>Địa chỉ:</b>'.$diachi.' <br> <b>Nội dung:</b> '.$noidung;
	
	if($_REQUEST['send']=='gui'){
				//mail('billy@infotechvina.com',$name,$content);
		SendMail("info@xetnghiemadn.net","bengoctu@gmail.com,xetnghiemadn.net@gmail.com",$name,$content);
		echo '<script language="javascript">alert("ĐĂNG KÝ TƯ VẤN THÀNH CÔNG! Chúng tôi Sẽ Gọi Điện Để Tư Vấn Sớm Nhất Có Thể Từ Thứ 2 - 6, Đăng Ký Vào Thứ 7 & Chủ nhật Sẽ Được Xác Nhận Lại Vào Sáng Thứ 2 Tuần Sau - Điện thoại xác nhận: 099 58 58 7 58 __Thanks");</script>';
			$_REQUEST['name']='';
			$_REQUEST['mail']='';
			$_REQUEST['dienthoai']='';
			$_REQUEST['diachi']='';
			$_REQUEST['noidung']='';
		}
	
?>
<script type="text/javascript">
function do_submit()
{
    var form = document.getElementById('contact');
    var err = '';
    if(!form.name.value) err = '- Bạn chưa nhập tên! \n';
	if(!form.diachi.value) err += '- Bạn chưa nhập địa chỉ \n';
	if(!form.dienthoai.value) err += '- Bạn chưa nhập điện thoại \n'
    if(!form.mail.value) err += '- Bạn chưa nhập e-mail \n';
    else{
        reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!form.mail.value.match(reg)) err += '- E-mail không hợp lệ \n ';
    }
	if(!form.noidung.value) err += '- Bạn chưa nội dung \n';
    if(err != ''){
        alert('Lỗi: \n'+err);
        return false;
    }
    else
         form.submit();
}
</script>
<style>

#dangky1 {
    border-radius: 8px 8px 8px 8px;
    color: #FF0000;
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
    height: 46px;
    letter-spacing: 2px;
    line-height: 46px;
    margin-bottom: 10px;
    margin-left: 225px;
    margin-top: 8px;
    padding-left: 15px;
    padding-right: 15px;
}

.tukhoa11 {
    border: 1px solid #009900;
    border-radius: 1px 1px; 
    height: 26px;
    margin-bottom: 1px;
    margin-left: 10px;
    margin-top: 1px;ss
}
.style1 {
	color: #009900;
	font-weight: bold;
}
.style3 {
	color: #000066;
	font-weight: bold;
}
</style>
<form name="contact" id="contact" method="post" action="" style="background-color:#ffffff;">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><div align="center">
      <p><strong style="font-size:28px; color:#009900; text-shadow:white 0 1px 0px, #DDDDDD 0 2px 0;">Đăng Ký Tư Vấn Miễn Phí Qua Điện Thoại</strong></p>
<center><img src="http://cachhoctienganh.net/wp-content/uploads/2012/11/arrow-down.gif" title="arrow-down" alt="arrow-down"/></center>
            </div></td>
  </tr>
  <tr>
    <td width="150">Họ &amp; tên</td>
    <td >
      <input type="text" class="tukhoa11" name="name" value="<?php echo @$_REQUEST['name'];?>" style="width:150px;">   
    </td>
  </tr>
  <tr>
    <td>Số điện thoại </td>
    <td> <input type="text" class="tukhoa11" name="dienthoai" value="<?php echo @$_REQUEST['dienthoai'];?>" style="width:150px;">   </td>
  </tr>
   <tr>
    <td>Thành Phố</td>
    <td> <input type="text" name="diachi" class="tukhoa11" value="<?php echo @$_REQUEST['diachi'];?>" style="width:300px;">   </td>
  </tr>
   <tr>
    <td width="150">E-mail</td>
    <td> <input type="text" name="mail" class="tukhoa11" value="<?php echo @$_REQUEST['mail'];?>" style="width:150px;"> 
    <span style="color:#CC0000;"> Nhập email chính xác - Ví dụ: <em>XetNghiemADN.net@gmail.com</em></span></td>
  </tr>
  <tr>
    <td colspan="2"><p>Nội dung<br>
      <textarea style="margin-left:165px; width:300px;" rows="3" cols="50" name="noidung"><?php echo @$_REQUEST['noidung'];?></textarea>
    </p>
      
      <ul>
        <li>Nếu <span class="style3">Bạn cần tư vấn vui lòng ghi: TƯ VẤN</span></li>
        <li>Nếu được <span class="style3">Bạn có thể ghi luôn câu hỏi bạn đang cần được TƯ VẤN</span></li>
      </ul></td>
  </tr>

  <tr>
    <td colspan="2"><p>
      <input type="submit" id="dangky1" name="submit" value="ĐĂNG KÝ" onClick="return do_submit()" >
      </p>
       <input type="hidden" name="send" value="gui"/>
         <p style="color:#000099; font-weight:bold; font-size:18px;">
        Sau khi nhận được Email chúng tôi sẽ gọi điện cho Bạn để tư vấn MIỄN PHÍ<br />
Email: XetNghiemADN.net@gmail.com
        </p>
      <td>
  </tr>
</table>
 </form>