<?php
$CI = &get_instance();

$CI->load->model('dashboard/Themes');
$CI->load->model('dashboard/Companies');
$theme = $CI->Themes->get_theme();
$company_info = $CI->Companies->company_list();
?>
<section class="section-about py-5">
    <div class="container">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
        ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo $message ?>
            </div>
        <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
        ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo $error_message ?>
            </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-3">
                <div class="section-title text-center mb-5">
                    <h2 class="fs-28 font-weight-normal"><?php echo display('get_in_touch') ?></h2>
                    <p class="text-black-50 mb-0 fs-16"><?php echo display('your_email_address_will_not_be_published') ?></p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 mb-5 mb-md-0">
                        <div class="contact-info">
                            <div class="mb-4">
                                <h3 class="info-title fs-18 mb-3 font-weight-600 position-relative"><?php echo display('our_location') ?></h3>
                                <address class="mb-4">
                                    <?php

                                    $default_lang  = 'english';
                                    $user_lang = $this->session->userdata('language');
                                    //set language  
                                    if (!empty($user_lang)) {
                                        $language = $user_lang;
                                    } else {
                                        $language = $default_lang;
                                    }

                                    $locations = [
                                        ['c' => 'Egypt', 'a' => '49 Noubar St, Bab Al Louq, Abdeen.'],
                                        ['c' => 'Morocco', 'a' => 'TISSUS HAY OULFA, Casablanca, Morocco'],
                                        ['c' => 'London', 'a' => '2 Kingfisher Dr, Richmond TW10 7UD, UK'],
                                        ['c' => 'KSA', 'a' => '8420 Prince Mutaib bin Abdulaziz Rd, Al Aziziyah District, Jeddah 23342 3157, Saudi Arabia'],
                                        ['c' => 'Montenegro', 'a' => '30 Dalmatinska St, Podgorica 81000, Montenegro'],
                                        ['c' => 'Italy', 'a' => '32100 Belluno, Province of Belluno, Italy']
                                    ];

                                    $locations_ar = [
                                        ['c' => 'مصر', 'a' => '49 ش نوبار باب اللوق عابدين.'],
                                        ['c' => 'المغرب', 'a' => 'تيسوس هاي أولفا ، الدار البيضاء ، المغرب'],
                                        ['c' => 'لندن', 'a' => '2 الدكتور Kingfisher ، ريتشموند TW10 7UD ، المملكة المتحدة'],
                                        ['c' => 'السعودية', 'a' => '8420 طريق الأمير متعب بن عبد العزيز ، حي العزيزية ، جدة 23342 3157 ، المملكة العربية السعودية'],
                                        ['c' => 'مونتينيغرو', 'a' => '30 شارع دالماتينسكا ، بودغوريتشا 81000 ، مونتينيغر.'],
                                        ['c' => 'إيطاليا', 'a' => '32100 بيلونو ، مقاطعة بيلونو ، إيطاليا']
                                    ];

                                    $locations_fr = [
                                        ['c' => 'Egypte', 'a' => '49 rue Noubar, Bab Al Louq, Abdine.'],
                                        ['c' => 'Maroc', 'a' => 'TISSUS HAY OULFA, Casablanca, Maroc'],
                                        ['c' => 'Londres', 'a' => '2 Kingfisher Dr, Richmond TW10 7UD, Royaume-Uni'],
                                        ['c' => 'Arabie Saoudite', 'a' => '8420 Prince Mutaib bin Abdulaziz Rd, Al Aziziyah District, Djeddah 23342 3157, Arabie Saoudite'],
                                        ['c' => 'Monténégro', 'a' => '30 rue Dalmatinska, Podgorica 81000, Monténégro'],
                                        ['c' => 'Italie', 'a' => '32100 Bellune, Province de Bellune, Italie']
                                    ];

                                    if ($language == 'english') {
                                        foreach ($locations as $l) { ?>

                                            <div class="office_address">
                                                <h5>
                                                    <p><span xss="removed"><span xss="removed"><?php echo ($l['c']); ?>:</span></span><br></p>
                                                </h5>
                                                <p><span xss="removed"><?php echo ($l['a']); ?></span><br></p>
                                            </div>

                                    <?php }
                                    } ?>

                                    <?php
                                    if ($language == 'arabic') {
                                        foreach ($locations_ar as $l) { ?>

                                            <div class="office_address">
                                                <h5>
                                                    <p><span xss="removed"><span xss="removed"><?php echo ($l['c']); ?>:</span></span><br></p>
                                                </h5>
                                                <p><span xss="removed"><?php echo ($l['a']); ?></span><br></p>
                                            </div>

                                    <?php }
                                    } ?>

                                    <?php
                                    if ($language == 'french') {
                                        foreach ($locations_fr as $l) { ?>

                                            <div class="office_address">
                                                <h5>
                                                    <p><span xss="removed"><span xss="removed"><?php echo ($l['c']); ?>:</span></span><br></p>
                                                </h5>
                                                <p><span xss="removed"><?php echo ($l['a']); ?></span><br></p>
                                            </div>

                                    <?php }
                                    } ?>

                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <?php echo form_open('submit_contact', array('class' => 'request_form')); ?>
                        <div class="comments_area">
                            <div class="form-group">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="<?php echo display('first_name') ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="<?php echo display('last_name') ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo display('email') ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control msg_box" name="message" placeholder="<?php echo display('write_your_msg_here') ?> ..."></textarea>
                        </div>
                        <button href="#" class="btn-one btn btn-primary  color4 color46"><?php echo display('submit') ?></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.End of about section -->

<div class="map-content">
    <div id="map" class="w-100"></div>
</div>


<!-- /.End of map content -->
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo html_escape($map_info[0]['map_api_key']) ?>"></script>
<input type="hidden" id="map_latitude" value="<?php echo html_escape($map_info[0]['map_latitude']) ?>">
<input type="hidden" id="map_langitude" value="<?php echo html_escape($map_info[0]['map_langitude']) ?>">
<input type="hidden" id="company_name" value="<?php echo html_escape($company_info[0]['company_name']) ?>">
<script src="<?php echo THEME_URL . $theme . '/assets/ajaxs/contact_us.js'; ?>"></script>