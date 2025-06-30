<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.0                                                      |
# | Last modified 05.01.2015                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lethe.php');
if(!isLogged()){die('<script>window.location.href="'. lethe_admin_url .'pg.login.php";</script>');}
include_once(LETHE.DIRECTORY_SEPARATOR.'/lib/lethe.class.php');
include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/inc_module_loader.php');
include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/org_set.php');
if(!isset($_GET['pos']) || empty($_GET['pos'])){$pos='';}else{$pos=trim($_GET['pos']);}
if(!isset($_GET['ID']) || !is_numeric($_GET['ID'])){$ID=0;}else{$ID=intval($_GET['ID']);}
if(!isset($_GET['getdata']) || empty($_GET['getdata'])){$getdata='';}else{$getdata=trim($_GET['getdata']);}
if(!isset($_GET['exctyp']) || empty($_GET['exctyp'])){$exctyp=0;}else{$exctyp=intval($_GET['exctyp']);}

/* Live Date */
if($pos=='getlivedate'){
	echo(date('d.m.Y H:i:s A'));
}

include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/inc_auth.php');

/* Shell Tester */
if($pos=='shelltest'){
	if($getdata==''){$getdata='crontab';}
	
	if($exctyp==0){
		$output = ((shell_exec($getdata.' -l')) ? shell_exec($getdata.' -l'):false);
	}else{
		$output = ((exec($getdata.' -l')) ? exec($getdata.' -l'):false);
	}
	
	if($output!=false){
		if($output!=''){
			$output = htmlspecialchars($output,ENT_QUOTES,'UTF-8');
			$output = str_replace(PHP_EOL,'<br>',$output);
			$logz = '<div style="height:200px;overflow:auto;"><div style="white-space: nowrap;">'
					.'<strong>LOG:</strong><hr>'
					.$output
					.'</div></div>';
			die($logz);			
		}else{
			die(letheglobal_works);
		}
	}else{
		die(letheglobal_not_work_please_contact_to_hosting_service_provider_to_enable_shell_exec_or_use_single_cron_files_manually);
	}
}

/* Cron Resetter */
if($pos=='rstcron'){
	
	$letChr = new Crontab();
	$keepCron = array();
	$currJobs = $letChr->getJobs();
	
	foreach($currJobs as $crn){
		if(strpos($k, 'lethe') !== false){
			# Removes
		}else{
			# Keep
			$keepCron[] = $crn;
		}
	}
	
	# Remove Expired Tasks
	$db->where('pos=1')->delete('chronos');
	
	# Add Lethe Tasks
	$keepCron[] = set_min_cron." * * * * ". set_shell_cron_command ." '". lethe_root_url ."chronos/lethe.php' > /dev/null 2>&1";
	
	$getTasks = $db->get('chronos');
	foreach($getTasks as $gt){
		$keepCron[] = $gt['cron_command'];
	}
	
	# Remove All Cronjobs
	shell_exec(set_shell_command.' -r');
	
	# Load New Jobs
	foreach($keepCron as $k=>$v){
		$letChr->addJob($v);
	}
	
}

/* Advanced Cron Modifier */
if($pos=='advcron'){
	
	if($getdata==''){$getdata='crontab';}
	$output = ((shell_exec($getdata.' -l')) ? shell_exec($getdata.' -l'):false);
	
	# Simulate
	//$output = 'zaa'.PHP_EOL."*/5 * * * * /usr/bin/wget -O - -q 'http://lee/lethe/chronos/lethe.php' > /dev/null 2>&1";
	
	$draw = '<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">'
		   .'<div class="container-fluid"><div class="row"><div class="col-md-12">'
		   .'<form method="POST" action="" id="cronMod">'
		   .'<h3>Current Tasks</h3><hr>';
		   if($output==false){
			   $draw.='<span class="text-danger">shell_exec does not work!</span>';
		   }else{
			   $output = explode(PHP_EOL,$output);
			   if(count($output)==0){
					$draw.='crontab empty';
			   }else{
				   foreach($output as $val=>$k){
					   if(strpos($k, 'lethe') !== false){
						$draw.='<div class="form-group"><span class="label label-danger">Remove: '. showIn($k,'page') .'</span></div>';
					   }else{
						$draw.='<div class="form-group"><span class="label label-success">Keep: '. showIn($k,'page') .'</span></div>';
					   }
				   }
			   }
		   }
		   
		   $draw.='<h3>Lethe Tasks</h3><hr>';
		   
		   $getTasks = $db->where('pos=0')->get('chronos');
		   $draw.="Main: <code>*/5 * * * * /usr/bin/wget -O - -q 'http://lee/lethe/chronos/lethe.php'  > /dev/null 2>&1</code><br>";
		   foreach($getTasks as $gt){
			   $draw.=(($gt['SAID']==0)?'Task':'Bounce').': <code>'. $gt['cron_command'] .'</code><br>';
		   }
		   $draw.='<hr><button type="submit" name="resetCron" id="resetCron" class="btn btn-success">Reset Cron</button>';
		   $draw.='</form></div></div></div>';
	die($draw);
}

