$(document).ready(function() {

    $(".opcao").mouseover(function(){
        $(this).css("color","black")
        $(this).css("cursor","pointer")
    })
    $(".opcao").mouseout(function(){
        $(this).css("color","rgb(153,153,153)")
        
    })
	
	$(".logo").mouseover(function(){
        $(this).css("cursor","pointer")
    })
	
	$(".servicos").click(function(){
        window.location = "servicos.html"
    })
	
	$(".contactos").click(function(){
        window.location = "contactos.html"
    })
	
	$(".sobre").click(function(){
        window.location = "sobre.html"
    })
	
	$(".logo").click(function(){
        window.location = "index.html"
    })
})