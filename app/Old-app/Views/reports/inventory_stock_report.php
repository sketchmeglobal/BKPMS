<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<!-- Load paper.css for happy printing -->
<link rel="stylesheet" href="dist/paper.css">

<!-- Set page size here: A5, A4 or A3 -->
<!-- Set also "landscape" if you need -->
<style>@page { size: A4 }</style>
<style type="text/css">
	/* Client-specific Styles */
	#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
	body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
	body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

	/* Reset Styles */
	body{margin:0; padding:0;}
	img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
	table td{border-collapse:collapse;}
	#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

	/* Template Styles */

	/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: COMMON PAGE ELEMENTS /\/\/\/\/\/\/\/\/\/\ */

	/**
	* @tab Page
	* @section background color
	* @tip Set the background color for your email. You may want to choose one that matches your company's branding.
	* @theme page
	*/
	body, #backgroundTable{
		/*@editable*/ background-color:#FAFAFA;
	}

	/**
	* @tab Page
	* @section email border
	* @tip Set the border for your email.
	*/
	#templateContainer{
		/*@editable*/ border: 1px solid #DDDDDD;
	}

	/**
	* @tab Page
	* @section heading 1
	* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
	* @style heading 1
	*/
	h1, .h1{
		/*@editable*/ color:#202020;
		display:block;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:34px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ line-height:100%;
		margin-top:0;
		margin-right:0;
		margin-bottom:10px;
		margin-left:0;
		/*@editable*/ text-align:left;
	}

	/**
	* @tab Page
	* @section heading 2
	* @tip Set the styling for all second-level headings in your emails.
	* @style heading 2
	*/
	h2, .h2{
		/*@editable*/ color:#202020;
		display:block;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:30px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ line-height:100%;
		margin-top:0;
		margin-right:0;
		margin-bottom:10px;
		margin-left:0;
		/*@editable*/ text-align:left;
	}

	/**
	* @tab Page
	* @section heading 3
	* @tip Set the styling for all third-level headings in your emails.
	* @style heading 3
	*/
	h3, .h3{
		/*@editable*/ color:#202020;
		display:block;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:26px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ line-height:100%;
		margin-top:0;
		margin-right:0;
		margin-bottom:10px;
		margin-left:0;
		/*@editable*/ text-align:left;
	}

	/**
	* @tab Page
	* @section heading 4
	* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
	* @style heading 4
	*/
	h4, .h4{
		/*@editable*/ color:#202020;
		display:block;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:22px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ line-height:100%;
		margin-top:0;
		margin-right:0;
		margin-bottom:10px;
		margin-left:0;
		/*@editable*/ text-align:left;
	}

	/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: HEADER /\/\/\/\/\/\/\/\/\/\ */

	/**
	* @tab Header
	* @section header style
	* @tip Set the background color and border for your email's header area.
	* @theme header
	*/
	#templateHeader{
		/*@editable*/ background-color:#FFFFFF;
		/*@editable*/ border-bottom:0;
	}

	/**
	* @tab Header
	* @section header text
	* @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
	*/
	.headerContent{
		/*@editable*/ color:#202020;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:34px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ line-height:100%;
		/*@editable*/ padding:0;
		/*@editable*/ text-align:center;
		/*@editable*/ vertical-align:middle;
	}

	/**
	* @tab Header
	* @section header link
	* @tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
	*/
	.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
		/*@editable*/ color:#336699;
		/*@editable*/ font-weight:normal;
		/*@editable*/ text-decoration:underline;
	}

	#headerImage{
		height:auto;
		max-width:600px !important;
	}

	/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: MAIN BODY /\/\/\/\/\/\/\/\/\/\ */

	/**
	* @tab Body
	* @section body style
	* @tip Set the background color for your email's body area.
	*/
	#templateContainer, .bodyContent{
		/*@editable*/ background-color:#FFFFFF;
	}

	/**
	* @tab Body
	* @section body text
	* @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
	* @theme main
	*/
	.bodyContent div{
		/*@editable*/ color:#505050;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:14px;
		/*@editable*/ line-height:150%;
		/*@editable*/ text-align:left;
	}

	/**
	* @tab Body
	* @section body link
	* @tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
	*/
	.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
		/*@editable*/ color:#336699;
		/*@editable*/ font-weight:normal;
		/*@editable*/ text-decoration:underline;
	}

	/**
	* @tab Body
	* @section data table style
	* @tip Set the background color and border for your email's data table.
	*/
	.templateDataTable{
		/*@editable*/ background-color:#FFFFFF;
		/*@editable*/ border:1px solid #DDDDDD;
	}
	
	/**
	* @tab Body
	* @section data table heading text
	* @tip Set the styling for your email's data table text. Choose a size and color that is easy to read.
	*/
	.dataTableHeading{
		/*@editable*/ background-color:#D8E2EA;
		/*@editable*/ color:#336699;
		/*@editable*/ font-family:Helvetica;
		/*@editable*/ font-size:14px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ line-height:150%;
		/*@editable*/ text-align:left;
	}

	/**
	* @tab Body
	* @section data table heading link
	* @tip Set the styling for your email's data table links. Choose a color that helps them stand out from your text.
	*/
	.dataTableHeading a:link, .dataTableHeading a:visited, /* Yahoo! Mail Override */ .dataTableHeading a .yshortcuts /* Yahoo! Mail Override */{
		/*@editable*/ color:#FFFFFF;
		/*@editable*/ font-weight:bold;
		/*@editable*/ text-decoration:underline;
	}
	
	/**
	* @tab Body
	* @section data table text
	* @tip Set the styling for your email's data table text. Choose a size and color that is easy to read.
	*/
	.dataTableContent{
		/*@editable*/ border-top:1px solid #DDDDDD;
		/*@editable*/ border-bottom:0;
		/*@editable*/ color:#202020;
		/*@editable*/ font-family:Helvetica;
		/*@editable*/ font-size:12px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ line-height:150%;
		/*@editable*/ text-align:left;
	}

	/**
	* @tab Body
	* @section data table link
	* @tip Set the styling for your email's data table links. Choose a color that helps them stand out from your text.
	*/
	.dataTableContent a:link, .dataTableContent a:visited, /* Yahoo! Mail Override */ .dataTableContent a .yshortcuts /* Yahoo! Mail Override */{
		/*@editable*/ color:#202020;
		/*@editable*/ font-weight:bold;
		/*@editable*/ text-decoration:underline;
	}

	/**
	* @tab Body
	* @section button style
	* @tip Set the styling for your email's button. Choose a style that draws attention.
	*/
	.templateButton{
		-moz-border-radius:3px;
		-webkit-border-radius:3px;
		/*@editable*/ background-color:#336699;
		/*@editable*/ border:0;
		border-collapse:separate !important;
		border-radius:3px;
	}

	/**
	* @tab Body
	* @section button style
	* @tip Set the styling for your email's button. Choose a style that draws attention.
	*/
	.templateButton, .templateButton a:link, .templateButton a:visited, /* Yahoo! Mail Override */ .templateButton a .yshortcuts /* Yahoo! Mail Override */{
		/*@editable*/ color:#FFFFFF;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:15px;
		/*@editable*/ font-weight:bold;
		/*@editable*/ letter-spacing:-.5px;
		/*@editable*/ line-height:100%;
		text-align:center;
		text-decoration:none;
	}

	.bodyContent img{
		display:inline;
		height:auto;
	}

	/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: FOOTER /\/\/\/\/\/\/\/\/\/\ */

	/**
	* @tab Footer
	* @section footer style
	* @tip Set the background color and top border for your email's footer area.
	* @theme footer
	*/
	#templateFooter{
		/*@editable*/ background-color:#FFFFFF;
		/*@editable*/ border-top:0;
	}

	/**
	* @tab Footer
	* @section footer text
	* @tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
	* @theme footer
	*/
	.footerContent div{
		/*@editable*/ color:#707070;
		/*@editable*/ font-family:Arial;
		/*@editable*/ font-size:12px;
		/*@editable*/ line-height:125%;
		/*@editable*/ text-align:center;
	}

	/**
	* @tab Footer
	* @section footer link
	* @tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
	*/
	.footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
		/*@editable*/ color:#336699;
		/*@editable*/ font-weight:normal;
		/*@editable*/ text-decoration:underline;
	}

	.footerContent img{
		display:inline;
	}

	/**
	* @tab Footer
	* @section utility bar style
	* @tip Set the background color and border for your email's footer utility bar.
	* @theme footer
	*/
	#utility{
		/*@editable*/ background-color:#FFFFFF;
		/*@editable*/ border:0;
	}

	/**
	* @tab Footer
	* @section utility bar style
	* @tip Set the background color and border for your email's footer utility bar.
	*/
	#utility div{
		/*@editable*/ text-align:center;
	}

	#monkeyRewards img{
		max-width:190px;
	}
