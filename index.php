<?php
/*
Plugin Name: اذان
Plugin URI : http://wp-master.ir
Author: wp-master.ir
Author URI: http://wp-master.ir
Version: 0.2
url:http://wp-master.ir
*/

class widget_azan extends WP_Widget
{
  function widget_azan()
  {
    $widget_ops = array('classname' => 'widget_azan', 'description' => 'نمایش اوقات شرعی' );
    $this->WP_Widget('widget_azan', 'نمایش اوقات شرعی', $widget_ops);
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
		<script type='text/javascript' src='<?php echo get_option('siteurl'). '/wp-content/plugins/azan/'; ?>azan-js.php'></script>
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
