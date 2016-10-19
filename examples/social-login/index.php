<?php
/**
 * Copyright 2016 OneAll, LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 */


/* 
 * Please refer to http://docs.oneall.com/services/implementation-guide/setup/ 
 * 
 */ 

// Configuration
require '../../config.php';

?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Social Login Example</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="robots" content="noindex, noarchive, follow" />
	</head>
		
	<body >
		<script type="text/javascript">

			<!-- Include the OneAll Library //-->
		    var oa = document.createElement('script');
		    oa.type = 'text/javascript'; oa.async = true;
		    oa.src = '//<?php echo SITE_SUBDOMAIN; ?>.api.oneall.com/socialize/library.js';
		    var s = document.getElementsByTagName('script')[0];
		    s.parentNode.insertBefore(oa, s);
			
			<!-- Compute the callback_uri used in the example //-->
			var pathname = window.location.pathname;
			var dir = pathname.substring(0, pathname.lastIndexOf('/'));
			var protocol = window.location.protocol;
			var path = protocol + '//' + window.location.host + dir + '/';
			var callback_uri = path + 'callback_handler.php';
		
		</script>
		
		<p>
			<strong>SITE</strong><br /> 
			<?php echo SITE_SUBDOMAIN; ?>
		</p>
		<p>
			<strong>CALLBACK</strong><br />
			<script type="text/javascript">document.write(callback_uri);</script>
		</p>

		<p>
			<strong>LOGIN WITH A SOCIAL NETWORK</strong><br />
		</p>
			
		<div id="oa_social_login_container"></div>			 
		<script type="text/javascript"> 			 
			     
		    <!-- Social Login //-->
		    var _oneall = _oneall || [];
		    _oneall.push(['social_login', 'set_providers', ['facebook', 'google', 'twitter']]);
		    _oneall.push(['social_login', 'set_callback_uri', callback_uri]);
		    _oneall.push(['social_login', 'do_render_ui', 'oa_social_login_container']);
		     
		</script>
	</body>
</html>