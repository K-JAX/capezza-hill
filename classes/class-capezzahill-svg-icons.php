<?php
/**
 * SVG Icons class
 * 
 * This class is in charge of displaying SVG icons across the site
 * 
 * All icons are assumed to have equal width and height, hence the
 * option to only specify a `$size` parameter in the SVG methods.
 */

class CapezzaHill_SVG_Icons {


    /**
     * Gets the SVG code for a given icon.
     */
	public static function get_svg( $group, $icon, $size ) {
		if ( 'ui' == $group ) {
			$arr = self::$ui_icons;
		} elseif ( 'social' == $group ) {
			$arr = self::$social_icons;
		} else {
			$arr = array();
		}
		if ( array_key_exists( $icon, $arr ) ) {
			$repl = sprintf( '<svg class="svg-icon" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $size, $size );
			$svg  = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
			$svg  = preg_replace( "/([\n\t]+)/", ' ', $svg ); // Remove newlines & tabs.
			$svg  = preg_replace( '/>\s*</', '><', $svg ); // Remove white space between SVG tags.
			return $svg;
		}
		return null;
	}
    /**
     * Detects the social network from a URL and returns the SVG code for its icon.
     */

    static $ui_icons = array(
		'link'                   => /* material-design – link */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path d="M0 0h24v24H0z" fill="none"></path>
    <path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"></path>
</svg>',
		'watch'                  => /* material-design – watch-later */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <defs>
        <path id="a" d="M0 0h24v24H0V0z"></path>
    </defs>
    <clipPath id="b">
        <use xlink:href="#a" overflow="visible"></use>
    </clipPath>
    <path clip-path="url(#b)" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"></path>
</svg>',
		'archive'                => /* material-design – folder */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"></path>
    <path d="M0 0h24v24H0z" fill="none"></path>
</svg>',
		'tag'                    => /* material-design – local_offer */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
	<path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"></path>
	<path d="M0 0h24v24H0z" fill="none"></path>
</svg>',
		'comment'                => /* material-design – comment */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z"></path>
    <path d="M0 0h24v24H0z" fill="none"></path>
</svg>',
		'person'                 => /* material-design – person */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
    <path d="M0 0h24v24H0z" fill="none"></path>
</svg>',
		'edit'                   => /* material-design – edit */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path>
    <path d="M0 0h24v24H0z" fill="none"></path>
</svg>',
		'chevron_left'           => /* material-design – chevron_left */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
    <path d="M0 0h24v24H0z" fill="none"></path>
</svg>',
		'chevron_right'          => /* material-design – chevron_right */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
    <path d="M0 0h24v24H0z" fill="none"></path>
</svg>',
		'chevron_down'			=> /* kevin's hand-made down chevron arrow */'
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
<style type="text/css">
	.st0{fill:none;stroke:#FFFFFF;stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
</style>
<polyline class="st0" points="50.4,192.3 306,467.3 561.6,192.3 "/>
</svg>
',
'triple_chevron_down'			=> /* kevin's hand-made down chevron arrow */'
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 612 918" style="enable-background:new 0 0 612 918;" xml:space="preserve">
<style type="text/css">
	.triplet-chevron{fill:none;stroke:#FFFFFF;stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10; transform-origin: center;}
	.st0{transform: translateY(0); opacity: 0.25;}
	.st1{transform: translateY(25%); opacity: 0.5;}
	.st2{transform: translateY(50%); opacity: 0.75;}
</style>
<polyline class="triplet-chevron st0" points="50.4,192.3 306,467.3 561.6,192.3 " />
<polyline class="triplet-chevron st1" points="50.4,192.3 306,467.3 561.6,192.3 "/>
<polyline class="triplet-chevron st2" points="50.4,192.3 306,467.3 561.6,192.3 "/>
</svg>
',
		'check'                  => /* material-design – check */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path d="M0 0h24v24H0z" fill="none"></path>
    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
</svg>',
		'arrow_drop_down_circle' => /* material-design – arrow_drop_down_circle */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
	<path d="M0 0h24v24H0z" fill="none"></path>
	<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 12l-4-4h8l-4 4z"></path>
</svg>',
		'keyboard_arrow_down'    => /* material-design – keyboard_arrow_down */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
	<path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"></path>
	<path fill="none" d="M0 0h24v24H0V0z"></path>
</svg>',
		'keyboard_arrow_right'   => /* material-design – keyboard_arrow_right */ '
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
	<path d="M10 17l5-5-5-5v10z"></path>
	<path fill="none" d="M0 24V0h24v24H0z"></path>
</svg>',
		'keyboard_arrow_left'   => /* material-design – keyboard_arrow_left */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
	<path d="M14 7l-5 5 5 5V7z"></path>
	<path fill="none" d="M24 0v24H0V0h24z"></path>
</svg>',
		'arrow_drop_down_ellipsis' => /* custom – arrow_drop_down_ellipsis */ '
<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg">
    <g fill="none" fill-rule="evenodd">
        <path d="M0 0h24v24H0z"/>
        <path fill="currentColor" fill-rule="nonzero" d="M12 2c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2zM6 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
    </g>
</svg>',
		'search'	=>
'<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
	<path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
	s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
	c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
	s-17-7.626-17-17S14.61,6,23.984,6z"/>
</svg>',
		'burger'	=>
'<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
	<style type="text/css">
		.st0{fill:none;stroke:#FFFFFF;stroke-width:40;stroke-linecap:round;stroke-miterlimit:10;}
	</style>
	<g>
		<line class="st0" x1="97.3" y1="127.9" x2="514.7" y2="127.9"/>
		<line class="st0" x1="97.3" y1="306" x2="514.7" y2="306"/>
		<line class="st0" x1="97.3" y1="484.1" x2="514.7" y2="484.1"/>
	</g>
</svg>
'
    );
};

