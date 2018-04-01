<?php 
include 'dbconnect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Job test</title>
	<style type="text/css">

	table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

table td, table th {
    border: 1px solid #d0dae8;
    padding: 8px;
}

table tr{background-color: #d0dae8;}
table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #d0dae8;}

table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4d8bbe;
    color: white;
}
.colors span{
	cursor: pointer;
}
</style>
</head>
<body>
<table>
	<thead>
	<tr>
		<th>Colors</th>
		<th>Votes</th>
	</tr>
</thead>
<tbody>
	<?php 
$result = $DB->query("SELECT * FROM colors  ");
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
echo "
	 <tr>
	 	<td id='".$row['ID']."' class='colors'><span>".$row['name']."</span></td>
	 	<td></td>
	 </tr>";
}
	 ?>
	 	<tr>
	 		<td id="total">TOTAL</td>
	 		<td id="result"></td>
	 	</tr>
	 </tbody>
</table>
<script type="text/javascript" src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	var total=0;
	jQuery(document).ready(function(){
		jQuery('.colors span').click(function(){
			id=jQuery(this).parent().attr('id');
			var target=jQuery(this).parent().parent().find('td:eq(1)')
			param={ID:id};
			$.post( "ajax/output.php",param, function( data ) {
  					target.text(data);
			});
		})

		jQuery('#total').click(function(){
			
			$.when(jQuery('tbody tr').each(function(){
				if(parseInt(jQuery(this).find('td:eq(1)').text())>0){
					total+=parseInt(jQuery(this).find('td:eq(1)').text());
				}
			})).then(function(){
				jQuery('#result').text(total)
			})

		})
	})
</script>
</body>
</html>