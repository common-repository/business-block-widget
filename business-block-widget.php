<?php

/*
  Plugin Name: Business Block Widget
  Plugin URI: http://plugins.grandslambert.com/plugins/business-block-widget.html
  Description: Create widgets to display business contact information
  Author: grandslambert
  Author URI: http://grandslambert.com/
  Version: 1.4

 * *************************************************************************

  Copyright (C) 2009-2011 GrandSlambert

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

 * *************************************************************************

 */

/* Class Declaration */

class BusinessBlockWidget extends WP_Widget {

     var $version = '1.4';
     // Options page name
     var $optionsName = 'business-block-widget-options';
     var $menuName = 'business-block-widget-settings';
     var $pluginName = 'Business Block Widget';
     var $phone_types = array('Office', 'Fax', 'Toll Free', 'Cell');
     var $options = array();
     var $make_link = false;

     /**
      * Constructor
      */
     function BusinessBlockWidget() {
          $widget_ops = array('description' => __('Add a widget with business contact information. By GrandSlambert.', 'business-block-widget'));
          $this->WP_Widget('business_block_widget', __($this->pluginName, 'business-block-widget'), $widget_ops);

          $this->pluginPath = WP_CONTENT_DIR . '/plugins/' . plugin_basename(dirname(__FILE__));
          $this->load_options();

          /* Load Langague Files */
          $langDir = dirname(plugin_basename(__FILE__)) . '/lang';
          load_plugin_textdomain('recipe-press', false, $langDir, $langDir);

          /* Add aministration page. */
          add_action('admin_menu', array(&$this, 'admin_menu'));
          add_action('admin_init', array(&$this, 'admin_init'));
          add_filter('plugin_action_links', array(&$this, 'plugin_action_links'), 10, 2);
     }

     /**
      * Load Options
      */
     function load_options() {
          $defaults = array(
               'template' => 'one-column.php',
               'target' => false,
               'link_title' => false,
               'link_text' => 'Vist Web Site',
               'email_text' => 'Send Email'
          );
          $this->options = wp_parse_args(get_option($this->optionsName), $defaults);
     }

     /**
      * Adds Disclaimer options tab to admin menu
      */
     function admin_menu() {
          global $wp_version;

          add_options_page($this->pluginName . __(' Settings', 'business-block-widget'), $this->pluginName, 'manage_options', $this->menuName, array(&$this, 'options_panel'));

          // Use the bundled jquery library if we are running WP 2.5 or above
          if ( version_compare($wp_version, '2.5', '>=') ) {
               wp_enqueue_script('jquery', false, false, '1.2.3');
          }
     }

     /**
      * Adds a settings link next to Login Configurator on the plugins page
      */
     function plugin_action_links($links, $file) {
          static $this_plugin;

          if ( !$this_plugin ) {
               $this_plugin = plugin_basename(__FILE__);
          }

          if ( $file == $this_plugin ) {
               $settings_link = '<a href="' . get_option('siteurl') . '/wp-admin/options-general.php?page=' . $this->menuName . '">' . __('Settings', 'business-block-widget') . '</a>';
               array_unshift($links, $settings_link);
          }

          return $links;
     }

     /**
      * Outputs the overview sub panel
      */
     function options_panel() {
          include($this->pluginPath . '/includes/options-panel.php');
     }

     function defaults($args) {
          $defaults = array(
               'template' => $this->options['template'],
               'target' => $this->options['target'],
               'link_title' => $this->options['link_title'],
               'linkt_text' => $this->options['link_text'],
               'email_text' => $this->options['email_text'],
               'title' => '',
               'name' => '',
               'address_1' => '',
               'address_2' => '',
               'city' => '',
               'state' => '',
               'zip' => '',
               'url' => '',
               'phone_type_1' => '',
               'phone_1' => '',
               'phone_type_2' => '',
               'phone_2' => '',
               'phone_type_3' => '',
               'phone_3' => '',
               'contact_page' => ''
          );

          return wp_parse_args($args, $defaults);
     }

     /**
      * Widget code
      */
     function widget($args, $instance) {
          if ( isset($instance['error']) && $instance['error'] ) {
               return;
          }

          $instance = $this->defaults($instance);
          extract($args, EXTR_SKIP);

          $isntance['title'] = apply_filters('widget_title', $instance['title']);

          print $before_widget;

          if ( $instance['title'] ) {
               print $before_title;

               if ( $instance['link_title'] and $instance['url'] )
                    print $this->make_link($instance['url'], $instance['title'], $instance['target']);
               else
                    print $instance['title'];

               print $after_title;
          }
          include ('templates/' . $instance['template']);
          print $after_widget;
     }

