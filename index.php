<?php 
 include_once "template/header.php";
 ?>

 <body class="index">
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Dota 2 Heroes Strategy <label style="font-size:10px;">v2.1 alpha</label></a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="#">Home</a></li>
	      <li><a href="#">About</a></li>
	    </ul>
	  </div>
	</nav>
<div class="container" style="width:100%;font-family:arial;">

	<div class="row">
		<div class="col-md-6">
		<div class="form-group" style="color:white;margin-left:10px;">
			<label class="form-group" style="font-size:40px;font-family:hillBelly;"><strong>We Give You Advice </strong></label>
			<label class="form-group" style="font-family:deColypLi;font-size:20px;"><strong>to concern heroes that you need to choose in order to achieve victory. Only by choosing the name of a hero chosen by your friend, you can find a suitable heroes to accompany them. Instead, by choosing the name of a hero chosen by your enemies, you can find a suitable heroes to fight or predict other heroes that will be selected next by the enemy.</strong></label>
		</div>
			
		</div>
	</div>
	<div class="row">
		<!-- <center> -->
		<div class="col-md-4">
			<form method="get" action="proses.php">
			<div class="form-group" style="color:white;margin-left:10px;">
				<label class="form-group" style="font-family:deColypLi;font-size:20px;">Choose Your Friend's / Enemy's Hero !</label>
				<br>
				<div class="input-group">
					<input id="checker" type="checkbox">Let me choose the hero</input>	
				</div>
				<div class="input-group">
				<select class="form-control" id="option-hero" name="inputhero">
						<option value="">Choose hero .. </option>
						<?php 
						$query = "SELECT nama FROM skill ORDER BY nama ASC";
									 $result = mysqli_query($conn, $query);

									 if (mysqli_num_rows($result) > 0) {
										    // output data of each row
							
										    while($row = mysqli_fetch_array($result)) {
										    	$name = $row["nama"];
										    	echo "<option value='".$name."'>".$name."</option>";
										    	
										    }
									 }


					 ?>
				</select>
				<!-- <input type="text" class="form-control" placeholder="Contoh: Muka saya menjadi pucat" > -->
					<span class="input-group-btn"><button class="btn btn-primary " value="submit"> START</button></span>
				</div>
			</div>
			</form>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('#option-hero').hide();
				$('#checker').click(function(){
					var prop_checker = $(this).prop('checked');
					if (prop_checker === true) {
						$('#option-hero').show();
					}else{
						$('#option-hero').hide();

					}
					
				});
			});
		</script>
		<!-- </center> -->
	</div>
</div>
 </body>
</html>