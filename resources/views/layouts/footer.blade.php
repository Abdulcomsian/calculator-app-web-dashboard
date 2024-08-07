<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
         <div class="text-dark order-2 order-md-1">
             <span class="text-muted fw-bold me-1">2021©</span>
             <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Callidus Mena IT Team</a>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Container-->
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
     

    $(".nextBtn").click(function(){
        if($(".basicInfo").css("display")=="block"){
            $(".basicInfo").css("display","none")
            $(".board-of-diector").css("display","block")
        } else if($(".board-of-diector").css("display")=="block"){
            $(".board-of-diector").css("display","none")
            $(".accounting").css("display","block")
        } else if($(".accounting").css("display")=="block"){
            $(".accounting").css("display","none")
            $(".market-share").css("display","block")
            $(".nextBtn").css("display","none")
        }
    })
</script>