/* Template Preview */
if($pos=='temprev'){
	$opTemp = $myconn->prepare("SELECT * FROM ". db_table_pref ."templates WHERE OID=". set_org_id ." AND ID=? ". ((LETHE_AUTH_VIEW_TYPE) ? ' AND UID='. LETHE_AUTH_ID .'':'') ."") or die(mysqli_error($myconn));
	$opTemp->bind_param('i',$ID);
	$opTemp->execute();
	$opTemp->store_result();
	if($opTemp->num_rows==0){echo(letheglobal_record_not_found);}
	$sr = new Statement_Result($opTemp);
	$opTemp->fetch();
	$opTemp->close();
	echo($sr->Get('temp_contents'));
}

/* Submission Account Details */
if($pos=='getSubInfos'){
	$subAccData = getSubmission($ID,0);
	$printData = '<div class="row">
		<div class="col-md-4">
			<p><strong>'. newsletter_daily_limit .':</strong></p>
			<p><strong>'. letheglobal_sending .':</strong></p>
			<p><strong>'. letheglobal_type .':</strong></p>
			<p><strong>'. newsletter_test_mail .':</strong></p>
		</div>
		<div class="col-md-8">
			<p>'. $subAccData['daily_sent'] .' / '. $subAccData['daily_limit'] .'</p>
			<p>'. $LETHE_MAIL_METHOD[$subAccData['send_method']] .'</p>
			<p>'. $LETHE_MAIL_TYPE[$subAccData['mail_type']] .'</p>
			<p>'. set_org_test_mail .'</p>
		</div>
	</div>';
	$printData.='
		<script>
			if($("#campaign_sender_title").val()==""){
				$("#campaign_sender_title").val("'. showIn(set_org_sender_title,'input') .'");
			}
			if($("#campaign_reply_mail").val()==""){
				$("#campaign_reply_mail").val("'. showIn(set_org_reply_mail,'input') .'");
			}
		</script>
	';
	echo($printData);
}

if($pos=='saveNewBounces'){
	if(DEMO_MODE==1){die(errMod(letheglobal_demo_mode_active,'danger'));}
	$errText = '';
	
	$data = array();
	
	if(!isset($_POST['newBR_rule']) || empty($_POST['newBR_rule'])){$errText.='* '.letheglobal_please_enter_a_pattern.'<br>';}else{$data["rule"]=trim($_POST['newBR_rule']);}
	if(!isset($_POST['newBR_cat']) || empty($_POST['newBR_cat'])){$errText.='* '.letheglobal_please_choose_a_category.'<br>';}else{$data["rule_cat"]=$_POST['newBR_cat'];}
	if(!isset($_POST['newBR_desc']) || empty($_POST['newBR_desc'])){$errText.='* '.letheglobal_please_enter_a_description.'<br>';}else{$data["desc"]=$_POST['newBR_desc'];}
	if(!isset($_POST['newBR_matc']) || empty($_POST['newBR_matc'])){$data["matc"]=0;}else{$data["matc"]=1;}
	
	# Check Exist Records
	if(isset($_POST['newBR_rule']) && !empty($_POST['newBR_rule'])){
		if(invalidRegex($_POST['newBR_rule'])!=''){
			$errText.= '* '. invalidRegex($_POST['newBR_rule']) .'<br>';
		}
		
		
		$db->where('rule=?',array(trim($_POST['newBR_rule'])))->getOne('bounce_rules');
		if($db->count>0){
			$errText.= '* '.letheglobal_pattern_already_exists.'<br>';
		}
	}
	
	if($errText==''){
		$newBC = $db->insert('bounce_rules',$data);
		if($newBC){
			$errText = errMod(''.letheglobal_rule_added_successfully.'!','success');
			$errText .= '<script>$("#newBR").find("textarea").val("");$("#newBR_rule").val("");getAjax("#bounceRuleList","act.xmlhttp.php?pos=bounceRuleLister","<span class=\'spin glyphicon glyphicon-repeat\'></span>");</script>';
			die($errText);
		}else{
			die(errMod(''.letheglobal_error_occured_while_creating_rule.'!','danger'));
		}
	}else{
		die(errMod($errText,'danger'));
	}
}

