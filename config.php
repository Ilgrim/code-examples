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

// Please enter your OneAll Site settings here
define ('SITE_SUBDOMAIN', 'loudvoice-test');			// Example: mysubdomain
define ('SITE_PUBLIC_KEY', '508c705a-c7e6-405d-b710-415ba764cb56');			// Example: b842444d-295c-472f-8aed-b757c4ff678f
define ('SITE_PRIVATE_KEY', 'bfc4d555-e427-4157-8242-c8f0a0ab50b9'); 		// Example: e27d4bb2-a4fb-4c3a-90d9-e5b20368cd61

if (strlen (SITE_SUBDOMAIN) == 0 || strlen (SITE_PUBLIC_KEY) == 0 || strlen (SITE_PRIVATE_KEY) == 0)
{
	die ("Please enter your configuration in ". __FILE__);
}

// Should not be changed
define ('SITE_DOMAIN', 'https://' . SITE_SUBDOMAIN . '.api.oneall.com');

// HTTP Transfer Handler
require 'includes/oneall_curly.php';

// Pretty JSON Formatter
require 'includes/oneall_pretty_json.php';

// Setup new connection
$oneall_curly = new oneall_curly ();
$oneall_curly->set_option ('USERPWD', SITE_PUBLIC_KEY . ':' . SITE_PRIVATE_KEY);

// Change to 1 to display the CURL output
$oneall_curly->set_option ('VERBOSE', 0);