<?php
	require 'vendor/autoload.php';

	define('SITE_URL', 'http://localhost/project/public');

	$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential('ASfX1wO57b7h47iQSVobwbTng2qcZKDyhZvNrKDEFMFnbrwN8j1fQ03Dr9rwUFksesoMGQ_VPFTVQIHV','ENvs2okVz2F_JXqMviVUV0RzBMv3rjYgpZPI7rYgdqUVFJjCWDVeBMvHEIE6HKcE-FXiuL4GoMUdnAWS')

		);
?>