if($pos=='bounceRuleLister'){
	
	$BRID = 0;
	if(isset($_GET['BRID']) && is_numeric($_GET['BRID'])){$BRID=$_GET['BRID'];}
	
	if($BRID!=0){
		if(DEMO_MODE==0){
			$db->where("BRID=?",array($BRID))->delete("bounce_rules");
		}
	}
	
	$getBCs = $db->get('bounce_rules');
	$dt = '<div class="text-danger"><strong><span class="BRCount">'.$db->count.'</span> '.letheglobal_record.'</strong></div><hr>';
	foreach($getBCs as $getBC){
		$dt .= '<div class="well BRwells BR_all BR_'.$getBC['rule_cat'].'">';
		$dt.='<h4><strong>'.letheglobal_rule.':</strong> '.addZero($getBC['BRID'],4).' - <strong>Match:</strong> '. (($getBC['matc']) ? '<span class="text-success">ON</span>':'<span class="text-danger">OFF</span>') . ' <strong>'.letheglobal_category.': </strong> '. $LETHE_BOUNCE_TYPES[$getBC['rule_cat']]['name'] .'<a href="javascript:;" class="pull-right BR_rem" data-br-id="'.$getBC['BRID'].'">'.letheglobal_remove.'</a></h4><br>';
		if(DEMO_MODE==0){$dt.='<strong class="text-danger">'.showIn($getBC['rule'],'page').'</strong><br><br>';}else{
			$dt.='<strong class="text-danger">'.showIn('demo'.stringToAsterisks($getBC['rule']),'page').'</strong><br><br>';
		}
		$dt.="<pre>".showIn(createCodeDesc($getBC['desc']),'page')."</pre><br>";
		$dt.='</div>';
	}
	$dt.='<script>
										$(".BR_rem").click(function(){
										var BRID = $(this).data("br-id");
										getAjax("#bounceRuleList","act.xmlhttp.php?pos=bounceRuleLister&BRID="+BRID,"<span class=\"spin glyphicon glyphicon-repeat\"></span>");
									});
	</script>';
			echo($dt);
}

if($pos=='bounceRuleWriter'){
	if(DEMO_MODE==1){die(errMod(letheglobal_demo_mode_active,'danger'));}
	
$getBCs = $db->get('bounce_rules');
	
	$confList = '';
			$confList.= "<?php\n";
			$confList .= "/*  +------------------------------------------------------------------------+ */
/*  | Artlantis CMS Solutions                                                | */
/*  +------------------------------------------------------------------------+ */
/*  | Lethe Newsletter & Mailing System                                      | */
/*  | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       | */
/*  | Version       ". LETHE_VERSION ."                                                      | */
/*  | Last modified ". date('d.m.Y') ."                                               | */
/*  | Email         developer@artlantis.net                                  | */
/*  | Web           http://www.artlantis.net                                 | */
/*  +------------------------------------------------------------------------+ */

### LOADED: ".$db->count." RULE ###
##############################################################################################################
";

foreach($getBCs as $getBC){
	$confList.= createCodeDesc($getBC['desc']).PHP_EOL;
	$confList.= 'elseif(preg_match ("'.$getBC['rule'].'",$body,$match)){
$result["rule_cat"]    = "'.$getBC['rule_cat'].'";
$result["rule_no"]    = "'.addZero($getBC['BRID'],4).'";
$result["email"]    = '.$getBC['matc'].';
}
'.PHP_EOL;
}

$confList.= PHP_EOL ."?>";
	
			$pathw = LETHE.DIRECTORY_SEPARATOR.'lib/lethe.bounces.php';
			if (!file_exists ($pathw) ) {
				@touch ($pathw);
			}
			
			$conc=@fopen ($pathw,'w');
			if (!$conc) {
				die(errMod('Bounce File Cannot Be Opened','danger'));
			}else{
				#************* Writing *****
				if (fputs ($conc,$confList) ){
						fclose($conc);
						die(errMod('Bounce File Updated Successfully!','success'));
				}else {
					fclose($conc);
					die(errMod('Settings Could Not Be Written!','danger'));
				}
				fclose($conc);
				#************* Writing End **
			}
	
}

# End
//if(isset($myconn)){$myconn->close();unset($myconn);ob_end_flush();}
?>