<?php
/**
 * Copyright 2017 OneAll, LLC.
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
 * Retrieves the LoudVoice comments from the API and builds pure HTML to output on the page.
 * For browsers having JavaScript enabled this HTML is then replaced by the LoudVoice interface.
 *
 */


// Configuration
require '../../config.php';

// Reference of discussion on the current page
$discussion_reference = '@demo-crawlable';

// Comments HTML
$comments_html = '';

// Retrieve comments
if ($oneall_curly->get (SITE_DOMAIN . "/loudvoice/discussions/discussion/comments.json?discussion_reference=" . $discussion_reference))
{
    // Check result
    $result = $oneall_curly->get_result ();
    if ($result->http_code == 200)
    {
    	$data = @json_decode ($result->body);

    	// Do we have any comments?
    	if ( ! empty ($data->response->result->data->comments->count))
    	{
    		foreach ($data->response->result->data->comments->entries AS $comment)
    		{
    			$comments_html .= '
    			<div class="comment" id="comment-'.$comment->post_order.'">
    				<div class="comment_date">'.$comment->date_creation.'</div>
    				<div class="comment_author">'.$comment->author->name.'</div>
    				<div class="comment_text">'.$comment->text.'</div>
    			</div>
    			<hr />
    		';
    		}
    	}
    }
}

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>LoudVoice</title>
		<script type="text/javascript">
		    var oa = document.createElement('script');
		    oa.type = 'text/javascript'; oa.async = true;
		    oa.src = '//<?php echo SITE_SUBDOMAIN ?>.api.oneall.com/socialize/library.js';
		    var s = document.getElementsByTagName('script')[0];
		    s.parentNode.insertBefore(oa, s);
		</script>
	</head>
	<body>

		<div id="loudvoice_container"><?php echo $comments_html; ?></div>

		<script type="text/javascript">
 			 var _oneall = _oneall || [];
  			_oneall.push(['loudvoice', 'set_providers', ['facebook', 'twitter', 'google']]);
  			_oneall.push(['loudvoice', 'set_page', document.title, window.location.href]);
  			_oneall.push(['loudvoice', 'set_reference', '<?php echo $discussion_reference; ?>']);
  			_oneall.push(['loudvoice', 'do_render_ui', 'loudvoice_container']);
		</script>

	</body>
</html>