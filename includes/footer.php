<!-- FOOTER -->
<section class="container-fluid">
	<footer class="col-xl-12">
		
		<p class="text-custom-white col-sm-12 col-xl-10">© Copyright 2018 - DevCannes.com</p>
		<?php

		if (isset($_SESSION['user']) && $_SESSION['user']['RANK'] == 3){
			        
       
			?>
			<a href="admin/index.php" class="nav-link text-custom-white col-sm-12 col-xl-2">Administration&nbsp;<span class="fas fa-sign-in-alt"></span></a>
		<?php } ?> 
		
	</footer>
</section>

<!-- jQuery + popper + bootstrapJs call -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!-- Leaflet script -->
<script src="./js/vendor.js"></script>
<script src="./js/app.js"></script>
<!-- jQuery Plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script src="./js/check-register.js"></script>
<!-- custom script -->
<script src="./js/loginToggle.js"></script>

</body>	
</html>