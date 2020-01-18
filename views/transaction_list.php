<?php
require_once("configs/Constant.php");
?>

<html>
	<head>
        <title>Flip Transaction List</title>        
		<link rel="stylesheet" href="./assets/css/style.css" />
	</head>
	<body>		
		<div>
			<div id="left-box"><h2>Transaction List</h2></div>
			<?php 
				if($counter < 5){ 
					echo '<div id="right-box"> <a href="?action=add" class="button">Send Request</a></div>';
				} 
			 ?>
		</div>
				<table id="trxList"> 
					<tr>
						<th>Request ID</th>
						<th>Status </th>
						<th>Time served</th>
                        <th>Create Date</th>
                        <th>Last Update</th>                        
						<th>Option</th>
					</th>
					<?php 

						foreach ($result as $key => $rows)
						{
                            echo '<tr>
                                    <td>'.$rows['req_id'].'</td>
                                    <td>'.$rows['req_status'].'</td>
                                    <td>'.$rows['time_served'].'</td>
                                    <td>'.$rows['insert_date'].'</td>
                                    <td>'.$rows['update_date'].'</td>
                                    <td align="center">
                                        <a href="?action=update&id='.$rows['autoId'].'" class="button">Update Status</a><br>
                                        <a href="'.$rows['req_receipt'].'" target="_blank" class="button">View Receipt</a>
                                    </td>
                                  </tr>';
						}

					?>
				</table>
			
	</body>
</html>