</style>
<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <!-- Write HTML just like a web page -->
  <!-- <section class="sheet padding-10mm">
    <article>This is an A4 document.</article>
  </section> -->
<?php
//echo json_encode($rows); 
//die;
?>
  <center>
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
		<tr>
			<td align="center" valign="top" style="padding-top:20px;">
				<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
					<tr>
						<td align="center" valign="top">
							<!-- // Begin Template Header \\ -->
							<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader">
								<tr>
									<td class="headerContent">                                            
										<!-- // Begin Module: Standard Header Image \\ -->
										<img src="http://sketchmeglobal.com/demo-baazarkolkata-pms/dist/assets/img/banner.png" style="height:150px; width:600px;" id="headerImage campaign-icon" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />
										<!-- // End Module: Standard Header Image \\ -->
									
									</td>
								</tr>
							</table>
							<!-- // End Template Header \\ -->
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
							<!-- // Begin Template Body \\ -->
							<?php
							if($rows):
							?>
							<h4 style="padding-left: 10px;">Inventory Stock Report</h4>
							<table border="0" cellpadding="10" cellspacing="0" width="100%" class="templateDataTable">
								<tr>
									<th scope="col" valign="top" width="5%" class="dataTableHeading" mc:edit="data_table_heading00"> SL# </th>
									<th scope="col" valign="top" width="40%" class="dataTableHeading" mc:edit="data_table_heading01"> Device Name </th>
									<th scope="col" valign="top" width="40%" class="dataTableHeading" mc:edit="data_table_heading02"> Device Sl.No. </th>
									<th scope="col" valign="top" width="10%" class="dataTableHeading" mc:edit="data_table_heading02">Type </th>
								</tr>
								<?php
									$sl = 1;
									foreach($rows as $row):
								?>
								<tr mc:repeatable>
									<td valign="top" class="dataTableContent" mc:edit="data_table_content00"><?=$sl?></td>
									<td valign="top" class="dataTableContent" mc:edit="data_table_content01"><?=$row->hw_name?>(<?=$row->hw_code?>)</td>
									<td valign="top" class="dataTableContent" mc:edit="data_table_content02"><?=$row->serial_no?></td>
									<td valign="top" class="dataTableContent" mc:edit="data_table_content02"><?=($row->issue_or_return == 1)? 'Issue' : 'Return'?></td>
								</tr>
								<?php
									$sl++;
									endforeach;
								?>
							</table>
							<?php
								endif;
								?>
							<!-- // End Template Body \\ -->
						</td>
					</tr>
					<tr>
						<td align="center" valign="top">
							<!-- // Begin Template Footer \\ -->
							<table border="0" cellpadding="10" cellspacing="0" width="600" id="templateFooter">
								<tr>
									<td valign="top" class="footerContent">
									
										<!-- // Begin Module: Transactional Footer \\ -->
										<table border="0" cellpadding="10" cellspacing="0" width="100%">
											<tr>
												<td valign="top">
													<div mc:edit="std_footer">
													Baazar Kolkata and Kolkata Baazar are registered trademarks of Baazar Retail Private Limited<br> (Formerly known as Bees Merchandise Private Limited)
													</div>
												</td>
											</tr>
											<tr>
												<td valign="middle" id="utility">
													<div mc:edit="std_utility">
														&nbsp;<a href="https://www.baazarkolkata.com/" target="_blank">Visit Us</a> | <a href="https://sketchmeglobal.com/">Create By</a>&nbsp;
													</div>
												</td>
											</tr>
										</table>
										<!-- // End Module: Transactional Footer \\ -->
									
									</td>
								</tr>
							</table>
							<!-- // End Template Footer \\ -->
						</td>
					</tr>
				</table>
				<br />
			</td>
		</tr>
	</table>
</center>

</body>

</html>