     function make_link($url, $text, $target = false) {
          $output = '<a href="' . $url . '" ';
          if ( $target )
               $output.= 'target="' . $target . '"';
          $output.= '>' . $text . '</a>';

          return $output;
     }

     /** @see WP_Widget::update */
     function update($new_instance, $old_instance) {
          return $new_instance;
     }

     /** @see WP_Widget::form */
     function form($instance) {
          $instance = $this->defaults($instance);
          include( $this->pluginPath . '/includes/widget-form.php');
     }

     /**
      * Phone Types
      */
     function phone_types($selected) {
          foreach ( $this->phone_types as $type ) {
               $output.= '<option value="' . $type . '"';
               if ( $type == $selected )
                    $output.= ' selected';
               $output.= '>' . $type . '</option>';
          }

          return $output;
     }

     /**
      * Templates
      */
     function get_templates($selected, $default = true) {
          if ( $default )
               $templates = array('default');
          else
               $templates = array();

          if ( $handle = opendir($this->pluginPath . '/templates') ) {

               /* Loop through directory to get templates. */
               while (false !== ($file = readdir($handle))) {
                    if ( !is_dir($file) ) {
                         array_push($templates, $file);
                    }
               }

               closedir($handle);
          }

          foreach ( $templates as $template ) {
               $name = eregi_replace("-", " ", $template);
               $name = eregi_replace('.php', '', $name);

               $output.= '<option value="' . $template . '" ' . selected($template, $selected) . '>' . ucfirst($name) . '</option>';
          }

          return $output;
     }

     /**
      * Register the options for Wordpress MU Support
      */
     function admin_init() {
          register_setting($this->optionsName, $this->optionsName);
     }

     /**
      * Display the list of contributors.
      * @return boolean
      */
     function contributorList() {
          $this->showFields = array('NAME', 'LOCATION', 'COUNTRY');
          print '<ul>';

          $xml_parser = xml_parser_create();
          xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
          xml_set_element_handler($xml_parser, array($this, "start_element"), array($this, "end_element"));
          xml_set_character_data_handler($xml_parser, array($this, "character_data"));

          if ( !(@$fp = fopen('http://grandslambert.com/xml/business-block-widget/contributors.xml', "r")) ) {
               print 'There was an error getting the list. Try again later.';
               return;
          }

          while ($data = fread($fp, 4096)) {
               if ( !xml_parse($xml_parser, $data, feof($fp)) ) {
                    die(sprintf("XML error: %s at line %d",
                                    xml_error_string(xml_get_error_code($xml_parser)),
                                    xml_get_current_line_number($xml_parser)));
               }
          }

          xml_parser_free($xml_parser);
          print '</ul>';
     }

     /**
      * XML Start Element Procedure.
      */
     function start_element($parser, $name, $attrs) {
          if ( $name == 'NAME' ) {
               print '<li class="bbw-contributor">';
          } elseif ( $name == 'ITEM' ) {
               print '<br><span class="bbw-contributor_notes">Contributed: ';
          }

          if ( $name == 'URL' ) {
               $this->make_link = true;
          }
     }

     /**
      * XML End Element Procedure.
      */
     function end_element($parser, $name) {
          if ( $name == 'ITEM' ) {
               print '</li>';
          } elseif ( $name == 'ITEM' ) {
               print '</span>';
          } elseif ( in_array($name, $this->showFields) ) {
               print ', ';
          }

          $this->makeLink = false;
     }

     /**
      * XML Character Data Procedure.
      */
     function character_data($parser, $data) {
          if ( $this->make_link ) {
               print '<a href="http://' . $data . '" target="_blank">' . $data . '</a>';
               $this->make_link = false;
          } else {
               print $data;
          }
     }

}

add_action('widgets_init', create_function('', 'return register_widget("BusinessBlockWidget");'));

/* Convert old database settings */
register_activation_hook(__FILE__, 'business_block_activate');

function business_block_activate() {

     /* Compile old options into new options Array */
     $options = array(
          'widget_link_title' => 'link_title',
          'widget_target' => 'target',
          'default_template' => 'template',
          'link_text' => 'link_text',
          'email_text' => 'email_text'
     );

     foreach ( $options as $old => $new ) {
          if ( $old_option = get_option('business_block_' . $old) ) {
               $new_options[$new] = $old_option;
               delete_option('business_block_' . $old);
          }
     }
     if ( !add_option('business-block-widget-options', $new_options) ) {
          update_option('business-block-widget-options', $new_options);
     }
}