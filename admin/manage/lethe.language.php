<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.2                                                      |
# | Last modified 06.12.2015                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+

$mtd = ((isset($_GET['mtd']) && !empty($_GET['mtd'])) ? $_GET['mtd']:'');
$lngFld = dirname(dirname(__FILE__)).'/language/';

if(isset($_POST['updt_lngs'])){
if(!isDemo('updt_lngs')){$errText = errMod(letheglobal_demo_mode_active,'danger');}

	if(!isset($_POST['langdrc'])){
		$_POST['langdrc'] = array();
		$_POST['langkey'] = array();
	}
	$arrList = array_combine($_POST['langdrc'],$_POST['langkey']);
	$lfn = $_POST['lfnm'];
	
	# Check File Exist
	if(!file_exists($lngFld.$lfn)){
		$errText = errMod('* '.settings_file_not_found.'!<br>','danger');
	}
	
	if($errText==''){
		# Reorganize of Language Keys
		$slr = '';
		$slr .= '<?php 
		# User modified language file ('.date('d.m.Y H:i:s').')
		';
			foreach($arrList as $k=>$v){
				$slr .= '$SLNG["'.$k.'"] = \''.showIn($v,'sconf').'\';'.PHP_EOL;
			}
		$slr .= '?>';
		
		# Write Language File
		//echo('<pre>'.showIn($slr,'sconf').'</pre>');
		$connLangSet=@fopen ($lngFld.$lfn,'w');
		if(!fputs ($connLangSet,$slr)){$errText = errMod('* '.settings_error_occured_while_update_language_file.'!<br>','danger');}else{
			$errText = errMod('* '.settings_language_keys_updated_successfully.'!<br>','success');
		}
		fclose($connLangSet);
	}
}

if($mtd=='load'){
	/* Language Loader */
	
	$ldl = ((isset($_GET['ldl']) && !empty($_GET['ldl'])) ? $_GET['ldl']:'');
	$dlf = ((isset($_GET['dlf']) && !empty($_GET['dlf'])) ? $_GET['dlf']:'');
	$ldp = ((isset($_GET['ldp']) && !empty($_GET['ldp'])) ? $_GET['ldp']:'');
	$ldn = ((isset($_GET['ldn']) && !empty($_GET['ldn'])) ? $_GET['ldn']:'');
	
	# Check File
	$slf = $dlf.DIRECTORY_SEPARATOR.$ldl.'_'.$ldp.'.php';
	$lf = $lngFld.$slf;
	if(!file_exists($lf)){
		die('Language File Not Found!');
	}else{
		$SLNG = array();
		include_once($lf);
		ksort($SLNG);
	}
	
	$data = '';
	$data.='
		<h4><strong class="text-success">'.$ldn.' -> '. (($ldp=='front') ? 'Front-End':'Back-End') .' Translation ('. count($SLNG) .')</strong></h4><hr>
		<form method="POST" action="">
		<div style="max-height:900px; overflow:hidden; overflow-y:scroll;">';
		foreach($SLNG as $k=>$v){
		$data.='
			<div class="form-group">
				<label for="langkey" class="text-danger">'.$k.'</label>
				<input type="text" name="langkey[]" id="langkey" value="'.$v.'" placeholder="'.$v.'" class="form-control">
				<input type="hidden" name="langdrc[]" value="'.$k.'">
			</div>';
		}
	$data.=	'</div><input type="hidden" name="lfnm" value="'.$slf.'"><button id="updt_lngs" name="updt_lngs" class="btn btn-success">Update</button></form>';	
	die($data);
}
?>

<div class="col-md-12">
	<ul class="nav nav-pills">
	<?php 
	foreach($SLNG_LIST as $k=>$v){
		echo('<li><button class="btn btn-default lngchc" data-btn-lang-tag="'.$k.'" data-btn-lang-name="'.$v['sfolder'].'" style="margin-bottom:2px;"><span class="flag flag-'. $k .'"></span> '. showIn($v['sname'],'page') .'</button></li>');
	}?>
	</ul>
<hr></div>
<div class="col-md-4">
	<?php foreach($SLNG_CAT_LIST as $k=>$v){
		echo('<h5><strong class="text-danger">'.$v['name'].' <span class="lng-flgs"><span></span></span></strong></h5><hr>');
		echo('<div class="well"><a href="javascript:;" class="langLinks" data-lang-text="'.showIn($v['name'],'input').'" data-ldt-loc="'.$k.'" data-ldt-pos="front"  data-lang-f="english" id="'.$k.'">+ '.settings_front_end_translations.'</a><br><a href="javascript:;" class="langLinks" data-lang-text="'.showIn($v['name'],'input').'" data-ldt-loc="'.$k.'"  data-ldt-pos="back" data-lang-f="english" id="'.$k.'">+ '.settings_back_end_translations.'</a><br></div>');
	}?>
</div>
<div class="col-md-8">
	<?php echo($errText);?>
	<div id="lang-edit-area">

	</div>
</div>

<script>
	$(document).ready(function(){
		
		$(".langLinks").click(function(){
			getAjax('#lang-edit-area','manage/lethe.language.php?ldl='+$(this).data("ldt-loc")+'&ldn='+$(this).data("lang-text")+'&ldp='+$(this).data("ldt-pos")+'&dlf='+$(this).data("lang-f")+'&mtd=load','<span class="glyphicon glyphicon-repeat"></span>');
			$("html, body").animate({ scrollTop: 0 }, "slow");
		});
		
		$(".lngchc").click(function(){
			$('.lng-flgs span').removeClass();
			$('.lng-flgs span').addClass('lngchc');
			$('.lng-flgs span').addClass('flag');
			$('.lng-flgs span').addClass('flag-'+$(this).data('btn-lang-tag'));
			$('.langLinks').data('lang-f',$(this).data('btn-lang-name'));
			console.log($('.langLinks').data('lang-f'));
		});
		$('.lng-flgs span').addClass('flag flag-en');
	});
</script>