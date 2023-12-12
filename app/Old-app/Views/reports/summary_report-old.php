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
	//echo json_encode($return_lists); 
	//echo json_encode($issue_lists); 
	$status_history = json_decode($rows->status_history);
	//print_r($status_history);
	$updated_by_name = '';
	$sr_generated_by = '';
	$sr_approved_by = '';
	for($i = 0; $i < sizeof($status_history); $i++){
		if($status_history[$i]->old_status == 1 && $status_history[$i]->new_status == 2){
			$updated_by_name = $status_history[$i]->updated_by_name;
		}//end if
		if($status_history[$i]->new_status == 7){
			$sr_generated_by = $status_history[$i]->updated_by_name;
		}//end if
		if($status_history[$i]->new_status == 8){
			$sr_approved_by = $status_history[$i]->updated_by_name;
		}//end if
	}//end for
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
							<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
								<tr>
									<td valign="top">
						
										<!-- // Begin Module: Standard Content \\ -->
										<table border="0" cellpadding="20" cellspacing="0" width="100%">
											<tr>
												<td valign="top" class="bodyContent">
													<div mc:edit="std_content00">
														A Ticket <strong>(<?=$rows->ticket_number?>)</strong> was generated From the Outlet <strong>'<?=$rows->ol_name?>' (<?=$rows->ol_location?>).</strong> The ticket was generated by the operator <strong><?=$rows->emp_name?></strong>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="top" class="bodyContent">
													<div mc:edit="std_content00">
														This task <strong>first time</strong> attened by Field engineer <strong><?=$updated_by_name?></strong> 
													</div>
												</td>
											</tr>
											<tr>
												<td valign="top" class="bodyContent">
													<div mc:edit="std_content00">
														Then a Service Request <strong>Generated</strong> by <strong><?=$sr_generated_by?>.</strong> 
													</div>
												</td>
											</tr>
											<tr>
												<td valign="top" class="bodyContent">
													<div mc:edit="std_content00">
														The Service Request <strong>Approved</strong> by <strong><?=$sr_approved_by?>.</strong> 
													</div>
												</td>
											</tr>
											<tr>
												<td valign="top" style="padding-top:0; padding-bottom:0;">
												<?php
													if($return_lists):
													?>
													<h4>Damaged Device List</h4>
													<table border="0" cellpadding="10" cellspacing="0" width="100%" class="templateDataTable">
														<tr>
															<th scope="col" valign="top" width="5%" class="dataTableHeading" mc:edit="data_table_heading00"> SL# </th>
															<th scope="col" valign="top" width="30%" class="dataTableHeading" mc:edit="data_table_heading01"> Device Name </th>
															<th scope="col" valign="top" width="30%" class="dataTableHeading" mc:edit="data_table_heading02"> Device Sl.No. </th>
															<th scope="col" valign="top" width="35%" class="dataTableHeading" mc:edit="data_table_heading02"> Note </th>
														</tr>
														<?php
															$sl = 1;
															foreach($return_lists as $return_list):
														?>
														<tr mc:repeatable>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content00"><?=$sl?></td>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content01"><?=$return_list->hw_name?>(<?=$return_list->hw_code?>)</td>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content02"><?=$return_list->serial_no?></td>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content02"><?=$return_list->issue_return_note?></td>
														</tr>
														<?php
															$sl++;
															endforeach;
														?>
													</table>
													<?php
														endif;
														?>
												</td>
											</tr>
											<tr>
												<td valign="top" style="padding-top:5; padding-bottom:0;">
												<?php
												if($issue_lists):
												?>
													<h4>Issued Device List</h4>
													<table border="0" cellpadding="10" cellspacing="0" width="100%" class="templateDataTable">
														<tr>
															<th scope="col" valign="top" width="5%" class="dataTableHeading" mc:edit="data_table_heading00"> SL# </th>
															<th scope="col" valign="top" width="30%" class="dataTableHeading" mc:edit="data_table_heading01"> Device Name </th>
															<th scope="col" valign="top" width="30%" class="dataTableHeading" mc:edit="data_table_heading02"> Device Sl.No. </th>
															<th scope="col" valign="top" width="35%" class="dataTableHeading" mc:edit="data_table_heading02"> Note </th>
														</tr>
														<?php
														$sl1 = 1;
														foreach($issue_lists as $issue_list):
														?>
														<tr mc:repeatable>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content00"><?=$sl1?></td>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content01"><?=$issue_list->hw_name?>(<?=$issue_list->hw_code?>)</td>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content02"><?=$issue_list->serial_no?></td>
															<td valign="top" class="dataTableContent" mc:edit="data_table_content02"><?=$issue_list->issue_return_note?></td>
														</tr>
														<?php
														$sl1++;
														endforeach;
														?>
													</table>
													<?php
													endif;
													?>
												</td>
											</tr>
											<tr>
												<td valign="top" class="bodyContent">
													<div mc:edit="std_content01">
													A product disclaimer helps you protect your business against any liability that may come from the use of your product. For example, product disclaimers often state that the seller does not offer any warranty for the products.<br>
													You can also use it to protect your business from claims that arise from injuries sustained by misusing your products.
													</div>
												</td>
											</tr>
											<tr>
												<td align="center" valign="top" style="padding-top:0;">
													<table border="0" cellpadding="15" cellspacing="0" class="templateButton">
														<tr>
															<td valign="middle" class="templateButtonContent">
																<div mc:edit="std_content02">
																	<a href="http://www.mandrill.com/" target="_blank">Approved/Not Approved</a>
																</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<!-- // End Module: Standard Content \\ -->
										
									</td>
								</tr>
							</table>
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