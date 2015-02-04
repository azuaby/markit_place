<?php
	echo "<h3>These are constant values used for calculation the Affordability results ( Excel)</h3>";
	echo "<h5>If the below values are changed will affect in calculation.</h5>";
	echo "<br clear='all' /><br />";
	
	echo $this->Form->create('Constantval',array('url'=>array('controller'=>'/','action'=>'/save/constantvars'),'id'=>'addcntsts'));
		
		echo $this->Form->input('id',array('type'=>'hidden','label'=>false,'value'=>$const_datas[0]['Constantval']['id'],'class'=>'inputform'));		
		
		
		echo $this->Form->input('fs_tax_sgle_P44',array('type'=>'text','label'=>'1st Tax Band Single','value'=>$const_datas[0]['Constantval']['fs_tax_sgle_P44'],'id'=>'fs_tax_sgle_P44','class'=>'inputform'));		
		echo $this->Form->input('fs_tax_1_prnt_Q44',array('type'=>'text','label'=>'1st Tax Band One parent','value'=>$const_datas[0]['Constantval']['fs_tax_1_prnt_Q44'],'id'=>'fs_tax_1_prnt_Q44','class'=>'inputform'));		
		echo $this->Form->input('fs_tax_married_sgle_R44',array('type'=>'text','label'=>'1st Tax Band Married SI','value'=>$const_datas[0]['Constantval']['fs_tax_married_sgle_R44'],'id'=>'fs_tax_married_sgle_R44','class'=>'inputform'));		
		echo $this->Form->input('fs_tax_income1_T44',array('type'=>'text','label'=>'1st Tax Band Income1','value'=>$const_datas[0]['Constantval']['fs_tax_income1_T44'],'id'=>'fs_tax_income1_T44','class'=>'inputform'));		
		echo $this->Form->input('fs_tax_income2_U44',array('type'=>'text','label'=>'1st Tax Band Income2','value'=>$const_datas[0]['Constantval']['fs_tax_income2_U44'],'id'=>'fs_tax_income2_U44','class'=>'inputform'));		
		
		echo $this->Form->input('lwr_tax_sgle_P45',array('type'=>'text','label'=>'Lower Tax Rate Single','value'=>$const_datas[0]['Constantval']['lwr_tax_sgle_P45'],'id'=>'lwr_tax_sgle_P45','class'=>'inputform'));		
		echo $this->Form->input('hgr_tax_sgle_P46',array('type'=>'text','label'=>'Higher Tax Rate Single','value'=>$const_datas[0]['Constantval']['hgr_tax_sgle_P46'],'id'=>'hgr_tax_sgle_P46','class'=>'inputform'));		
		
		echo $this->Form->input('TRS_FTB_P49',array('type'=>'text','label'=>'TRS Rate FTB','value'=>$const_datas[0]['Constantval']['TRS_FTB_P49'],'id'=>'TRS_FTB_P49','class'=>'inputform'));		
		echo $this->Form->input('TRS_STB_Q49',array('type'=>'text','label'=>'TRS Rate STB','value'=>$const_datas[0]['Constantval']['TRS_STB_Q49'],'id'=>'TRS_STB_Q49','class'=>'inputform'));		
		
		echo $this->Form->input('pers_alwnce_sgle_P51',array('type'=>'text','label'=>'Personal Allowance - Single Allowance (its multiple By 5 while save)','value'=>($const_datas[0]['Constantval']['pers_alwnce_sgle_P51']/5),'id'=>'pers_alwnce_sgle_P51','class'=>'inputform'));		
		echo $this->Form->input('pers_alwnce_married_P52',array('type'=>'text','label'=>'Personal Allowance - Married Allowance (its multiple By 5 while save)','value'=>($const_datas[0]['Constantval']['pers_alwnce_married_P52']/5),'id'=>'pers_alwnce_married_P52','class'=>'inputform'));		
		echo $this->Form->input('payee_alwnce_P53',array('type'=>'text','label'=>'PAYE Allowance (its multiple By 5 while save)','value'=>($const_datas[0]['Constantval']['payee_alwnce_P53']/5),'id'=>'payee_alwnce_P53','class'=>'inputform'));		
		echo $this->Form->input('one_parnt_P54',array('type'=>'text','label'=>'One Parent Family Allowance (its multiple By 5 while save)','value'=>($const_datas[0]['Constantval']['one_parnt_P54']/5),'id'=>'one_parnt_P54','class'=>'inputform'));		
		echo $this->Form->input('home_cares_alwnce_P55',array('type'=>'text','label'=>'Home Carers Allowance (its multiple By 5 while save)','value'=>($const_datas[0]['Constantval']['home_cares_alwnce_P55']/5),'id'=>'home_cares_alwnce_P55','class'=>'inputform'));
		
		echo $this->Form->input('P79',array('type'=>'text','label'=>'PRSI Free','value'=>$const_datas[0]['Constantval']['P79'],'id'=>'P79','class'=>'inputform'));		
		echo $this->Form->input('P80',array('type'=>'text','label'=>'PRSI Exempt','value'=>$const_datas[0]['Constantval']['P80'],'id'=>'P80','class'=>'inputform'));		
		echo $this->Form->input('P81',array('type'=>'text','label'=>'Health Levy Applicable','value'=>$const_datas[0]['Constantval']['P81'],'id'=>'P81','class'=>'inputform'));		
		echo $this->Form->input('P82',array('type'=>'text','label'=>'PRSI Ceiling','value'=>$const_datas[0]['Constantval']['P82'],'id'=>'P82','class'=>'inputform'));		
		echo $this->Form->input('P83',array('type'=>'text','label'=>'Additional Contribution Level','value'=>$const_datas[0]['Constantval']['P83'],'id'=>'P83','class'=>'inputform'));		
		echo $this->Form->input('P84',array('type'=>'text','label'=>'PRSI Rate','value'=>$const_datas[0]['Constantval']['P84'],'id'=>'P84','class'=>'inputform'));		
		echo $this->Form->input('P85',array('type'=>'text','label'=>'Health Levy','value'=>$const_datas[0]['Constantval']['P85'],'id'=>'P85','class'=>'inputform'));		
		echo $this->Form->input('P86',array('type'=>'text','label'=>'Additional Health Levy','value'=>$const_datas[0]['Constantval']['P86'],'id'=>'P86','class'=>'inputform'));		
		
		echo $this->Form->input('Earnings_less_24960_P92',array('type'=>'text','label'=>'Earnings < (&#163;)24,960','value'=>$const_datas[0]['Constantval']['Earnings_less_24960_P92'],'id'=>'Earnings_less_24960_P92','class'=>'inputform'));		
		echo $this->Form->input('Earnings_grtr_24960_P93',array('type'=>'text','label'=>'Earnings > (&#163;)24,960','value'=>$const_datas[0]['Constantval']['Earnings_grtr_24960_P93'],'id'=>'Earnings_grtr_24960_P93','class'=>'inputform'));		
		echo $this->Form->input('Earnings_grtr_75036_P94',array('type'=>'text','label'=>'Earnings > (&#163;)75,036','value'=>$const_datas[0]['Constantval']['Earnings_grtr_75036_P94'],'id'=>'Earnings_grtr_75036_P94','class'=>'inputform'));		
		
		//echo $this->Form->input('single_bracket_S31',array('type'=>'text','label'=>'1st Tax Band Single','value'=>$const_datas[0]['Constantval']['single_bracket_S31'],'id'=>'single_bracket_S31','class'=>'inputform'));		
		//echo $this->Form->input('joint_bracket_S32',array('type'=>'text','label'=>'1st Tax Band Single','value'=>$const_datas[0]['Constantval']['joint_bracket_S32'],'id'=>'joint_bracket_S32','class'=>'inputform'));		
		echo $this->Form->input('frst_chld_Q38',array('type'=>'text','label'=>'Household 1st Child','value'=>$const_datas[0]['Constantval']['frst_chld_Q38'],'id'=>'frst_chld_Q38','class'=>'inputform'));		
		echo $this->Form->input('subseq_chld_Q39',array('type'=>'text','label'=>'Household Subsequent Child','value'=>$const_datas[0]['Constantval']['subseq_chld_Q39'],'id'=>'subseq_chld_Q39','class'=>'inputform'));		
		
		echo "<br clear='all' /><h4>(C1) Mortgage Interest Relief Standard Rate Tested</h4>";
		echo $this->Form->input('annl_allow_FTB_sgle_P59',array('type'=>'text','label'=>'Annual Ceiling FTB Single','value'=>$const_datas[0]['Constantval']['annl_allow_FTB_sgle_P59'],'id'=>'annl_allow_FTB_sgle_P59','class'=>'inputform'));		
		echo $this->Form->input('annl_allow_FTB_joint_Q59',array('type'=>'text','label'=>'Annual Ceiling FTB Joint','value'=>$const_datas[0]['Constantval']['annl_allow_FTB_joint_Q59'],'id'=>'annl_allow_FTB_joint_Q59','class'=>'inputform'));		
		echo $this->Form->input('annl_allow_STB_sgle_R59',array('type'=>'text','label'=>'Annual Ceiling STB Single','value'=>$const_datas[0]['Constantval']['annl_allow_STB_sgle_R59'],'id'=>'annl_allow_STB_sgle_R59','class'=>'inputform'));		
		echo $this->Form->input('annl_allow_STB_joint_S59',array('type'=>'text','label'=>'Annual Ceiling STB Joint','value'=>$const_datas[0]['Constantval']['annl_allow_STB_joint_S59'],'id'=>'annl_allow_STB_joint_S59','class'=>'inputform'));		
		
		echo $this->Form->input('SVR_Interest_Rate_B1',array('type'=>'text','label'=>'SVR Interest Rate (%)','value'=>$const_datas[0]['Constantval']['SVR_Interest_Rate_B1'],'id'=>'SVR_Interest_Rate_B1','class'=>'inputform'));		
		echo $this->Form->input('Stress_Test_Interest_Rate_B2',array('type'=>'text','label'=>'Stress Test Interest Rate (%)','value'=>$const_datas[0]['Constantval']['Stress_Test_Interest_Rate_B2'],'id'=>'Stress_Test_Interest_Rate_B2','class'=>'inputform'));	
		
		echo "<br clear='all' /><h4>(C2) Mortgage Interest Relief Stress Tested</h4>";
		echo $this->Form->input('annl_allow_FTB_sgle_W59',array('type'=>'text','label'=>'Annual Ceiling FTB Single','value'=>$const_datas[0]['Constantval']['annl_allow_FTB_sgle_W59'],'id'=>'annl_allow_FTB_sgle_W59','class'=>'inputform'));		
		echo $this->Form->input('annl_allow_FTB_joint_X59',array('type'=>'text','label'=>'Annual Ceiling FTB Joint','value'=>$const_datas[0]['Constantval']['annl_allow_FTB_joint_X59'],'id'=>'annl_allow_FTB_joint_X59','class'=>'inputform'));		
		echo $this->Form->input('annl_allow_STB_sgle_Y59',array('type'=>'text','label'=>'Annual Ceiling STB Single','value'=>$const_datas[0]['Constantval']['annl_allow_STB_sgle_Y59'],'id'=>'annl_allow_STB_sgle_Y59','class'=>'inputform'));		
		echo $this->Form->input('annl_allow_STB_joint_Z59',array('type'=>'text','label'=>'Annual Ceiling STB Joint','value'=>$const_datas[0]['Constantval']['annl_allow_STB_joint_Z59'],'id'=>'annl_allow_STB_joint_Z59','class'=>'inputform'));		
		
		echo "<br clear='all' /><h4>(J) USC  Thresholds</h4>";
		
		echo $this->Form->input('ex_2percnt_U133',array('type'=>'text','label'=>'Exempt U133 in %(e.g. 2)','value'=>($const_datas[0]['Constantval']['ex_2percnt_U133']*100),'id'=>'ex_2percnt_U133','class'=>'inputform'));		
		echo $this->Form->input('ex_4percnt_U134',array('type'=>'text','label'=>'Exempt U134 in %(e.g. 4)','value'=>($const_datas[0]['Constantval']['ex_4percnt_U134']*100),'id'=>'ex_4percnt_U134','class'=>'inputform'));		
		echo $this->Form->input('ex_7percnt_U135',array('type'=>'text','label'=>'Exempt U135 in %(e.g. 7)','value'=>($const_datas[0]['Constantval']['ex_7percnt_U135']*100),'id'=>'ex_7percnt_U135','class'=>'inputform'));		
		
		
		echo $this->Form->input('exempt_W132',array('type'=>'text','label'=>'Thresolds W132','value'=>$const_datas[0]['Constantval']['exempt_W132'],'id'=>'exempt_W132','class'=>'inputform'));		
		echo $this->Form->input('exempt_2percnt_W133',array('type'=>'text','label'=>'Thresolds W133','value'=>$const_datas[0]['Constantval']['exempt_2percnt_W133'],'id'=>'exempt_2percnt_W133','class'=>'inputform'));		
		echo $this->Form->input('exempt_4percnt_W134',array('type'=>'text','label'=>'Thresolds W134','value'=>$const_datas[0]['Constantval']['exempt_4percnt_W134'],'id'=>'exempt_4percnt_W134','class'=>'inputform'));		
		echo $this->Form->input('exempt_7percnt_W135',array('type'=>'text','label'=>'Thresolds W135','value'=>$const_datas[0]['Constantval']['exempt_7percnt_W135'],'id'=>'exempt_7percnt_W135','class'=>'inputform'));		
		
		echo $this->Form->input('max_LTV_alw_loan_grtr_400k_B32',array('type'=>'text','label'=>'Max LTV allowed for loan >400k in %(e.g. 85)','value'=>($const_datas[0]['Constantval']['max_LTV_alw_loan_grtr_400k_B32']*100),'id'=>'max_LTV_alw_loan_grtr_400k_B32','class'=>'inputform'));		
		echo $this->Form->input('max_LTV_alw_loan_lesseq_400k_B33',array('type'=>'text','label'=>'Max LTV allowed for loan =< 400 in %(e.g. 92)','value'=>($const_datas[0]['Constantval']['max_LTV_alw_loan_lesseq_400k_B33']*100),'id'=>'max_LTV_alw_loan_lesseq_400k_B33','class'=>'inputform'));		
		echo $this->Form->input('max_LTV_alw_one_bed_aprtmnt_B34',array('type'=>'text','label'=>'Max LTV allowed for one bed apartments in %(e.g. 75)','value'=>($const_datas[0]['Constantval']['max_LTV_alw_one_bed_aprtmnt_B34']*100),'id'=>'max_LTV_alw_one_bed_aprtmnt_B34','class'=>'inputform'));		
		
		echo $this->Form->input('neq_eqty_nwloan_B37',array('type'=>'text','label'=>'Neg equity  - New loan =>400 in %(e.g. 85)','value'=>($const_datas[0]['Constantval']['neq_eqty_nwloan_B37']*100),'id'=>'neq_eqty_nwloan_B37','class'=>'inputform'));		
		echo $this->Form->input('neq_eqty_nwloan_B38',array('type'=>'text','label'=>'Neg equity  - New loan =<400 in %(e.g. 85)','value'=>($const_datas[0]['Constantval']['neq_eqty_nwloan_B38']*100),'id'=>'neq_eqty_nwloan_B38','class'=>'inputform'));		
		echo $this->Form->input('neq_eqty_nwloan_B39',array('type'=>'text','label'=>'Max allowed for Neg equity mortgages in %(e.g. 175)','value'=>($const_datas[0]['Constantval']['neq_eqty_nwloan_B39']*100),'id'=>'neq_eqty_nwloan_B39','class'=>'inputform'));		
		
		echo $this->Form->input('A35',array('type'=>'text','label'=>'A35 Data value','value'=>$const_datas[0]['Constantval']['A35'],'id'=>'A35','class'=>'inputform'));		
		
	
		echo $this->Form->submit('Submit');
	echo $this->Form->end();
?>