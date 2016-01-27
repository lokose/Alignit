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
	 <style type="text/css">

<!-- esto sirve para trasponer la tabla con la informacion
saca esta etiqueta style y su contenido para verla ordenada de otra manera, aunque con esto se ve mejor -->
	</style>
	
</head> 
<body>  
<div class="col-md-1"></div><div class="col-md-4" class='centraTabla'>
	
	<h3>It Assets</h3><br>
	<table id='IT' class="table" > </table><br>
	
	<?php 
	if($a->edit == 1){
		echo "<a href = 'Crearit.php'>Create a IT Assets</a><br>";
	}
	?>
	<br><a href = 'GranIT.php'><input type='submit' value=' See It Assets'></a>

</div><div class="col-md-2"></div><div class="col-md-4" class='centraTabla'>

	<h3>Business Objectives</h3><br>
	<table id='BU' class="table" > </table><br>
	
	<?php 
	if($a->edbu == 1){
		echo "<a href = 'Crearbu.php'>Create a Business Objectives</a><br>";
	}
	?>
	<br><a href = 'GranBU.php'><input type='submit' value=' See Business Objectives'> </a>


</div><div class="col-md-1"></div>

	<div class="col-md-3"></div><div class="col-md-6" class='centraTabla'>
	
	<br><br><br><h3>It Assets/Business Objectives</h3>
	<br><table id='Gran' class="table"></table>
	<br><br><br><a href = 'salir.php'><input type='submit' value=' Log Out'> </a>
	<br><br>
	
	</div><div class="col-md-3"></div>

<script language="javascript" type="text/javascript" src ="jquery-2.1.4.min.js"></script>
<script type="text/javascript">

$.ajax({
	 type: 'POST',
	 url: 'ajaxit.php',
	 dataType: 'json',
	 success: function (response) {
		var trHTML =
		'<tr bgcolor ="#FFFFFF"><th>Name</th><th>Budget</th><th>Headcount</th><th>Update</th><th>Detail</th><th>Delete</th></tr>';
		for(var f=0;f<response.length;f++){
			trHTML += '<tr bgcolor ="#FFFFFF" id="'+response[f]['id']+'">'+
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
		'<tr bgcolor ="#FFFFFF"><th>Name</th><th>Update</th><th>Detail</th><th>Delete</th></tr>';
		for(var f=0;f<response.length;f++){
			trHTML += '<tr bgcolor ="#FFFFFF" id="'+response[f]['id']+'">'+
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
  
  $.ajax({
		 type: 'POST',
		 url: 'ajaxmenu.php',
		 dataType: 'json',
		 success: function (response) {
			var trHTML =
			'<tr bgcolor ="#FFFFFF"><td></td>';
			for(var f=0;f<response.length;f++){
				trHTML += '<th>'+response[f]['name']+'</th>';
			}
			
			trHTML += '</tr>';
			  $.ajax({
					 type: 'POST',
					 url: 'ajaxmenu2.php',
					 dataType: 'json',
					 success: function (responses) {
						 $.ajax({
							 type: 'POST',
							 url: 'ajaxmenux.php',
							 dataType: 'json',
							 success: function (responsex) {
								 var l=0;
								 for(var k=0;k<responses.length;k++){
									 if( k%2==0){
											trHTML +='<tr bgcolor ="#CBD8F5"><th>'+responses[k]['name']+'</th>';
											}
										else {
											trHTML +='<tr bgcolor ="#FFFFFF"><th>'+responses[k]['name']+'</th>';
											}
					
										for(var m=0;m<f;m++){
											trHTML += '<td>'+responsex[l]['equis']+'</td>';
											l++;
										}
									}

									trHTML += '</tr>';
								  $('#Gran').html(trHTML);
							 }});
					 }});
		}
	 });
 
 
</script>
</body>  
</html>