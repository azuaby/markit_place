<script>
	$(document).ready(function(){
		//alert($.browser.msie);
		if ($.browser.msie) {
			$('.placeholder').each(function(){
			//$('input[placeholder]').each(function(){
			   
				var input = $(this);       
			   
				$(input).val(input.attr('placeholder'));
					   
				$(input).focus(function(){
					 if (input.val() == input.attr('placeholder')) {
						 input.val('');
					 }
				});
			   
				$(input).blur(function(){
					if (input.val() == '' || input.val() == input.attr('placeholder')) {
						input.val(input.attr('placeholder'));
					}
				});
			});
		}
    });
</script>
<?php
	echo "<div class='popupContact2' style='position:relative; z-index:2000;'>";
		echo "<div class='popup_top'></div>";
		echo "<div class='popup_center'>";
			echo "<div class='closebut' onclick='end()'><a></a></div>";
				echo "<div class='centerform'>";
					echo "<br clear='all'/>";
					echo "<span class='loginheads'><img src='".SITE_URL."img/signup_text.png' /></span>";
					echo "<br clear='all'/>";
					echo "<div class='fbbtn'><div class='custom-fb-login-button fbconnt'>.</div></div>";
					echo "<br clear='all'/>";
					echo "<p class='paragraph'>* N�s n�o postamos nada sem a sua permiss�o.*</p>";
					echo "<h3 style='text-align: center; font-weight: normal;'>(ou)</h3>";
					echo "<br/>";
					echo '<div id="alert" class="alert alert-error" style="display: none;"></div>';
					echo "<br clear='all'/>";
					echo $this->Form->create('signup', array('url' => array('controller' => '/', 'action' => '/signup'), 'id'=>'signupform'));
						
						echo "<div class='input_wrap_popup'>";
							echo "<input type='text' class='input-small input_small placeholder' id='firstname' name='data[signup][firstname]' placeholder='Primeiro Nome'/>";
							echo '<input type="text" class="input-small input_small placeholder" id="lastname" name="data[signup][lastname]" placeholder="�ltimo Nome"/>';
						echo "</div>";
						echo "<br/>";
						echo "<div class='input_wrap_popup'>";
							echo '<input type="text" id="email" name="data[signup][email]" placeholder="E-mail" class="placeholder">';
						echo "</div>";
						echo "<br />";
						echo "<div class='input_wrap_popup'>";
							//echo '<input type="text" id="gender" name="data[signup][gender]" placeholder="Email Address" class="placeholder">';
							echo "<span class='labelclass' style='margin-bottom: 3px;margin-top: 0px;margin-left: 20px;width: 85px;'>Sexo : </span>";							
							echo "<span style='font-weight: bold; font-size: 16px;'>";
								echo $this->Form->radio('gender',array( 'male'=>'masculino', 'female'=>'feminino'),array('fieldset'=>false,'label'=>false,'legend'=>false,'name'=>'data[signup][gender]','class'=>'genderradio'));
							echo "</span>";
						echo "</div>";
						echo "<br/>";
						echo "<div class='input_wrap_popup'>";
							echo '<input type="text" id="regcity" name="data[signup][city]" placeholder="Sua cidade" class="placeholder"/>';
						echo "</div>";
						echo "<div class='input_wrap_popup'>";
							echo "<span class='labelclass' style='margin-bottom: 3px;width: 240px;'>Data de Anivers�rio: </span>";
							echo "<br clear='all'/>";
							echo $this->Form->day('dob', array('empty' => 'DIA','class'=>'selectbox','style'=>'margin-left: 18px;'));
							//echo $this->Form->month('dob', array('empty' => "M�S",'class'=>'selectbox'));
							
							$mnth_array = array(''=>'M�S','01'=>'Janeiro','02'=>'Fevereiro','03'=>'Mar�o','04'=>'Abril','05'=>'Maio','06'=>'Junho','07'=>'Julho','08'=>'Agosto','09'=>'Setembro','10'=>'Outubro',
							'11'=>'Novembro','12'=>'Dezembro');
							foreach($mnth_array as $key=>$mth){
								$mth_options[$key] = $mth;
							}
							echo $this->Form->input('dobs', array('type'=>'select', 'div'=>false, 'id'=>'signupDobMonth','label'=>false, 'options'=>$mth_options, 'name'=>'data[signup][dob][month]', 'class'=>'selectbox'));
							echo $this->Form->year('dob',  date('Y') - 100, date('Y'), array('empty' => "ANO",'class'=>'selectbox'));							
							echo "<div class='error_wrap'>";
								echo "<div class='err_m' style='float: left;text-align: center;'>";
									echo "<span class='error_text' id='div_pop_date'> </span>";
								echo "</div>";
								//echo "<br clea='all'/>";
							echo "</div>";
						echo "</div>";
						
						/* $current=date('Y');
						echo "<div class='input_wrap_popup'>";
							echo "<span class='labelclass' style='margin-bottom: 3px;width: 140px;'>Your birthday date : </span>";
							echo "<br clear='all'/>";
							echo $this->Form->input(' ', array(
								'type' => 'date',
								'minYear'=>'1900',
								'dateFormat'=>'D,M,Y',
								'maxYear'=>$current,
								'lable'=>false,
								'class'=>'selectbox'								
							));
							echo "<div class='error_wrap'>";
								echo "<div class='err_m' style='float: left;text-align: center;'>";
									echo "<span class='error_text' id='div_pop_date'> </span>";
								echo "</div>";
								//echo "<br clea='all'/>";
							echo "</div>";
						echo "</div>";*/
						echo "<br/>";
						echo "<div class='input_wrap_popup'>";
							echo '<input type="password" id="password" name="data[signup][password]" placeholder="Senha" class="placeholder">';
						echo "</div>";
						echo "<div class='input_wrap_popup confirm'>";
							echo '<input type="password" id="rpassword" name="data[signup][rpassword]" placeholder="Re-digite sua Senha" class="placeholder">';
						echo "</div>";
						
						
						echo '<span class="termsline"><b>'.'Ao clicar em "Criar conta" ou "Conecte com Facebook",<br/>'.'Voc� confirma que aceita o '.'<a href="'.SITE_URL.'terms" target="_blank"><a href="'.SITE_URL.'terms" target="_blank" style="color:#1BB3E2;">Termos de Uso.</a>'.'</b></span></a>';
						echo "<br clear='all'/><br/>";
						echo '<label class="checkbox"><input type="checkbox"> Remember me</label>';
						echo "<div class='enter_sub_pop' style='float: right;'>";
							//echo $this->Form->submit('',array('div'=>false,'class'=>'enter_btn'));
							//echo "<a href='javascript:void(0);' class='enter_btn' onclick='signform();'></a>";
							echo '<a href="javascript:void(0);" onclick="signform()" style="height: 18px;padding: 10px 0;position: relative;width: 155px;" class="btn btn-success">Crie uma Conta</a>';
						echo "</div>";
						
						echo "<br clear='all'/>";
					echo $this->Form->end();
					echo "<br clea='all'/><br/>";
					echo "<div class='linesbtm'></div>";
					echo "<br/>";
					echo '<span><h4>J� � membro do Meuaniver?</h4></span>';
					echo "<span class='loginbtn'><a href='javascript:void(0);' onclick='login()'></a></span>";
					echo "<br clear='all'/><br/>";
				echo "</div>";				
			echo "</div>";
		echo "<div class='popup_top'></div>";
	echo "</div>";
	echo "<div class='registering' style='position:relative; z-index:2000;display:none;top:200px'>";
		echo "<div class='popup_top'></div>";
		echo "<div class='popup_center'>";
			//echo "<div class='closebut' onclick='end()'><a></a></div>";
				echo "<div class='centerform'>";
					echo "<br/>";
					echo "<div style=' width: 235px;margin:0 auto;'>";
						echo "<div class='mail_sent_icon'></div>";
					echo "</div>";
					echo "<br clear='all'/><br/>";
					echo "<h2 class='loginhead' style='margin-bottom: 3px;'>E-mail de Confirma��o enviado!</h2>";
					echo "<h4 style='width: 360px; text-align: center; line-height: 20px;'><b>Um e-mail lhe foi enviado. Favor abr�-lo e CLICAR no link para finalizar seu Registro. </h4>";
					echo "<br clear='all'/><br/><br/>";
					echo "<div style='width: 47px;margin:0 auto;'>";
						//echo "<a href='javascript:void(0)' class='btn btn-success' onclick='signupform1();'>OK</a>";
						echo "<a href='javascript:void(0)' class='btn btn-success' onclick='signupform1();'>OK</a>";
						echo "<br clear='all'/>";
					echo "</div>";
					echo "<br clear='all'/><br/><br/>";				
				echo "</div>";
		echo "</div>";
		echo "<div class='popup_top'></div>";
	echo "</div>";
?>
<style>
.paragraph{
	color: #A6A6A6;
    font-size: 13px;
    font-weight: bold;
    text-align: center;
	padding-top: 7px;
}
.input_small {
    height: 27px;
    margin-left: 20px;
    padding-left: 8px;
    width: 150px !important;
}
input {
    color: #717171 !important;
    font-size: 14px !important;
	height: 27px;
    margin-left: 20px;
    width: 340px;
	font-weight: bold;
}
.selectbox{
	font-weight: bold;
    height: 30px;
    padding-left: 0;
    width: 110px !important;
	margin-left: 7px;
}
.date{
	margin-left: 10px;
}
.checkbox {
    float: left;
    font-weight: bold;
    margin-left: 25px;
    margin-top: 12px;
    width: 100px;
}
h4{
	color: #5B5B5B;
    float: left;
    font-size: 16px;
    margin-left: 20px;
    margin-top: 12px;
    width: 250px;
}
.pac-container{
	z-index: 100001 !important;
}
.genderradio{
	margin-right: 5px!important;
	margin-left: 3px!important;
}
</style>