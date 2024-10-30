<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}

/**
 * widget-form.php - The form for the widget.
 *
 * @package Business Block Widget
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>

<p>
     <label for="<?php echo $this->get_field_id('title'); ?>">
<?php _e('Widget Title:<br /><small>Leave blank to use Business Name</small>', 'business-block-widget'); ?>
     </label>
     <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
     <label for="<?php echo $this->get_field_id('link_title'); ?>">
<?php _e('Link Name To URL:', 'business-block-widget'); ?>
     </label>
     <input name="<?php echo $this->get_field_name('link_title'); ?>" id="<?php echo $this->get_field_id('link_title'); ?>" type="checkbox" value="1" <?php checked($instance['link_title'], true); ?> />
</p>
<p>
     <label for="<?php echo $this->get_field_id('template'); ?>">
<?php _e('Display Template', 'business-block-widget'); ?>
     </label>
     <select name="<?php echo $this->get_field_name('template'); ?>" id="<?php echo $this->get_field_id('template'); ?>">
<?php echo $this->get_templates($instance['template']); ?>
     </select>
</p>

<h3><?php _e('Business Information', 'business-block-widget'); ?></h3>
<p>
     <label for="<?php echo $this->get_field_id('name'); ?>">
<?php _e('Business Name:', 'business-block-widget'); ?>
     </label>
     <input class="widefat" name="<?php echo $this->get_field_name('name'); ?>" id="<?php echo $this->get_field_id('name'); ?>" type="text" value="<?php echo $instance['name']; ?>" />
</p>
<p>
     <label for="<?php echo $this->get_field_id('address_1'); ?>">
<?php _e('Business Address:', 'business-block-widget'); ?>
     </label>
     <input class="widefat" name="<?php echo $this->get_field_name('address_1'); ?>" id="<?php echo $this->get_field_id('address_1'); ?>" type="text" value="<?php echo $instance['address_1']; ?>" />
     <input class="widefat" name="<?php echo $this->get_field_name('address_2'); ?>" id="<?php echo $this->get_field_id('address_2'); ?>" type="text" value="<?php echo $instance['address_2']; ?>" />
</p>
<p>
     <label for="<?php echo $this->get_field_id('city'); ?>">
<?php _e('City:', 'business-block-widget'); ?>
          <input class="widefat" name="<?php echo $this->get_field_name('city'); ?>" id="<?php echo $this->get_field_id('city'); ?>" type="text" value="<?php echo $instance['city']; ?>" />
     </label>
</p>
<p>
     <label for="<?php echo $this->get_field_id('state'); ?>">
<?php _e('State:', 'business-block-widget'); ?>
          <input class="widefat" name="<?php echo $this->get_field_name('state'); ?>" id="<?php echo $this->get_field_id('state'); ?>" type="text" value="<?php echo $instance['state']; ?>" />
     </label>
</p>
<p>
     <label for="<?php echo $this->get_field_id('zip'); ?>">
<?php _e('Postal Code:', 'business-block-widget'); ?>
          <input class="widefat" name="<?php echo $this->get_field_name('zip'); ?>" id="<?php echo $this->get_field_id('zip'); ?>" type="text" value="<?php echo $instance['zip']; ?>" />
     </label>
</p>
<h3><?php _e('Telephone Numbers', 'business-block-widget'); ?></h3>
<p>
     <select name="<?php echo $this->get_field_name('phone_type_1'); ?>" id="<?php echo $this->get_field_id('phone_type_1'); ?>">
<?php echo $this->phone_types($phone_type_1); ?>
     </select>
     <input name="<?php echo $this->get_field_name('phone_1'); ?>" id="<?php echo $this->get_field_id('phone_1'); ?>" type="text" value="<?php echo $instance['phone_1']; ?>" style="width: 125px;" />
</p>
<p>
     <select name="<?php echo $this->get_field_name('phone_type_2'); ?>" id="<?php echo $this->get_field_id('phone_type_2'); ?>">
<?php echo $this->phone_types($phone_type_2); ?>
     </select>
     <input name="<?php echo $this->get_field_name('phone_2'); ?>" id="<?php echo $this->get_field_id('phone_2'); ?>" type="text" value="<?php echo $instance['phone_2']; ?>" style="width: 125px;" />
</p>
<p>
     <select name="<?php echo $this->get_field_name('phone_type_3'); ?>" id="<?php echo $this->get_field_id('phone_type_3'); ?>">
<?php echo $this->phone_types($phone_type_3); ?>
     </select>
     <input name="<?php echo $this->get_field_name('phone_3'); ?>" id="<?php echo $this->get_field_id('phone_3'); ?>" type="text" value="<?php echo $instance['phone_3']; ?>" style="width: 125px;" />
</p>

<h3><?php _e('Web Information', 'business-block-widget'); ?></h3>

<p>
     <label for="<?php echo $this->get_field_id('url'); ?>">
<?php _e('Business Web Site:', 'business-block-widget'); ?>
     </label>
     <input class="widefat" name="<?php echo $this->get_field_name('url'); ?>" id="<?php echo $this->get_field_id('url'); ?>" type="text" value="<?php echo $instance['url']; ?>" />
</p>
<p>
     <label for="<?php echo $this->get_field_id('target'); ?>">
<?php _e('Link Target:<br /><small>Affects all links in the widget.</small>', 'business-block-widget'); ?>
     </label>
     <select name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
          <option value="0"<?php selected($instance['target'], 0); ?>>None</option>
          <option value="_blank" <?php selected($instance['target'], '_blank'); ?>>New Window</option>
          <option value="_top" <?php selected($instance['target'], '_top'); ?>>Top Window</option>
     </select>
</p>
<p>
     <label for="<?php echo $this->get_field_id('contact_page'); ?>">
<?php _e('Contact Page:<br /><small>Can be a web page URL or an email address preceded by mailto:</small', 'business-block-widget'); ?>
     </label>
     <input class="widefat" name="<?php echo $this->get_field_name('contact_page'); ?>" id="<?php echo $this->get_field_id('contact_page'); ?>" type="text" value="<?php echo $instance['contact_page']; ?>" />
</p>