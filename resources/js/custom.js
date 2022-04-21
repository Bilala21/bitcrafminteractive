$(document).ready(function () {
    $(".img-span").on("click", function () {
        $.ajax({
            url: "/user/favourite-coupon/" + $(this).attr("data-id"),
            type: "get",
            success: function (data) {
                if (data.status == 200) {
                    alert("Coupon is favourite")
                }
            }
        })
    })
})

$(document).ready(function(){
    $("#query").on('keyup', function(e){
        e.preventDefault()
        
        if($(this).val() !== ""){
            $("#serError").html("")
        }
        else{
            $("#serError").html("Please enter something")
        }
    })
})

$(document).ready(function(){
$(".check_box1").on("click", function(e){
    e.preventDefault()
    console.log($(this))
    $(this).addClass('bg-green')
})

})

// $(document).ready(function(){
//     $('input[type=checkbox]').on('click', function(){
//         $(this).addClass('bg-green')
//     })
// })