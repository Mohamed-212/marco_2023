<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('update_setting') ?></h1>
            <small><?php echo display('update_your_web_setting') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('software_settings') ?></a></li>
                <li class="active"><?php echo display('update_setting') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
        ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $message ?>
        </div>
        <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>
        </div>
        <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('update_setting') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('dashboard/Csoft_setting/update_setting', array('class' => 'form-vertical', 'id' => 'validate')) ?>
                    <div class="panel-body">
                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label"><?php echo display('logo') ?> </label>
                            <div class="col-sm-6">
                                <input class="form-control" name="logo" id="logo" type="file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <img src="<?php echo base_url(); ?>{logo}" class="img img-responsive" height="100"
                                    width="100">
                                <input name="old_logo" type="hidden" value="{logo}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="invoice_logo"
                                class="col-sm-3 col-form-label"><?php echo display('invoice_logo') ?> </label>
                            <div class="col-sm-6">
                                <input class="form-control" name="invoice_logo" id="invoice_logo" type="file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="invoice_logo" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <img src="<?php echo base_url(); ?>{invoice_logo}" class="img img-responsive"
                                    height="100" width="100">
                                <input name="old_invoice_logo" type="hidden" value="{invoice_logo}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="favicon"
                                class="col-sm-3 col-form-label"><?php echo display('favicon') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="favicon" id="favicon" type="file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="favicon" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <img src="<?php echo base_url(); ?>{favicon}" class="img img-responsive" height="50"
                                    width="50">
                                <input name="old_favicon" type="hidden" value="{favicon}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_text"
                                class="col-sm-3 col-form-label"><?php echo display('footer_text') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="footer_text" id="footer_text" type="text"
                                    placeholder="Foter Text" value="{footer_text}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country"
                                class="col-sm-3 col-form-label"><?php echo display('country') ?></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="country" id="country">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <?php if (!empty($country_list)) {
                                        foreach ($country_list as $citem) {
                                    ?>
                                    <option value="<?php echo $citem['id']; ?>" <?php if ($citem['id'] == $country_id) {
                                                                                            echo "selected";
                                                                                        } ?>>
                                        <?php echo html_escape($citem['name']); ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="language" class="col-sm-3 col-form-label"><?php echo display('language') ?>
                            </label>
                            <div class="col-sm-6">
                                <?php
                                echo form_dropdown('language', $language, $ses_lang, 'class="form-control" id="language" required');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_zone" class="col-sm-3 col-form-label"><?php echo display('time_zone') ?>
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="time_zone" id="time_zone">
                                    <option <?php echo ($time_zone == 'Pacific/Midway') ? 'selected' : ''; ?>
                                        value="Pacific/Midway">
                                        (GMT-11:00) Midway Island, Samoa
                                    </option>
                                    <option <?php echo ($time_zone == 'America/Adak') ? 'selected' : ''; ?>
                                        value="America/Adak">

                                        (GMT-10:00) Hawaii-Aleutian</option>
                                    <option <?php echo ($time_zone == 'Etc/GMT+10') ? 'selected' : ''; ?>
                                        value="Etc/GMT+10">
                                        (GMT-10:00) Hawaii</option>
                                    <option <?php echo ($time_zone == 'Pacific/Marquesas') ? 'selected' : ''; ?>
                                        value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
                                    <option <?php echo ($time_zone == 'Pacific/Gambier') ? 'selected' : ''; ?>
                                        value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
                                    <option <?php echo ($time_zone == 'America/Anchorage') ? 'selected' : ''; ?>
                                        value="America/Anchorage">(GMT-09:00) Alaska</option>
                                    <option <?php echo ($time_zone == 'America/Ensenada') ? 'selected' : ''; ?>
                                        value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
                                    <option <?php echo ($time_zone == 'Etc/GMT+8') ? 'selected' : ''; ?>
                                        value="Etc/GMT+8">
                                        (GMT-08:00) Pitcairn Islands</option>
                                    <option <?php echo ($time_zone == 'America/Los_Angeles') ? 'selected' : ''; ?>
                                        value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                                    <option <?php echo ($time_zone == 'America/Denver') ? 'selected' : ''; ?>
                                        value="America/Denver">(GMT-07:00) Mountain Time (US & Canada)</option>
                                    <option <?php echo ($time_zone == 'America/Chihuahua') ? 'selected' : ''; ?>
                                        value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                    <option <?php echo ($time_zone == 'America/Dawson_Creek') ? 'selected' : ''; ?>
                                        value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
                                    <option <?php echo ($time_zone == 'America/Belize') ? 'selected' : ''; ?>
                                        value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
                                    <option <?php echo ($time_zone == 'America/Cancun') ? 'selected' : ''; ?>
                                        value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey
                                    </option>
                                    <option <?php echo ($time_zone == 'Chile/EasterIsland') ? 'selected' : ''; ?>
                                        value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
                                    <option <?php echo ($time_zone == 'America/Chicago') ? 'selected' : ''; ?>
                                        value="America/Chicago">(GMT-06:00) Central Time (US & Canada)</option>
                                    <option <?php echo ($time_zone == 'America/New_York') ? 'selected' : ''; ?>
                                        value="America/New_York">(GMT-05:00) Eastern Time (US & Canada)</option>
                                    <option <?php echo ($time_zone == 'America/Havana') ? 'selected' : ''; ?>
                                        value="America/Havana">(GMT-05:00) Cuba</option>
                                    <option <?php echo ($time_zone == 'America/Bogota') ? 'selected' : ''; ?>
                                        value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                    <option <?php echo ($time_zone == 'America/Caracas') ? 'selected' : ''; ?>
                                        value="America/Caracas">(GMT-04:30) Caracas</option>
                                    <option <?php echo ($time_zone == 'America/Santiago') ? 'selected' : ''; ?>
                                        value="America/Santiago">(GMT-04:00) Santiago</option>
                                    <option <?php echo ($time_zone == 'America/La_Paz') ? 'selected' : ''; ?>
                                        value="America/La_Paz">(GMT-04:00) La Paz</option>
                                    <option <?php echo ($time_zone == 'Atlantic/Stanley') ? 'selected' : ''; ?>
                                        value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
                                    <option <?php echo ($time_zone == 'America/Campo_Grande') ? 'selected' : ''; ?>
                                        value="America/Campo_Grande">(GMT-04:00) Brazil</option>
                                    <option <?php echo ($time_zone == 'America/Goose_Bay') ? 'selected' : ''; ?>
                                        value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
                                    <option <?php echo ($time_zone == 'America/Glace_Bay') ? 'selected' : ''; ?>
                                        value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
                                    <option <?php echo ($time_zone == 'America/St_Johns') ? 'selected' : ''; ?>
                                        value="America/St_Johns">(GMT-03:30) Newfoundland</option>
                                    <option <?php echo ($time_zone == 'America/Araguaina') ? 'selected' : ''; ?>
                                        value="America/Araguaina">(GMT-03:00) UTC-3</option>
                                    <option <?php echo ($time_zone == 'America/Montevideo') ? 'selected' : ''; ?>
                                        value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                    <option <?php echo ($time_zone == 'America/Miquelon') ? 'selected' : ''; ?>
                                        value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
                                    <option <?php echo ($time_zone == 'America/Godthab') ? 'selected' : ''; ?>
                                        value="America/Godthab">(GMT-03:00) Greenland</option>
                                    <option
                                        <?php echo ($time_zone == 'America/Argentina/Buenos_Aires') ? 'selected' : ''; ?>
                                        value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
                                    <option <?php echo ($time_zone == 'America/Sao_Paulo') ? 'selected' : ''; ?>
                                        value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                    <option <?php echo ($time_zone == 'America/Noronha') ? 'selected' : ''; ?>
                                        value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                    <option <?php echo ($time_zone == 'Atlantic/Cape_Verde') ? 'selected' : ''; ?>
                                        value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                    <option <?php echo ($time_zone == 'Atlantic/Azores') ? 'selected' : ''; ?>
                                        value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                    <option <?php echo ($time_zone == 'Europe/Belfast') ? 'selected' : ''; ?>
                                        value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
                                    <option <?php echo ($time_zone == 'Europe/Dublin') ? 'selected' : ''; ?>
                                        value="Europe/Dublin">
                                        (GMT) Greenwich Mean Time : Dublin</option>
                                    <option <?php echo ($time_zone == 'Europe/Lisbon') ? 'selected' : ''; ?>
                                        value="Europe/Lisbon">
                                        (GMT) Greenwich Mean Time : Lisbon</option>
                                    <option <?php echo ($time_zone == 'Europe/London') ? 'selected' : ''; ?>
                                        value="Europe/London">
                                        (GMT) Greenwich Mean Time : London</option>
                                    <option <?php echo ($time_zone == 'Africa/Abidjan') ? 'selected' : ''; ?>
                                        value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
                                    <option <?php echo ($time_zone == 'Europe/Amsterdam') ? 'selected' : ''; ?>
                                        value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome,
                                        Stockholm, Vienna</option>
                                    <option <?php echo ($time_zone == 'Europe/Belgrade') ? 'selected' : ''; ?>
                                        value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest,
                                        Ljubljana, Prague</option>
                                    <option <?php echo ($time_zone == 'Europe/Brussels') ? 'selected' : ''; ?>
                                        value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris
                                    </option>
                                    <option <?php echo ($time_zone == 'Africa/Algiers') ? 'selected' : ''; ?>
                                        value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
                                    <option <?php ($time_zone == 'Africa/Windhoek') ? 'selected' : ''; ?>
                                        value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
                                    <option <?php echo ($time_zone == 'Asia/Beirut') ? 'selected' : ''; ?>
                                        value="Asia/Beirut">
                                        (GMT+02:00) Beirut</option>
                                    <option <?php echo ($time_zone == 'Africa/Cairo') ? 'selected' : ''; ?>
                                        value="Africa/Cairo">
                                        (GMT+02:00) Cairo</option>
                                    <option <?php echo ($time_zone == 'Asia/Gaza') ? 'selected' : ''; ?>
                                        value="Asia/Gaza">
                                        (GMT+02:00) Gaza</option>
                                    <option <?php echo ($time_zone == 'Africa/Blantyre') ? 'selected' : ''; ?>
                                        value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
                                    <option <?php echo ($time_zone == 'Asia/Jerusalem') ? 'selected' : ''; ?>
                                        value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                    <option <?php echo ($time_zone == 'Europe/Minsk') ? 'selected' : ''; ?>
                                        value="Europe/Minsk">
                                        (GMT+02:00) Minsk</option>
                                    <option <?php echo ($time_zone == 'Asia/Damascus') ? 'selected' : ''; ?>
                                        value="Asia/Damascus">
                                        (GMT+02:00) Syria</option>
                                    <option <?php echo ($time_zone == 'Europe/Moscow') ? 'selected' : ''; ?>
                                        value="Europe/Moscow">
                                        (GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                    <option <?php echo ($time_zone == 'Africa/Addis_Ababa') ? 'selected' : ''; ?>
                                        value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
                                    <option <?php echo ($time_zone == 'Asia/Tehran') ? 'selected' : ''; ?>
                                        value="Asia/Tehran">
                                        (GMT+03:30) Tehran</option>
                                    <option
                                        <?php echo ($time_zone == 'Asia/Dubai') ? 'selected' : ''; ?>value="Asia/Dubai">
                                        (GMT+04:00) Abu Dhabi, Muscat</option>
                                    <option <?php echo ($time_zone == 'Asia/Yerevan') ? 'selected' : ''; ?>
                                        value="Asia/Yerevan">
                                        (GMT+04:00) Yerevan</option>
                                    <option <?php echo ($time_zone == 'Asia/Kabul') ? 'selected' : ''; ?>
                                        value="Asia/Kabul">
                                        (GMT+04:30) Kabul</option>
                                    <option <?php echo ($time_zone == 'Asia/Yekaterinburg') ? 'selected' : ''; ?>
                                        value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                    <option <?php echo ($time_zone == 'Asia/Tashkent') ? 'selected' : ''; ?>
                                        value="Asia/Tashkent">
                                        (GMT+05:00) Tashkent</option>
                                    <option <?php echo ($time_zone == 'Asia/Kolkata') ? 'selected' : ''; ?>
                                        value="Asia/Kolkata">
                                        (GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi
                                    </option>
                                    <option <?php echo ($time_zone == 'Asia/Katmandu') ? 'selected' : ''; ?>
                                        value="Asia/Katmandu">
                                        (GMT+05:45) Kathmandu</option>
                                    <option <?php echo ($time_zone == 'Asia/Dhaka') ? 'selected' : ''; ?>
                                        value="Asia/Dhaka">
                                        (GMT+06:00) Astana, Dhaka</option>
                                    <option <?php echo ($time_zone == 'Asia/Novosibirsk') ? 'selected' : ''; ?>
                                        value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
                                    <option <?php echo ($time_zone == 'Asia/Rangoon') ? 'selected' : ''; ?>
                                        value="Asia/Rangoon">
                                        (GMT+06:30) Yangon (Rangoon)</option>
                                    <option <?php echo ($time_zone == 'Asia/Bangkok') ? 'selected' : ''; ?>
                                        value="Asia/Bangkok">
                                        (GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                    <option <?php echo ($time_zone == 'Asia/Krasnoyarsk') ? 'selected' : ''; ?>
                                        value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                    <option <?php echo ($time_zone == 'Asia/Hong_Kong') ? 'selected' : ''; ?>
                                        value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi
                                    </option>
                                    <option <?php echo ($time_zone == 'Asia/Irkutsk') ? 'selected' : ''; ?>
                                        value="Asia/Irkutsk">
                                        (GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                    <option <?php echo ($time_zone == 'Australia/Perth') ? 'selected' : ''; ?>
                                        value="Australia/Perth">(GMT+08:00) Perth</option>
                                    <option <?php echo ($time_zone == 'Australia/Eucla') ? 'selected' : ''; ?>
                                        value="Australia/Eucla">(GMT+08:45) Eucla</option>
                                    <option <?php echo ($time_zone == 'Asia/Tokyo') ? 'selected' : ''; ?>
                                        value="Asia/Tokyo">
                                        (GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                    <option <?php echo ($time_zone == 'Asia/Seoul') ? 'selected' : ''; ?>
                                        value="Asia/Seoul">
                                        (GMT+09:00) Seoul</option>
                                    <option <?php ($time_zone == 'Asia/Yakutsk') ? 'selected' : ''; ?>
                                        value="Asia/Yakutsk">
                                        (GMT+09:00) Yakutsk</option>
                                    <option <?php echo ($time_zone == 'Australia/Adelaide') ? 'selected' : ''; ?>
                                        value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                    <option <?php echo ($time_zone == 'Australia/Darwin') ? 'selected' : ''; ?>
                                        value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                    <option <?php echo ($time_zone == 'Australia/Brisbane') ? 'selected' : ''; ?>
                                        value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                    <option <?php echo ($time_zone == 'Australia/Hobart') ? 'selected' : ''; ?>
                                        value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                    <option <?php echo ($time_zone == 'Asia/Vladivostok') ? 'selected' : ''; ?>
                                        value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                    <option <?php echo ($time_zone == 'Australia/Lord_Howe') ? 'selected' : ''; ?>
                                        value="Australia/Lord_Howe">
                                        (GMT+10:30) Lord Howe Island</option>
                                    <option <?php echo ($time_zone == 'PacificEtc/GMT-11') ? 'selected' : ''; ?>
                                        value="Etc/GMT-11">
                                        (GMT+11:00) Solomon Is., New Caledonia</option>
                                    <option <?php echo ($time_zone == 'Asia/Magadan') ? 'selected' : ''; ?>
                                        value="Asia/Magadan">
                                        (GMT+11:00) Magadan</option>
                                    <option <?php echo ($time_zone == 'Pacific/Norfolk') ? 'selected' : ''; ?>
                                        value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
                                    <option <?php echo ($time_zone == 'Asia/Anadyr') ? 'selected' : ''; ?>
                                        value="Asia/Anadyr">
                                        (GMT+12:00) Anadyr, Kamchatka</option>
                                    <option <?php echo ($time_zone == 'Pacific/Auckland') ? 'selected' : ''; ?>
                                        value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                    <option <?php echo ($time_zone == 'Pacific/Midway') ? 'selected' : ''; ?>
                                        value="Etc/GMT-12">
                                        (GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                    <option <?php echo ($time_zone == 'Pacific/Chatham') ? 'selected' : ''; ?>
                                        value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
                                    <option <?php echo ($time_zone == 'Pacific/Midway') ? 'selected' : ''; ?>
                                        value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                    <option <?php echo ($time_zone == 'Pacific/Kiritimati') ? 'selected' : ''; ?>
                                        value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lrt" class="col-sm-3 col-form-label"><?php echo display('ltr_or_rtr') ?></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="rtr" id="lrt">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="0" <?php if ($rtr == 0) {
                                                            echo "selected";
                                                        } ?>>
                                        <?php echo display('ltr') ?></option>
                                    <option value="1" <?php if ($rtr == 1) {
                                                            echo "selected";
                                                        } ?>>
                                        <?php echo display('rtr') ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="captcha"
                                class="col-sm-3 col-form-label"><?php echo display('captcha') ?></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="captcha" id="captcha">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="1" <?php if ($captcha == '1') {
                                                            echo "selected";
                                                        } ?>>
                                        <?php echo display('active') ?></option>
                                    <option value="0" <?php if ($captcha == '0') {
                                                            echo "selected";
                                                        } ?>>
                                        <?php echo display('inactive') ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sms_service"
                                class="col-sm-3 col-form-label"><?php echo display('sms_service') ?></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="sms_service" id="sms_service">
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="0" <?php if ($sms_service == 0) {
                                                            echo "selected";
                                                        } ?>>
                                        <?php echo display('inactive') ?></option>
                                    <option value="1" <?php if ($sms_service == 1) {
                                                            echo "selected";
                                                        } ?>>
                                        <?php echo display('active') ?></option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?php echo base_url('dashboard/Csms_setting/sms_configuration') ?>"
                                    target="_blank"><?php echo display('sms_configuration') ?></a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-customer" class="btn btn-success btn-large"
                                    name="add-customer" value="<?php echo display('save_changes') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add new customer end -->