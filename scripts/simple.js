$(document).ready(function() {

    $(".opcao").mouseover(function(){
        $(this).css("color","black")
        $(this).css("cursor","pointer")
    })
    $(".opcao").mouseout(function(){
        $(this).css("color","rgb(153,153,153)")
        
    })
    $(".opcao").click(function(){
        window.location = "test.html"
    })
})