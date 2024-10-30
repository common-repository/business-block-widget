<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}

/**
 * two-column.php - Two Column Template
 *
 * @package Business Block Widget
 * @subpackage templates
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
     <tr>
          <th colspan="2" align="center" valign="top"><?php echo $instance['name']; ?></th>
     </tr>
     <tr>
          <td align="center" valign="top">
               <?php
               if ( isset($instance['address_1']) ) {
                    echo $instance['address_1'] . '<br>';
               }

               if ( isset($isntance['address_2']) ) {
                    echo $instance['address_2'] . '<br>';
               }

               if ( isset($instance['city']) ) {
                    echo $instance['city'] . ', ';
               }

               if ( isset($instance['state']) ) {
                    echo $instance['state'] . ' &nbsp;';
               }

               if ( isset($instance['zip']) ) {
                    echo $instance['zip'];
               } ?>
          </td>
          <td align="center" valign="top">
               <?php
               if ( isset($instance['phone_1']) ) {
                    echo $instance['phone_type_1'] . ': ' . $instance['phone_1'] . '<br />';
               }

               if ( isset($instance['phone_2']) ) {
                    echo $instance['phone_type_2'] . ': ' . $instance['phone_2'] . '<br />';
               }

               if ( isset($instance['phone_3']) ) {
                    echo $instance['phone_type_3'] . ': ' . $instance['phone_3'];
               } ?>
          </td>
     </tr>
     <tr>
          <td align="center" valign="top" ><?php if ( isset($instance['url']) ) : ?>
                    <a href="<?php echo $isntance['url']; ?>" <?php
                    if ( isset($instance['target']) ) {
                         echo 'target="' . $target . '"';
                    } ?>><?php echo $this->options['link_text']; ?></a>
                  <?php endif; ?>
            </td>
            <td align="center" valign="top"><?php if ( isset($instance['contact_page']) ) : ?>
                      <a href="<?php echo $instance['contact_page']; ?>"  <?php
                         if ( isset($instance['target']) ) {
                              echo 'target="' . $instance['target'] . '"';
                         }
                  ?>><?php echo $this->options['email_text']; ?></a>
                  <?php endif; ?>
          </td>
     </tr>
</table>
