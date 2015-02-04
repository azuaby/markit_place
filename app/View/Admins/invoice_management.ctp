<body class=""> 
  <!--<![endif]-->
   
   
   
 <div class="content">
 
 
 			<div class="box span12">
				<div class="box-header">
					<h2>Invoices</h2>
				</div>
				<div class="box-content" style="margin-bottom:-20px;">
			        <ul class="breadcrumb">
			            <li><a data-ajax="false" href="<?php echo SITE_URL.'mobile/'; ?>">Home</a> <span class="divider">/</span></li>
			           	<li class="active">Invoices</li>
			        </ul>
				</div>
			</div>
			
			
			



     
<div>


            
            
            	<!-----Invoice Management------->				
						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Invoices</h2>
						
					</div>
					<div class="box-content">

						<?php
						echo 'Search : <input type="text" id="invoicesval" style="margin-top:7px;">
						 <button class="btn btn-primary" onclick="invoice_search()" style="vertical-align:inherit;">Search</button>';
	echo "<div id='search_user1'>";
	echo "<div class='container-fluid'>";
		/*echo "<div class='row-fluid'>";
			//echo $this->element('admin_menu');          ,'onkeyup'=>'search_func(usersrchSrch);'
			echo "<div class='span10'>";
				echo "<div class='srchdiv'>";
					echo $this->Form->Create('usersrch',array('url'=>array('controller'=>'/','action'=>'/admin/user/management'),'id'=>'sectionform'));
						echo $this->Form->input('srch', array('type' =>'text','placeholder'=>'search by username','value'=>$srcs,'label'=>false,'class'=>'celebname_sel','style'=>'float:left;','div'=>false,'onkeyup' => "search_func();"));
						echo "<div class='btnsubmt'>";
							//echo $this->Form->submit('Submit',array('div'=>false,'class'=>'btn btn-success'));
						echo "</div>";	
					echo $this->Form->end();	
				echo "</div>";
				echo "<br claer='all'/>";
				echo "<br claer='all'/>";*/
				
				echo "<div id='userdata'>";
if($sval!="")
{
	echo "Search results for : ".$sval;
			echo '<br>';
			echo '<a href="'.SITE_URL.'admin/payments/" style="text-decoration:underline;color:blue"><b><i>Clear Search Results</i></b></a>';
	echo '<br /><br />';	
}				
					echo '<table id="myTable" class="tablesorter table table-striped table-bordered table-condensed" width="100%">';
						echo '<thead>';
							echo '<tr>';
								echo '<th style="cursor:pointer;">Order Id</th>';
								echo '<th style="cursor:pointer;">Invoice Id.</th>';
								echo '<th style="cursor:pointer;">Invoice No</th>';
								echo '<th style="cursor:pointer;">Invoice Date</th>';
								echo '<th style="cursor:pointer;">Invoice Status</th>';
								echo '<th style="cursor:pointer;">Payment Method</th>';
								echo '<th style="cursor:pointer;">View Invoice</th>';
							echo '</tr>';
							echo '<tbody>';
							if(!empty($userdet))
							{
								foreach($userdet as $user_det){
									$id=$user_det['Invoices']['invoiceid'];
									echo '<tr id="del_'.$id.'">';
									foreach($invoice_orders as $invoiceorders)
									{
										if($invoiceorders['Invoiceorders']['invoiceid']==$user_det['Invoices']['invoiceid'])
										{
											$invoice_order_id = $invoiceorders['Invoiceorders']['invoiceid'];
										}
									}
										echo '<td class="orderId">'.$invoice_order_id.'</td>';
										echo '<td class="invoiceId">'.$user_det['Invoices']['invoiceid'].'</td>';
										echo '<td class="invoiceNo">'.$user_det['Invoices']['invoiceno'].'</td>';
										$day=date('m/d/Y',$user_det['Invoices']['invoicedate']);
										echo '<td class="invoiceDate">'.$day.'</td>';
										echo '<td class="invoiceStatus">'.$user_det['Invoices']['invoicestatus'].'</td>';
										echo '<td class="invoicePayMthd">'.$user_det['Invoices']['paymentmethod'].'</td>';
										echo '<td>
											<input type="button" class="btn btn-success" style="width:auto; margin-bottom: 12px; font-size: 11px;" onclick="showInvoicePopup(\''.$id.'\')" value="View">
											<img class="inv-loader-'.$id.'" src="'.SITE_URL.'images/loading.gif" style="display:none;"></td>';
									echo '</tr>';
								}
							}
							else
							{
								echo '<tr><td colspan="7" align="center">No Results Found</td></tr>';
							}
							echo '</tbody>';
						echo '</thead>';
					echo '</table>';
					
					
					
		
if($pagecount > 0){						
		$nextPage = $this->Paginator->params->paging['Invoices']['nextPage'];
		$prevPage = $this->Paginator->params->paging['Invoices']['prevPage'];
		if(!empty($nextPage) || !empty($prevPage)){
			echo "<div  class='pagination pagination-centered'>";
				echo '<ul>';
					echo $this->Paginator->options(array('url'=>array_merge(array('controller'=>'/', 'action'=>'/admin/payments/'),$this->passedArgs)));	
					echo '<li>'.$this->Paginator->prev('Prev', array('class' => 'pPrevPg'), null).'</li>';
					echo '<li>'.$this->Paginator->numbers(array('class' => 'numberspages','style'=>'    margin: 0 5px 0 0;', 'separator' => ' ')).'</li>';
					echo '<li>'.$this->Paginator->next('Next', array('class' => 'pNextPg'), null).'</li>';
				echo '<ul>';
			echo "</div>";
		}
	}	
			
					
					
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	echo "</div>";
?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
						<!-----Invoice Management------->	
  

  

<div id="invoice-popup-overlay">
	<div class="invoice-popup">
	</div>



</div>

<script type="text/javascript" src="<?php echo SITE_URL; ?>js/jQuery.print.js"></script>
<script>
$('.inv-print').live('click',function(){
	$(".invoice_datas").print();
	return (false);
});
$('#invoice-popup-overlay, .inv-close').live ('click',function(){
		$('#invoice-popup-overlay').hide();
		$('#invoice-popup-overlay').css("opacity", "0");
	});
	

	
</script>
<style>
/**************Invoice Popup ************/


#invoice-popup-overlay {
	background: none repeat scroll 0 0 rgba(31, 33, 36, 0.898);
    display: none;
    height: 100%;
    left: 0;
    opacity: 0;
    overflow: scroll;
    padding: 0 24px 24px 0;
    position: fixed;
    top: 0;
    transition: opacity 0.2s ease 0s;
    width: 100%;
    z-index: 12;
}

#invoice-popup-overlay div.invoice-popup {
	width: 800px;
	margin: 92px auto;
}

#invoice-popup-overlay .invoice-popup div#userdata {
    background: none repeat scroll 0 0 #FFFFFF;
    padding: 25px 25px 100px;
}
</style>