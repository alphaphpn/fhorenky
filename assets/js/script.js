// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
	'use strict'

	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	var forms = document.querySelectorAll('.needs-validation')

	// Loop over them and prevent submission
	Array.prototype.slice.call(forms)
	.forEach(function (form) {
		form.addEventListener('submit', function (event) {
			if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()
			}

			form.classList.add('was-validated')
		}, false)
	})
})()

// Scroll
function scrollFunction() {
	if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
		document.getElementById("navbar").style.padding = ".5rem 1rem";
		document.getElementById("mlogo").style.maxHeight = "48px";
		document.getElementById("mlogo").src = "<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$navbarlogoscroll; ?>";
		document.getElementById("secnavbr").style.backgroundColor = "<?php echo $primarycolor; ?>";
		document.getElementById("secnavbr").style.backgroundImage = "<?php echo $menugradientcolor; ?>";
		document.getElementById("navbar").getElementsByClassName("dropdown-menu")[0].style.backgroundColor = "<?php echo $primarycolor; ?>";
	} else {
		document.getElementById("navbar").style.padding = ".8rem 1rem";
		document.getElementById("mlogo").style.maxHeight = "58px";
		document.getElementById("mlogo").src = "<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$navbarlogo; ?>";
		document.getElementById("secnavbr").style.backgroundColor = "<?php echo $forthcolor; ?>";
		document.getElementById("secnavbr").style.backgroundImage = "none";
		document.getElementById("navbar").getElementsByClassName("dropdown-menu")[0].style.backgroundColor = "<?php echo $forthcolor; ?>";
	}
}

// Background Particle Animation
var particleAnimate = new NodesJs({
	id: 'particle-animate',
	width: window.innerWidth,
	height: window.innerHeight,
	particleSize: 2,
	lineSize: 1,
	particleColor: [184, 82, 67, .1],
	lineColor: [184, 82, 67],
	backgroundFrom: [255, 255, 255],
	backgroundTo: [255, 255, 230],
	backgroundDuration: 4000,
	nobg: false,
	number: window.hasOwnProperty('orientation') ? 30: 100,
	speed: 20
});

/** Password **/
function PwHideShow() {
	var x = document.getElementById("password");
	if (x.type === "password") {
		x.type = "text";
		$('#show_hide_password i').removeClass( "fa-eye-slash" );
		$('#show_hide_password i').addClass( "fa-eye" );
	} else {
		x.type = "password";
		$('#show_hide_password i').addClass( "fa-eye-slash" );
		$('#show_hide_password i').removeClass( "fa-eye" );
	}
}

/** Slick **/
$(document).ready(function() {
	$('.slick-frontbanner').slick({
		infinite: true,
		fade: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 5000,
		arrows: true,
		dots: true,
		cssEase: 'linear'
	});
});
