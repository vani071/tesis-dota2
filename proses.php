<?php
	ini_set('max_execution_time', 0);
	ini_set('memory_limit', -1);

	include_once "template/header.php";
	include_once "apriori.php";

	const DISPLAYED_RESULT = 10;
	const MINIMUM_FREQUENCY = 2;

	$inputan = $_GET["inputhero"];
	$good_heroes = [];

    $lineups = file('data.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$linecount = count($lineups);

	$result = apriori($lineups, $inputan, MINIMUM_FREQUENCY, 1);

	if ($inputan =='') {
		$inputan = $result['chosen_hero'];
		$result = $result['frequent_itemsets'];
	}

	for ($i = 1; $i < count($result); $i++) {
		$good_heroes = array_merge($good_heroes, $result[$i]);
	}

	usort($good_heroes, function ($a, $b) {
		if ($a['confidence'] == $b['confidence']) {
			if ($a['support'] == $b['support']) {
	        	return 0;
	        }

		    return ($a['support'] < $b['support']) ? 1 : -1;
	    }

	    return ($a['confidence'] < $b['confidence']) ? 1 : -1;
	});
 ?>

 <script type="text/javascript">
 	   $(document).ready(function(){

		    $("#detail1").hide();
		    $("#detail2").hide();
		    $("#detail3").hide();

		    $("#cek1").click(function(){
		        $("#detail1").slideToggle("slow");
		    });

		    $("#cek2").click(function(){
		        $("#detail2").slideToggle("slow");
		    });

		    $("#cek3").click(function(){
		        $("#detail3").slideToggle("slow");
		    });

		});
 </script>
<body style="background-color:black;color:white;overflow-x:hidden">
		<div class="header-process"><center><h1 style="font-family:deColypLi;">From <?php echo $linecount; ?> Data.<br/><br/>The result is...</h1></center></div>
			  <div class="container" style="background-color:#000000;color:white;width:70%;font-family:deColypLi;">

			      <div class="row row-centered" style="padding-bottom:50px;">
			      <h1 style="font-family:deColypLi;" >If you choose <?php echo $inputan ?></h1>
			      <br/>
			        <div class="col-md-4 col-centered" style="width:300px;text-align:center;">
			          <div class="form-group">
			            <img class="img-responsive img-rounded" src="assets/img/<?php echo $inputan ?>/hero.png">
			            <label class="form-group"><?php echo $inputan ?></label>
			          </div>
			        </div>
			        <h1 style="font-family:deColypLi;">In the game, <?php echo $inputan ?> has good relationship with :</h1>

			      </div>
			      <div class="row row-centered">
			      	<table class="table">
			      		<thead>
			      			<th>Hero</th>
			      			<th class="text-center">Total Match</th>
			      			<th class="text-center">Support</th>
			      			<th class="text-center">Confidence</th>
			      		</thead>
			      		<tbody>
			      			<?php $counter = 0 ?>
			      			<?php foreach ($good_heroes as $data): ?>
			      				<tr>
			      					<td>
			      						<?php foreach ($data['pairs'] as $hero): ?>
			      							<img src="assets/img/<?= $hero ?>/hero.png" data-toggle="" data-placement="left" title="<?= $hero ?>" width="80" style="margin-right: 5px;">
			      						<?php endforeach ?>
			      					</td>
			      					<td class="text-center"><?= $data['frequency'] ?></td>
			      					<td class="text-center"><?= number_format($data['support'], 2) ?> %</td>
			      					<td class="text-center"><?= number_format($data['confidence'], 2) ?> %</td>
			      				</tr>
			      				<?php
			      					$counter++;

			      					if ($counter > DISPLAYED_RESULT) {
			      						break;
			      					}
			      				?>
			      			<?php endforeach ?>
			      		</tbody>
			      	</table>
					<br/>
			        <h3 style="font-family:deColypLi;">You can Ban or Pick these heroes to achieve victory </h3>
			      </div>
	 </div>
<div class="bottom-container">
<hr class="style17">
	 <div class="container">
	 	<div class="row row-centered bottom-col-adjust">
			 	<div class="col-md-4 col-md-centered">
			 		<div class="hero-table">
			 		<?php
			 			$query = "SELECT nama FROM skill WHERE tipe=1 ORDER BY nama ASC ";
									 $result = mysqli_query($conn, $query);

									 if (mysqli_num_rows($result) > 0) {
										    // output data of each row

										    while($row = mysqli_fetch_array($result)) {
										    	$kame = $row["nama"];
										    	echo "<a class='hero-bottom' href='proses.php?inputhero=".$kame."'><img src='assets/img/".$kame."/hero.png' data-toggle='tooltip' data-placement='left' title='".$kame."' width='80'></a>";

										    }
									 }


			 		 ?>
			 		 </div>
			 	</div>
			 	<div class="col-md-4 col-md-centered">
			 		<div class="hero-table">
			 		<?php
			 			$query = "SELECT nama FROM skill WHERE tipe=2 ORDER BY nama ASC ";
									 $result = mysqli_query($conn, $query);

									 if (mysqli_num_rows($result) > 0) {
										    // output data of each row

										    while($row = mysqli_fetch_array($result)) {
										    	$kame = $row["nama"];
										    	echo "<a class='hero-bottom' href='proses.php?inputhero=".$kame."'><img src='assets/img/".$kame."/hero.png' data-toggle='tooltip' data-placement='left' title='".$kame."' width='80'></a>";

										    }
									 }


			 		 ?>
			 		 </div>
			 	</div>
			 	<div class="col-md-4 col-md-centered">
			 		<div class="hero-table">
			 		<?php
			 			$query = "SELECT nama FROM skill WHERE tipe=3 ORDER BY nama ASC ";
									 $result = mysqli_query($conn, $query);

									 if (mysqli_num_rows($result) > 0) {
										    // output data of each row

										    while($row = mysqli_fetch_array($result)) {
										    	$kame = $row["nama"];
										    	echo "<a class='hero-bottom' href='proses.php?inputhero=".$kame."'><img src='assets/img/".$kame."/hero.png' data-toggle='tooltip' data-placement='left' title='".$kame."' width='80'></a>";

										    }
									 }


			 		 ?>
			 		 </div>
			 	</div>
			 </div>
		</div>
	 </div>


		<script type="text/javascript">
			$(document).ready(function(){
			    $('[data-toggle="tooltip"]').tooltip();
			});
		</script>
 </body>
</html>
