$(function() {
	// Fade Slow
	var nav = $('.hover1');
	nav.hover(
		function(){
			$(this).fadeTo(300,0.5);
		},
		function () {
			$(this).fadeTo(300,1);
		}
	);
	// Fade First
	var nav = $('.hover2');
	nav.hover(
		function(){
			$(this).fadeTo(0,0.7);
		},
		function () {
			$(this).fadeTo(0,1);
		}
	);
});