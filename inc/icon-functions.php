<?php
/**
 * SVG icons related functions
 */

 /**
  * Gets the SVG code for a given icon
  */

  function capezzahill_get_icon_svg( $icon, $size = 24 ) {
      return CapezzaHill_SVG_Icons::get_svg( 'ui', $icon, $size );
  }