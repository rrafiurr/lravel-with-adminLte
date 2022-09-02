<?php
function custom_asset($path, $secure = null) {
	// if(App::environment('local')) {
	// 	return asset($path, $secure);
	// }
	return url( '/' ) . '/assets/' . $path;
}
?>