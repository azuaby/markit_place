<?php ?>

<style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

  <body class="http-error">
  <!--<![endif]-->

						<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2>Error Code</h2>
					</div>
					<div class="box-content">
<?php
	echo "<div class='containerdiv'>";
		
		
		echo $this->Form->Create('error');
		echo $this->Form->input('content',array('type'=>'textarea','style'=>'width:800px;','id'=>'description','class'=>'inputform','value'=>$error_content,'name'=>'content'));
		
		
		echo $this->Form->submit('Save',array('div'=>false,'class'=>'btn btn-primary reg_btn' ));
		echo $this->Form->end();
	echo "</div>";
?>
<div id="frame"></div>
        
  </div></div></div>
<script type="text/javascript">
var iframe = document.createElement('iframe');
var html = $("#description").val();
var cssLink = document.createElement("link") 
cssLink.href = "<?php echo SITE_URL; ?>css/style.min.css"; 
cssLink .rel = "stylesheet"; 
cssLink .type = "text/css"; 
var cssLink1 = document.createElement("link") 
cssLink1.href = "<?php echo SITE_URL; ?>css/font-awesome.min.css"; 
cssLink1 .rel = "stylesheet"; 
cssLink1 .type = "text/css"; 
document.getElementById("frame").appendChild(cssLink);
document.getElementById("frame").appendChild(cssLink1);
document.getElementById("frame").appendChild(iframe);
iframe.contentWindow.document.open();
iframe.contentWindow.document.write('<center>'+html+'</center>');
iframe.contentWindow.document.close();
iframe.width = "800px";
iframe.height = "300px";
            
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
		});
    </script>
    
  </body>
</html>



