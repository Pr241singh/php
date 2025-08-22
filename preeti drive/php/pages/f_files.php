<?php

session_start();
require("../db.php");

$user_email = $_SESSION['user'];

$user_sql = "SELECT * FROM user_inf WHERE email = '$user_email'";
$user_res = $db->query($user_sql);
$user_data = $user_res->fetch_assoc();

$user_id = $user_data['id'];

$tf = "user_".$user_id;

?>
<h1 class="text-center mt-3 mb-4 my-4">Favourite Files</h1>
	<div class="row">
<?php

$file_data_sql = "SELECT * FROM $tf WHERE star ='yes'";
$file_res = $db->query($file_data_sql);
while($file_array = $file_res->fetch_assoc()) 
{
	$fd_array = pathinfo($file_array['file_name']);
	//pathinfo split file name or extension name
	

	$file_name = $fd_array['filename'];
	$f_ext = $fd_array['extension'];
	$basename = $fd_array['basename'];

	echo '

		<div class="col-md-4">
			<div class="d-flex border align-items-center p-3 mb-3">
				<div class="me-3">';

				if($f_ext == "mp4")
				{
					echo "<img src='images/mp4.png' class='thumb'>";
				}
				else if($f_ext == "mp3")
				{
					echo "<img src='images/mp3.png' class='thumb'>";
				}
				else if($f_ext == "pdf")
				{
					echo "<img src='images/pdf.png' class='thumb'>";
				}
				else if($f_ext == "docx" || $f_ext == "doc")
				{
					echo "<img src='images/doc.png' class='thumb'>";
				}
				else if($f_ext == "xlsx" || $f_ext == "xls")
				{
					echo "<img src='images/xls.png' class='thumb'>";
				}
				else if($f_ext == "pptx" || $f_ext == "ppt")
				{
					echo "<img src='images/ppt.png' class='thumb'>";
				}
				else if($f_ext == "zip")
				{
					echo "<img src='images/zip.png' class='thumb'>";
				}
				else if($f_ext == "txt")
				{
					echo "<img src='images/txt.png' class='thumb'>";
				}
				else if($f_ext == "mov")
				{
					echo "<img src='images/mov.png' class='thumb'>";
				}
				else if($f_ext == "wmv")
				{
					echo "<img src='images/wmv.png' class='thumb'>";
				}
				else if($f_ext == "jpg" || $f_ext == "jpeg" || $f_ext == "png" || $f_ext == "gif" || $f_ext == "webp")
				{
					echo "<img src='data/".$tf."/".$basename."' class='thumb'>";
				}

				echo '</div>
				<div class="w-100">

				<p>'.$file_name.'</p>
				<hr>

				<div class="d-flex justify-content-around w-100">
				<a href="data/'.$tf.'/'.$basename.'" target="blank"><i class="fas fa-eye"></i></a>
				<a href="data/'.$tf.'/'.$basename.'" download="download"><i class="fas fa-download"></i></a>
				<i class="fas fa-trash"></i>';

				if($file_array['star'] == "yes")
				{
					echo '<i class="fas fa-heart text-danger star" status="no" id="'.$file_array['id'].'" folder="'.$tf.'"></i>';
				}
				else
				{
					echo '<i class="fas fa-heart text-secondary star" status="yes" id="'.$file_array['id'].'" folder="'.$tf.'"></i>';
				}
				echo '</div>
				</div>
			</div>
		</div>
	';
}

?>
	</div>

	<script type="text/javascript">
		
		$(".star").each(function()
		{
			$(this).click(function(){
				var star_id = $(this).attr('id');
				var star_status = $(this).attr('status');
				var s_folder = $(this).attr("folder");

				$.ajax({
					type:"POST",
					url:"php/star_files.php",
					data: {
						sid: star_id,
						s_status:star_status,
						s_folder:s_folder
					},
					success:function(response){
						if(response.trim() == "success"){
							$('[p_link="my_files"]').click();
						}
						else
						{
							alert(response);
						}
					}
				})
			})
		})
	</script>


