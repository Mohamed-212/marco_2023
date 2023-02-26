<?php if (!empty($slider_list)) { ?>
<link href="<?php echo MOD_URL.'web/views/themes/zaima/assets/css/custome.css'; ?>" rel="stylesheet">
<!--Hero slider-->
<div class="hero-slider position-relative">
    <div class="header-slider header-slider-preloader">
        <div class="animation-slide owl-carousel owl-theme ">
            <?php
            foreach ($slider_list as $slider) {
            ?>
            <div class="item slider-item bg-img-hero d-flex align-items-center justify-content-center">
                <a href="<?php echo $slider['slider_link']; ?>">

                    <img src="<?php echo base_url() . $slider['slider_image'] ?>">
                </a>
            </div>
            <?php }  ?>
        </div>
    </div>

    <!--Slider Preloader-->
    <div class="slider_preloader">
        <div class="slider_preloader_status">&nbsp;</div>
    </div>
</div>
<?php } ?>