<?php
	include_once "template/header.php";
	include_once "functions.php";

	$inputan = $_GET["inputhero"];
	$good_heroes = [];
	$types = [1 => 'str', 2 => 'agi', 3 => 'int'];

	$heroes = file('hero.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lineups = file('data.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$linecount = count($lineups);

	$query = "SELECT nama FROM skill WHERE tipe = 1 ORDER BY nama ASC";
    $result = mysqli_query($conn, $query);
    $matchup_heroes['str'] = array_column(mysqli_fetch_all($result, MYSQLI_ASSOC), 'nama');

    $query = "SELECT nama FROM skill WHERE tipe = 2 ORDER BY nama ASC";
    $result = mysqli_query($conn, $query);
    $matchup_heroes['agi'] = array_column(mysqli_fetch_all($result, MYSQLI_ASSOC), 'nama');

    $query = "SELECT nama FROM skill WHERE tipe = 3 ORDER BY nama ASC";
    $result = mysqli_query($conn, $query);
    $matchup_heroes['int'] = array_column(mysqli_fetch_all($result, MYSQLI_ASSOC), 'nama');

    foreach ($types as $key => $type) {
    	$good_heroes[$key] = apriori($inputan, $heroes, $lineups, $matchup_heroes[$type]);
    }
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
			      	<?php foreach ($good_heroes as $key => $hero): ?>
			      	<div class='col-md-3 col-centered'>
			            <div class='result' >
			                <div class="form-group">
			                    <label><?= $hero['name'] ?></label> <img src="assets/img/type/<?= $types[$key] ?>.png" style="float:right;">
			                    <img class="img-responsive img-rounded" src="assets/img/<?= $hero['name'] ?>/hero.png">
			                    <br/>
			                    <div>
			                    <button id="cek<?= $key ?>" class='btn btn-default form-control'>Details</button>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div id="detail<?= $key ?>">
			                    <label>Confidence: <?= $hero['confidence'] ?> %</label>
			                    <br/>
			                    <label>Support: <?= $hero['support'] ?> %</label>
			                    <br/>
			                    <label  style="font-size:18px";>
			                    	Terdapat <?= $hero['match_count'] ?> pertandingan dimana <?= $inputan ?> dan <?= $hero['name'] ?> dalam satu pertandingan
			                    </label>
			                    </div>

			                </div>
			             </div>
			        </div>
			      	<?php endforeach ?>
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
