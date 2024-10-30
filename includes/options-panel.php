<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}

/**
 * options-panel.php - The administration options panel.
 *
 * @package Business Block Widget
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>
<div class="wrap">
     <div class="icon32" id="icon-edit-pages"><br/>
     </div>
     <h2><?php echo $this->pluginName; ?> - <?php _e('Default Settings', 'business-block-widget'); ?></h2>
     <form method="post" action="options.php">
          <?php settings_fields($this->optionsName); ?>
          <div  style="width:49%; float:left">
               <div class="postbox">
                    <h3 class="handl" style="margin:0;padding:3px;cursor:default;"><?php _e('Default Settings', 'business-block-widget'); ?></h3>
                    <div class="table">
                         <table class="form-table">
                              <tr align="top">
                                   <th scope="row"><?php _e('Link Name to URL', 'business-block-widget'); ?></th>
                                   <td><input name="<?php echo $this->optionsName; ?>[link_title]" id="business_block_link_title" type="checkbox" value="1" <?php checked($this->options['link_title'], 1); ?> /></td>
                              </tr>
                              <tr align="top">
                                   <th scope="row"><?php _e('Default Link Target', 'business-block-widget'); ?></th>
                                   <td><select name="<?php echo $this->optionsName; ?>[target]" id="business_block_target">
                                             <option value="0" <?php selected($this->options['target'], 0); ?>><?php _e('None', 'business-block-widget'); ?></option>
                                             <option value="_blank" <?php selected($this->options['target'], '_blank'); ?>><?php _e('New Window', 'business-block-widget'); ?></option>
                                             <option value="_top" <?php selected($this->options['target'], '_top'); ?>><?php _e('Top Window', 'business-block-widget'); ?></option>
                                        </select></td>
                              </tr>
                              <tr align="top">
                                   <th scope="row"><?php _e('Default Template', 'business-block-widget'); ?></th>
                                   <td><select name="<?php echo $this->optionsName; ?>[template]" id="business_block_default_template">
                                             <?php echo $this->get_templates($this->options['template'], false); ?>
                                        </select>
                                   </td>
                              </tr>
                              <tr align="top">
                                   <th scope="row"><?php _e('Web Link Text', 'business-block-widget'); ?></th>
                                   <td><input name="<?php echo $this->optionsName; ?>[link_text]" type="text" id="business_block_link_text" value="<?php echo $this->options['link_text']; ?>" /></td>
                              </tr>
                              <tr align="top">
                                   <th scope="row"><?php _e('Email Link Text', 'business-block-widget'); ?></th>
                                   <td><input name="<?php echo $this->optionsName; ?>[email_text]" type="text" id="business_block_email_text" value="<?php echo $this->options['email_text']; ?>" /></td>
                              </tr>
                         </table>
                         <input type="hidden" name="custom_page_extension_updated" value="1" />
                         <input type="hidden" name="action" value="update" />
                         <?php if ( function_exists('wpmu_create_blog') ) : ?>
                                                  <input type="hidden" name="option_page" value="<?php echo $this->optionsName; ?>" />
                         <?php else : ?>
                                                       <input type="hidden" name="page_options" value="<?php echo $this->optionsName; ?>" />
                         <?php endif; ?>
                                                       <p class="submit" align="center">
                                                            <input type="submit" name="Submit" value="<?php _e('Save Changes', 'business-block-widget'); ?>" />
                                                       </p>
                                                  </div>
                                             </div>
                                        </div>
                                   </form>
                                   <div style="width:49%; float:right">
                                        <div class="postbox" >
                                             <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('About', 'business-block-widget'); ?></h3>
                                             <div style="padding:5px;">
                                                  <p><?php _e('This page sets the defaults for each widget. Each of these settings can be overridden when you add a business block to the sidebar.', 'business-block-widget'); ?></p>
                                                  <p><span><?php _e('You are using', 'business-block-widget'); ?> <strong> <a href="http://plugins.grandslambert.com/plugins/business-block-widget.html" target="_blank"><?php echo $this->pluginName; ?> <?php echo $this->version; ?></a></strong> by <a href="http://grandslambert.com" target="_blank">GrandSlambert</a>.</span> </p>
                                             </div>
                                        </div>
                                        <div class="postbox">
                                             <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Usage', 'business-block-widget'); ?></h3>
                                             <div style="padding:5px;">
                                                  <p><?php
                                                       printf(__('After setting the defaults, you can add widgets on the %1$s screen. Each of the defaults to the left can be overridden for each individual instance. Information for each business is stored with the widget.', 'business-block-widget'),
                                                               '<a href="' . get_option('siteurl') . '/wp-admin/widgets.php">' . __('Appearance &raquo; Widgets', 'business-block-widget') . '</a>'
                                                       );
                         ?></p>
                                             </div>
                                        </div>
                                        <div class="postbox">
                                             <h3 class="handl" style="margin:0; padding:3px;cursor:default;">
<?php _e('Recent Contributors', 'business-block-widget'); ?>
                                                  </h3>
                                                  <div style="padding:5px;">
                                                       <p><?php _e('GrandSlambert would like to thank these wonderful contributors to this plugin!', 'business-block-widget'); ?></p>
<?php $this->contributorList(); ?>
                                                  </div>
                                             </div>
                                        </div>
                                        <div style="clear:both"></div>
<?php include('footer.php'); ?>
</div>
