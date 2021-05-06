<div id="seeAllModal" class="modal font-secondary" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content bg-secondary">
            <div class="modal-header modal-product">
                <button type="button" class="close btn btn-horison" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-horison">
                    <center id="modal_title"></center>
                </h3>
            </div>
            <div class="modal-body">
                <div class="slider-for">
                    <div align="center"><img class="gltop" src=""></div>
                    <div align="center"><img class="gltop" src=""></div>
                    <div align="center"><img class="gltop" src=""></div>
                    <div align="center"><img class="gltop" src=""></div>
                </div>
                <br>
                <div class="slider-nav" style="padding:20px;">
                    <div class="sub-seeall">
                        <div align="center"><img class="imgslide-seeall" src=""></div>
                    </div>
                    <div class="sub-seeall">
                        <div align="center"><img class="imgslide-seeall" src=""></div>
                    </div>
                    <div class="sub-seeall">
                        <div align="center"><img class="imgslide-seeall" src=""></div>
                    </div>
                    <div class="sub-seeall">
                        <div align="center"><img class="imgslide-seeall" src=""></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-product">
                <button type="button" class="btn btn-horison" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function do_slider() {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            focusOnSelect: true
        });
    }
</script>