<?php 
 /*  +------------------------------------------------------------------------+ */
/*  | Artlantis CMS Solutions                                                | */
/*  +------------------------------------------------------------------------+ */
/*  | Lethe Newsletter & Mailing System                                      | */
/*  | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       | */
/*  | Version       2.0                                                      | */
/*  | Last modified 12.03.2015                                               | */
/*  | Email         developer@artlantis.net                                  | */
/*  | Web           http://www.artlantis.net                                 | */
/*  +------------------------------------------------------------------------+ */

$rule_categories = $LETHE_BOUNCE_TYPES;

$bmh_newline = '<br>';

function bmhBodyRules($body,$structure='',$debug_mode=0){
	
  $result = array(
     'email'       => ''
    ,'bounce_type' => false
    ,'remove'      => 0
    ,'rule_cat'    => 'unrecognized'
    ,'rule_no'     => '0000'
  );
  
  if (false) {
  }
  
/* LOAD RULES START */
include_once('../lethe.bounces.php');
/* LOAD RULES END */

  global $rule_categories, $bmh_newline;
  if ($result['rule_no'] == '0000') {
    if ($debug_mode) {
      echo 'Body:' . $bmh_newline . $body . $bmh_newline;
      echo $bmh_newline;
    }
  } else {
    if ($result['bounce_type'] === false) {
      $result['bounce_type'] = $rule_categories[$result['rule_cat']]['bounce_type'];
      $result['remove']      = $rule_categories[$result['rule_cat']]['remove'];
    }
  }
  return $result;
	
}
?>