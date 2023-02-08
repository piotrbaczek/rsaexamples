<!DOCTYPE html>
<html>
	<head>
		<title>Sign with OmniKey</title>
	</head>
	<body>
		<?php if ($_POST): ?>
			<?php print_r($_POST); ?>
			<?php file_put_contents('signature.xml', serialize($_POST)); ?>
			<?php echo 'Signature saved as signature.xml'; ?>
			<?php die(); ?>
		<?php endif; ?>
		<form id="signer" class="form-vertical form-bordered" method="POST" action="" enctype="multipart/form-data">
			<div class="tab-content padding tab-content-inline tab-content-bottom">
				<div class="tab-pane active" id="main-tab">
					<div style="text-align: center;">
						<input value="" id="xml_content" name="xml_content" type="hidden">
						<object height="120px" width="560px" type="application/x-java-applet">
							<param name="archive" value="<?php echo 'http://' . $_SERVER['SERVER_ADDR'] . '/assets/java/zeto/ZETOJSign.jar'; ?>"/>
							<param name="codebase" value="<?php echo 'http://' . $_SERVER['SERVER_ADDR'] . '/assets/java/zeto'; ?>"/>
							<param name="code" value="zetojsign.SigningApplet"/>
							<param name="FORM" value="signer"/>
							<param name="FIELD" value="xml_content"/>
							<param name="SYSTEM" value="WINDOWS"/>
							<param name="FILE" value="<?php echo base64_encode(file_get_contents('http://' . $_SERVER['SERVER_ADDR'] . '/unsignedpdf.pdf')); ?>"/>
							<param name="FILENAME" value="signature.xml"/>
							<param name="SETTINGS" value="PHNldHRpbmdzPg0KCTxpc0FkdmVuY2VkU2V0dGluZ3NWaXNpYmxlPnRydWU8L2lzQWR2ZW5jZWRTZXR0aW5nc1Zpc2libGU+DQoJPGlzU2lnbmF0dXJlVHlwZVZpc2libGU+ZmFsc2U8L2lzU2lnbmF0dXJlVHlwZVZpc2libGU+DQoJPGlzQ3JsVmlzaWJsZT50cnVlPC9pc0NybFZpc2libGU+DQoJPGlzQ3JsQWRkVmlzaWJsZT5mYWxzZTwvaXNDcmxBZGRWaXNpYmxlPg0KCTxpc1RpbWVzdGFtcFZpc2libGU+ZmFsc2U8L2lzVGltZXN0YW1wVmlzaWJsZT4NCgk8aXNBcmNoaXZhbFRpbWVzdGFtcFZpc2libGU+ZmFsc2U8L2lzQXJjaGl2YWxUaW1lc3RhbXBWaXNpYmxlPg0KCTxpc1RpbWVzdGFtcFNlcnZlclBvbGljeVZpc2libGU+ZmFsc2U8L2lzVGltZXN0YW1wU2VydmVyUG9saWN5VmlzaWJsZT4NCjwvc2V0dGluZ3M+"/>
							<param name="PREFERENCES" value=""/>
							<param name="CERTID" value=""/>
						</object>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>