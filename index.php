<?php
/*
Plugin Name: azan
Plugin URI : http://wp-master.ir
Author: wp-master.ir
Author URI: http://wp-master.ir
Version: 0.4
url:http://wp-master.ir
*/
defined( 'ABSPATH' ) OR die();
define('azan_dir' 					, dirname( __FILE__ ).DIRECTORY_SEPARATOR);
define('azan_path' 				, plugin_dir_url( __FILE__ ));
/*
* load plugin language
*/
add_action( 'plugins_loaded', '_azan_widget_lang');
function _azan_widget_lang()
{
	load_plugin_textdomain( 'azan', false, dirname( plugin_basename( __FILE__ ) ).DIRECTORY_SEPARATOR);
}

class widget_azan extends WP_Widget
{
  function widget_azan()
  {
    $widget_ops = array('classname' => 'widget_azan', 'description' => __('azan' , 'azan') );
    $this->WP_Widget('widget_azan', __('azan' , 'azan'), $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'offset' => '0','mode'=>2,'city'=>27 ) );
    $offset = $instance['offset'];
    $city = $instance['city'];
    $mode = $instance['mode'];
	?>
	  <p><label for="<?php echo $this->get_field_id('offset'); ?>">اختلاف زمانی با سرور: <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo attribute_escape($offset); ?>" /></label></p>
	  <p><label for="<?php echo $mode; ?>">زمان ابزارک: <select id="<?php echo $mode; ?>" name="<?php echo $this->get_field_name('mode'); ?>">
	  
	  				<option <?php if($mode ==2 ) { echo ' selected="selected" ';} ?>value="2">انتخاب اتوماتیک</option>
					<option <?php if($mode ==1 ) { echo ' selected="selected" ';} ?>value="1">افزایش ساعت (نیمه اول سال)</option>
					<option <?php if($mode ==0 ) {echo ' selected="selected" ';} ?>value="0">بدون تغییر (نیمه دوم سال)</option>
	  </select></label></p>
	  <p><label for="<?php echo $city; ?>">شهر پیش فرض: <select  id="<?php echo $city; ?>" name="<?php echo $this->get_field_name('city'); ?>">
					<option <?php if($city ==1 ) { echo ' selected="selected" ';} ?>value="1">اراک</option>
					<option <?php if($city ==2 ) { echo ' selected="selected" ';} ?>value="2">اردبیل</option>
					<option <?php if($city ==3 ) { echo ' selected="selected" ';} ?>value="3">ارومیه</option>
					<option <?php if($city ==4 ) { echo ' selected="selected" ';} ?>value="4">اصفهان</option>
					<option <?php if($city ==5 ) { echo ' selected="selected" ';} ?>value="5">اهواز</option>
					<option <?php if($city ==6 ) { echo ' selected="selected" ';} ?>value="6">ایلام</option>
					<option <?php if($city ==7 ) { echo ' selected="selected" ';} ?>value="7">بجنورد</option>
					<option <?php if($city ==8 ) { echo ' selected="selected" ';} ?>value="8">بندرعباس</option>
					<option <?php if($city ==9 ) { echo ' selected="selected" ';} ?>value="9">بوشهر</option>
					<option <?php if($city ==10 ) { echo ' selected="selected" ';} ?>value="10">بیرجند</option>
					<option <?php if($city ==11 ) { echo ' selected="selected" ';} ?>value="11">تبریز</option>
					<option <?php if($city ==12 ) { echo ' selected="selected" ';} ?>value="12">تهران</option>
					<option <?php if($city ==13 ) { echo ' selected="selected" ';} ?>value="13">خرم آباد</option>
					<option <?php if($city ==14 ) { echo ' selected="selected" ';} ?>value="14">رشت</option>
					<option <?php if($city ==15 ) { echo ' selected="selected" ';} ?>value="15">زاهدان</option>
					<option <?php if($city ==16 ) { echo ' selected="selected" ';} ?>value="16">زنجان</option>
					<option <?php if($city ==17 ) { echo ' selected="selected" ';} ?>value="17">ساری</option>
					<option <?php if($city ==18 ) { echo ' selected="selected" ';} ?>value="18">سمنان</option>
					<option <?php if($city ==19 ) { echo ' selected="selected" ';} ?>value="19">سنندج</option>
					<option <?php if($city ==20 ) { echo ' selected="selected" ';} ?>value="20">شهرکرد</option>
					<option <?php if($city ==21 ) { echo ' selected="selected" ';} ?>value="21">شیراز</option>
					<option <?php if($city ==22 ) { echo ' selected="selected" ';} ?>value="22">قزوین</option>
					<option <?php if($city ==23 ) { echo ' selected="selected" ';} ?>value="23">قم</option>
					<option <?php if($city ==24 ) { echo ' selected="selected" ';} ?>value="24">کرمان</option>
					<option <?php if($city ==25 ) { echo ' selected="selected" ';} ?>value="25">کرمانشاه</option>
					<option <?php if($city ==26 ) { echo ' selected="selected" ';} ?>value="26">گرگان</option>
					<option <?php if($city ==27 ) { echo ' selected="selected" ';} ?>value="27">مشهد</option>
					<option <?php if($city ==28 ) { echo ' selected="selected" ';} ?>value="28">همدان</option>
					<option <?php if($city == 29) { echo ' selected="selected" ';} ?>value="29">یاسوج</option>
					<option <?php if($city ==30 ) { echo ' selected="selected" ';} ?>value="30">یزد</option>
					<?php
					$azan_opt = get_option('azan_opt' );
					$azan_opt_c = explode("\n", $azan_opt['azan_custom_cities']);
					$azan_counter = 30;
					foreach ($azan_opt_c as $value) {
						if(empty($value)) continue;
						$value_ = explode(",", $value);
						if(!isset($value_[0]) || !isset($value_[1]) || !isset($value_[2]) ) continue;
						$azan_counter++;
						$selected = '';
						if($city == $azan_counter) { $selected = 'selected="selected"'; }
						echo  '<option value="'.$azan_counter.'" '.$selected.'>'.$value_[0].'</option>';
					}

