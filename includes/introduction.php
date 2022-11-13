<div class="profile-page">
    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="green">
            <div class="page-header-image" data-parallax="true" style="background-image: url('<?php echo BASEPATH.'/assets/images/'.$web_setting->banner_image; ?>')"></div>
            <div class="container">
                <div class="content-center">
                    <div class="cc-profile-image"><a href="#"><img src="<?php echo BASEPATH.'/assets/images/'.$profile_data['user_basic_details'][0]['admin_profile_pic']; ?>" alt="Image" /></a></div>
                    <div class="h2 title"><?php echo APP_NAME; ?></div>
                    <p class="category text-white"><?php echo $web_setting->tagline; ?></p>
                    <a class="btn btn-primary smooth-scroll mr-2" href="#contact" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Hire Me</a>
                    <a class="btn btn-primary" href="<?php echo BASEPATH.'/resume-download/'; ?>" target="_BLANK" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Download CV</a>
                </div>
            </div>
            <div class="section">
                <div class="container">
                    <div class="button-container">
                        <?php foreach($profile_data['social_icons'] as $icons){ ?>
                            <a class="btn btn-default btn-round btn-lg btn-icon d-inline-flex align-items-center justify-content-center" style="color:<?php echo $icons['color']; ?>; "  href="<?php echo $icons['url']; ?>" target="_BLANK" rel="tooltip" title="<?php echo $icons['name'] ?>">
                                <?php echo $db_query->icon_front($icons['icon']); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>