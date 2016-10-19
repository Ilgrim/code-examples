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

// Configuration
require '../../config.php';

// Check if we have received a connection_token
if (!empty ($_POST ['connection_token']))
{
	// Get connection_token
	$connection_token = $_POST ['connection_token'];
	
	// Make Request	
	if ($oneall_curly->get (SITE_DOMAIN . "/connections/" . $connection_token . ".json"))	
	{
		
		$result = $oneall_curly->get_result ();
		
		$json = $result->body;
		$json_decoded = json_decode ($result->body);
		
		// User Token: http://docs.oneall.com/api/resources/users/		
		$user_token = $json_decoded->response->result->data->user->user_token;

		// Identity Token: http://docs.oneall.com/api/resources/identities/
		$identity_token = $json_decoded->response->result->data->user->identity->identity_token;
		
		?>
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					<title>Social Login Result</title>
				</head>
				<body>
					<p>
						<strong>SITE</strong><br /> 
						<?php echo SITE_SUBDOMAIN; ?>
					</p>
					<p>
						<strong>user_token</strong> (<a href="http://docs.oneall.com/api/resources/users/" target="_blank">User API</a>)<br /> 
						<?php echo $user_token; ?>
					</p>
					<p>
						<strong>identity_token</strong> (<a href="http://docs.oneall.com/api/resources/identities/" target="_blank">Identity API</a>)<br /> 
						<?php echo $identity_token; ?>
					</p>		
					<p>
						<strong>Result</strong> (<a href="http://docs.oneall.com/api/basic/identity-structure/" target="_blank">Identity Structure</a>)
					</p> 
					<textarea rows="30" cols="200"><?php echo pretty_json::parse($result->body); ?></textarea>		
					<p>
						<a href="index.php">&lt;&lt; Back</a>
					</p>			
				</body>
			</html>
		<?php
	}	
	// Error	
	else	
	{		
		$result = $oneall_curly->get_result ();		
		
		?>
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					<title>Social Login Error</title>
				</head>
				<body>
					<p>
						<strong>SITE</strong><br /> 
						<?php echo SITE_SUBDOMAIN; ?>
					</p>
					<p>
						<strong>CONNECTION ERROR</strong><br /> 
						<textarea rows="30" cols="200"><?php echo htmlspecialchars ($result->http_info); ?></textarea>
					</p>	
					<p>
						<a href="index.php">&lt;&lt; Back</a>
					</p>				
				</body>
			</html>
		<?php 
	}
}