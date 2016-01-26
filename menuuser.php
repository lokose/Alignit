<?php
        include 'class.php';
        $a = new usuario();
        $a->sessionstarter();
	?>
<!DOCTYPE html> 
<html> 
<head>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <title>Menu User</title><br><br> 
    <link type="text/css" rel="stylesheet" href="css.css">
</head> 
<body>  
<div class="col-md-1"></div><div class="col-md-4">
	
	<h3>It Assets</h3><br>
	<table id='IT' > </table><br>
	
	<?php 
	if($a->edit == 1){
		echo "<a href = 'Crearit.php'>Create a IT Assets</a><br>";
	}
	?>
	<br><a href = 'GranIT.php'><input type='submit' value=' See It Assets'></a>

</div><div class="col-md-2"></div><div class="col-md-4">

	<h3>Business Objectives</h3><br>
	<table id='BU' > </table><br>
	
	<?php 
	if($a->edbu == 1){
		echo "<a href = 'Crearbu.php'>Create a Business Objectives</a><br>";
	}
	?>
	<br><a href = 'GranBU.php'><input type='submit' value=' See Business Objectives'> </a>


</div><div class="col-md-1"></div>

<script language="javascript" type="text/javascript" src ="jquery-2.1.4.min.js"></script>
<script type="text/javascript">

	$.ajax({
	 type: 'POST',
	 url: 'ajaxit.php',
	 dataType: 'json',
	 success: function (response) {
		var trHTML =
		'<tr><th>Name</th><th>Budget</th><th>Headcount</th><th>Update</th><th>Detail</th><th>Delete</th></tr>';
		for(var f=0;f<response.length;f++){
			trHTML += '<tr id="'+response[f]['id']+'">'+
			'<td>'+response [f]['name']+'</td>'+
			'<td>'+response [f]['budget']+'</td>'+
			'<td>'+response [f]['headcount']+'</td>'+
			'<td><a href=modit.php?id='+response[f]['id']+'>Modify</a></td>'+
			'<td><a href=detit.php?id='+response[f]['id']+'>Detail</a></td>'+
			'<td><a class="delete-btn" > Delete </a></td>'+
			'</tr>';
		}
		$('#IT').html(trHTML);
	 }
 });
 
  $('table#IT').on('click', '.delete-btn', function(){
	  if (confirm("Are you sure you want to delete this Asset?")){
	  
        var id = $(this).parent().parent().attr('id');
    
        $.ajax({
          url: "borrarit.php",
          data: {
            id: id
          }
        })
          .done(function( html ) {
            console.log(html);
             $("#"+id).slideToggle("Slow","swing").html("");
			 
			
          });
		  
	  }});
	  $.ajax({
	 type: 'POST',
	 url: 'ajaxbu.php',
	 dataType: 'json',
	 success: function (response) {
		var trHTML =
		'<tr><th>Name</th><th>Update</th><th>Detail</th><th>Delete</th></tr>';
		for(var f=0;f<response.length;f++){
			trHTML += '<tr id="'+response[f]['id']+'">'+
			'<td>'+response [f]['name']+'</td>'+
			'<td><a href=modbu.php?id='+response[f]['id']+'>Modify</a></td>'+
			'<td><a href=detbu.php?id='+response[f]['id']+'>Detail</a></td>'+
			'<td><a class="delete-btn" > Delete </a></td>'+
			'</tr>';
		}
		$('#BU').html(trHTML);
	 }
 });
 
  $('table#BU').on('click', '.delete-btn', function(){
	  if (confirm("Are you sure you want to delete this Objetive?")){
	  
        var id = $(this).parent().parent().attr('id');
    
        $.ajax({
          url: "borrarbu.php",
          data: {
            id: id
          }
        })
          .done(function( html ) {
            console.log(html);
             $("#"+id).slideToggle("Slow","swing").html("");
			 
			
          });
		  
	  }});
</script>
</body>  
</html>