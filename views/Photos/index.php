<?php if(isset($_SESSION['errorMsg']) || !isset($_POST['submit'])) :?>
<div id="modal_login" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="modal-body">
					<p style="font-size:1.8rem;" class="text-left">Podaj hasło</p>
					<?php Messages::display(); ?>
					<input id="input_password" style="width:100%;" type="password" name="user_password" required>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" name="submit" value="submit">Potwierdź</button>
					<button type="submit" class="btn btn-primary" name="cancel" value="cancel" data-dismiss="modal">Anuluj</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endif;?>

<div oncontextmenu="return false;">
	<form id="search_form" action="<?php  $_SERVER['PHP_SELF']; ?>" method="get">
		<div class="input-group" style="margin-bottom:5rem;">
			<span id="search_icon" class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
    		<input oninput="peopleSuggests('#search_people');" id="search_people" type="text" name="name" class="form-control" autocomplete="off" placeholder="Szukaj użytkownika" />
		</div>
	</form>
	<div class="wrapper" style="display:flex;align-items:center;justify-content:space-around;flex-wrap:wrap;">
	<?php if(isset($viewmodel["images"]) && count($viewmodel["images"])>0 && is_array($viewmodel["images"]) || is_object($viewmodel)) :?>
	<?php foreach($viewmodel["images"] as $image) : ?>
		<?php 
			$name = str_replace("upload/","",$image);
			$name = preg_replace("/\..*/","",$name);
			$name = strtolower($name);
		?>
		<div class="col-md-2 col-sm-2 container-img">
				<img style="width: 150px;height:200px;" class="image img-responsive img-rounded" src="<?php echo $image ?>" alt="<?php echo $name ?>">
				<p style="width:100%;" ><?php echo $name ?></p>
		</div>
	<?php endforeach; ?>
		<nav class="col-md-12 col-sm-12 text-center" aria-label="Page navigation">
  			<ul class="pagination justify-content-center">
				<li class="page-item <?php if($viewmodel["prev"]<=1) echo "disabled"; ?>">
      				<a class="page-link" href="<?php echo ROOT_URL; ?>photos?page=<?php echo $viewmodel["prev"] ?>" tabindex="-1">Previous</a>
				</li>
				<?php for($i=1; $i<=$viewmodel["pages"];$i++) : ?>
					<li class="page-item <?php if($i == $_GET["page"]) echo "active"; ?>"><a class="page-link" href="<?php echo ROOT_URL; ?>photos?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php endfor; ?>
    			<li class="page-item <?php if($viewmodel["next"]>=$viewmodel["pages"]) echo "disabled"; ?>">
      				<a class="page-link" href="<?php echo ROOT_URL; ?>photos?page=<?php echo $viewmodel["next"] ?>">Next</a>
    			</li>
  			</ul>
		</nav>
	</div>
	<?php elseif(!isset($viewmodel["images"]) || isset($viewmodel["images"]) && empty($viewmodel["images"])) : ?>
		<div class="col-md-2 col-sm-2 container-img">
			Brak zdjęć użytkowników
		</div>
	<?php else : ?>
		<?php 
			$name = str_replace("upload/","",$viewmodel["images"]);
			$name = preg_replace("/\..*/","",$name);
			$name = strtolower($name);
		?>
		<div class="col-md-2 col-sm-2 container-img">
			<img class="image img-responsive img-rounded" src="<?php echo $viewmodel["images"] ?>" alt="<?php echo $name ?>">
			<div class="text-center" style="width:100%;">
				  <p><?php echo $name ?></p>
			</div>
		</div>
	<?php endif; ?>
	<div style="z-index:3;" id="imageModal" class="modal2">
		<span class="close2">&times;</span>
		<img class="modal-content2" id="img01">
		<div id="caption2"></div>
	</div>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
	
	
	window.addEventListener('selectstart', function(e){ e.preventDefault(); });
	$('#modal_login').modal('show');
	$('#input_password').focus();

	$('img').on('dragstart', function(event) { event.preventDefault(); });
	$("body").on("contextmenu", "img", function(e) {
  	return false;
	});
	let timer = null;

	function startInterval() {
		timer = setInterval(function(){
			window.location.replace("/");
		},30000);
	}
	startInterval();

	window.addEventListener('mousemove',function(){
		clearInterval(timer);
		startInterval();
	});

	const images = document.getElementsByClassName('image');
	const form = document.getElementById('search_form');
	const input_icon = document.getElementById('search_icon');
	const search = document.getElementById('search_people');
	const div = document.getElementsByClassName('container-img');

	const modal = document.getElementById("imageModal");
	const modalImg = document.getElementById("img01");
	const modalCaption = document.getElementById("caption2");
	const close = document.getElementsByClassName("close2")[0];

	function keyPress(e) {
    	if(e.key === "Escape") {
        	modal.style.display = "none";
    	}
	}

	close.addEventListener('click', function() { 
  		modal.style.display = "none";
	});

	document.addEventListener('keydown', function(e){
		keyPress(e);
		clearInterval(timer);
		startInterval();
	})

	search.addEventListener('input', function(e){
		let value = search.value.toLowerCase();
		for (let i=0; i<images.length; i++){
			image = images[i].getAttribute("alt").toLocaleLowerCase();
			if(image.indexOf(value)>-1) {
				images[i].parentElement.style.display = "";
			} else {
				images[i].parentElement.style.display = "none"
			}
		}
	})

	for (let i=0; i<images.length; i++){
		let image = images[i];
		image.addEventListener('mouseover',function(){
			image.style.cursor = 'pointer';
		})
		image.addEventListener('click',function(){
			let url = image.getAttribute('src');
			modal.style.display = "block";
			modalImg.src = url;
			modalCaption.textContent = image.alt;
		})
	}

	input_icon.addEventListener('click',function(){
		form.submit();
	})
	input_icon.addEventListener('mouseover', function(){
		input_icon.style.cursor = 'pointer';
	})
});
</script>