					?>

	  </select></label></p>
	<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['offset'] = $new_instance['offset'];
    $instance['mode'] = $new_instance['mode'];
    $instance['city'] = $new_instance['city'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
	extract($args, EXTR_SKIP);
	$offset = empty($instance['offset']) ? ' ' : apply_filters('widget_title', $instance['offset']);
	$mode = empty($instance['mode']) ? ' ' : apply_filters('widget_title', $instance['mode']);
	$city = empty($instance['city']) ? ' ' : apply_filters('widget_title', $instance['city']);
	echo $before_widget;
	  echo $before_title . 'اوقات شرعی' . $after_title;
	?>
	<p align="right">
	<font size="2" face="Tahoma">
		<script type='text/javascript' src='<?php echo azan_path; ?>azan-js.php'></script>
	<?php


	$now_t=time()+($offset)*60*60; 
	$now_d=date("m/d/Y g:i:s A", $now_t);

	$timingmode = $mode;
	$defaultcity= $city;

	switch ($timingmode) {
	case 2: $daycount=date("z", $now_t); $jsat=($daycount>78 && $daycount<265)?1:0; break;
	case 1: $jsat=1; break;
	case 0: default: $jsat=0; break;
	}
	echo '<script type="text/javascript">var CurrentDate= "'.$now_d.'"; var JAT= '.$jsat.'; function pz() {};init();document.getElementById("cities").selectedIndex='.$defaultcity.';coord();main();</script>';
	?>
	</font>
	</p>	
	<?php

	echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("widget_azan");') );

/*
add absolute image path js var
*/
add_action('wp_head' , 'azan_add_plugin_js_url_var' , 1);
function azan_add_plugin_js_url_var()
{
	?>
	<script type="text/javascript"> var azan_plugin_url = '<?php echo get_bloginfo('wpurl').'/wp-content/plugins/azan/'; ?>';</script>
	<?php
}


/**
* admin menu
*/
add_action( 'admin_menu', '_azan_menu');
function _azan_menu(){
	add_options_page( __('azan','azan'), __('azan','azan'), 'manage_options', 'azan', 'azan_menu' );
}
function azan_menu(){
	?>
    <script src="http://api.mygeoposition.com/api/geopicker/api.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        function lookupGeoData() {            
            myGeoPositionGeoPicker({
                startAddress     : 'Mashhad, Khorasan Razavi, Iran',
                returnFieldMap   : {
                                     'geoposition1a' : '<LAT>',
                                     'geoposition1b' : '<LNG>',
                                     'geoposition1c' : '<CITY>',   /* ...or <COUNTRY>, <STATE>, <DISTRICT>,
                                                                           <CITY>, <SUBURB>, <ZIP>, <STREET>, <STREETNUMBER> */
                                     'geoposition1d' : '<ADDRESS>'
                                   }
            });
        }
    </script>
    <div class="updated settings-error"><p><strong>
		 <?php _e('Select your city and add it to list,so you can choose it inside widget(first hit picker and then search your city,then click return data button)' ,'azan');?>
	</strong></p></div>
	<?php
	if(isset($_POST['azan_custom_cities'])){
		$cts = esc_html($_POST['azan_custom_cities']);
		$arr = array();
		if(isset($_POST['azan-lat'] , $_POST['azan-lng'] , $_POST['azan-city']) && $_POST['azan-city'] !='' && $_POST['azan-lat']!='' && $_POST['azan-lng'] !=''){
			$_POST['azan_custom_cities'] .= "\n".$_POST['azan-city'].','.$_POST['azan-lat'].','.$_POST['azan-lng'];
		}
		foreach($_POST as $key => $val){
			if(strpos($key , 'azan_') !== false)
				$arr[$key] = $val;
		}
		if(update_option( 'azan_opt', $arr )){
			file_put_contents(azan_dir.'cities.dat', serialize($_POST['azan_custom_cities']));
			echo   
			'<div class="updated settings-error"><p><strong>
			'.__('Saved' , 'azan').'
			</strong></p></div>';
		}
	}
	$azan_opt = get_option('azan_opt');
	?>
    <?php _e('Geo-Coordinates' ,'azan');?>:
     <form method="post">
    <?php _e('Latitude' , 'azan'); ?>:<input name="azan-lat" id="geoposition1a" size="20" type="text">
    <?php _e('Longitude' , 'azan'); ?>:<input name="azan-lng" id="geoposition1b" size="20" type="text">
    <input name="azan-city" id="geoposition1c" size="20" type="text">
    <!-- <input name="geoposition1d" id="geoposition1d" size="70" type="text"> -->
    <button type="button" class="button-primary" onclick="lookupGeoData();">1:<?php _e('GeoPicker' ,'azan'); ?></button>
	<input type="submit" class="button-primary" id="azan-add-me-to-list" value="2:<?php _e('save' , 'azan'); ?>">
	<br>
	<textarea style="width: 636px; height: 78px; background: none repeat scroll 0% 0% rgb(34, 34, 34); color: rgb(204, 204, 204); font-family: Lucida Console; direction: ltr ! important; text-align: left;" name="azan_custom_cities"><?php echo $azan_opt['azan_custom_cities']; ?></textarea>
    </form>
    
    <hr>
	<?php
}