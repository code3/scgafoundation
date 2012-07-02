<?php
/*02/13/08*/
/*
Copyright © 2008 Eckx Media Group, LLC. All rights reserved.
Eckx Media Group respects the intellectual property of others, and we ask others to do the same.
*/
 class pageLinks{ var $V34a6a74a; var $Vb6e2ff17; var $V7448f47a; var $V572d4e42; var $Vcfa17b45; 
var $Vf8558a69; var $limit; var $Va85169af = 2; var $Vc81cfc0d = 10; var $Vd2fc7147;// = 13; var $V7db164e2;
var $Vc184c330; var $V86b26300; var $V3cd51241; var $Vac026f6d; var $V198bf000; var $offset; function pageLinks($Vb6e2ff17, $V7448f47a){
 if(isset($_GET['pgl_numPerPage'])){ $Vb6e2ff17 = $_GET['pgl_numPerPage']; } if(!is_numeric($Vb6e2ff17) || !is_numeric($V7448f47a)){
 die('pageLinks class error: $Vb6e2ff17, $V7448f47a are not numeric'); } elseif($Vb6e2ff17 > $V7448f47a){
 $Vb6e2ff17 = $V7448f47a; } $this->Vb6e2ff17= $Vb6e2ff17; $this->V7448f47a= $V7448f47a; if($this->Vb6e2ff17== 0){
 $this->Vcfa17b45= 0; } else{ $this->Vcfa17b45= ceil($this->V7448f47a/ $this->Vb6e2ff17); } $this->Vf8558a69= $_GET['pgl_page'];
if(!is_numeric($this->Vf8558a69)){ $this->Vf8558a69= 1; } elseif($this->Vf8558a69> $this->V7448f47a|| $this->Vf8558a69<= 0){
 $this->Vf8558a69= 1; } $this->V34a6a74a= ($this->Vf8558a69-1 ) * $this->Vb6e2ff17; $this->offset = $this->V34a6a74a; $this->limit = $this->V34a6a74a.', '.$this->Vb6e2ff17;

 $Vc265d974 = explode('?', $_SERVER['REQUEST_URI']); $this->V572d4e42= $Vc265d974[0].'?';
 $V6c826ad8 = array('pgl_page', 'pgl_numPerPage', 'p');
if(is_array($_GET)){ foreach($_GET as $V3c6e0b8a=>$V2063c160){ if(in_array($V3c6e0b8a, $V6c826ad8)){
 continue; } else{ $V3c6e0b8a = urlencode($V3c6e0b8a); $V2063c160 = urlencode($V2063c160); $this->V572d4e42.='&'.$V3c6e0b8a.'='.$V2063c160;
} } } 
 $this->V7db164e2= floor($this->Vc81cfc0d/ 2) + $this->Va85169af+ 2; $this->Vc184c330= ($this->Vcfa17b45- (ceil($this->Vc81cfc0d/ 2) + $this->Va85169af+ 2)) + 2;
$this->Vd2fc7147= ($this->Vc81cfc0d+ $this->V879333c3) + 1; $this->V86b26300= $this->Vf8558a69- floor($this->Vc81cfc0d/ 2);
$this->V3cd51241= $this->V86b26300+ $this->Vc81cfc0d- 1; $this->Vac026f6d= ($this->Vcfa17b45- $this->Vc81cfc0d) + 1;
$this->V198bf000= ($this->Vcfa17b45- $this->Va85169af) + 1; } function showLink($Vea2b2676, $V7f021a14) {
 for ($V865c0c0b = $Vea2b2676; $V865c0c0b <= $V7f021a14; $V865c0c0b++) { ?> <a href="<?= $this->V572d4e42?>&pgl_page=<?= $V865c0c0b ?>&pgl_numPerPage=<?= $this->Vb6e2ff17?>" class="pgl<? if ($V865c0c0b == $this->Vf8558a69) { ?> curPage <? } ?>"><?= $V865c0c0b ?></a>
 <? } } function showEllipsis() { ?> <span class="ellipsis">...</span> <? } function show(){
 
 ?><div id="pageLinks"><? if($this->Vf8558a69!=1){ ?><a href="<?= $this->V572d4e42?>&pgl_page=<?= ($this->Vf8558a69-1) ?>&pgl_numPerPage=<?= $this->Vb6e2ff17?>" class="pgl prevnext">Prev</a><?
 } if ($this->Vcfa17b45< $this->Vd2fc7147) { $this->showLink(1, $this->Vcfa17b45); } else { if ($this->Vf8558a69< $this->V7db164e2|| $this->Vf8558a69> $this->Vc184c330) {
 if ($this->Vf8558a69< $this->V7db164e2) { $this->showLink(1, $this->Vc81cfc0d); $this->showEllipsis();
$this->showLink($this->V198bf000, $this->Vcfa17b45); } elseif ($this->Vf8558a69> $this->Vc184c330) {
 $this->showLink(1, $this->Va85169af); $this->showEllipsis(); $this->showLink($this->Vac026f6d, $this->Vcfa17b45);
} } else { $this->showLink(1, $this->Va85169af); $this->showEllipsis(); $this->showLink($this->V86b26300, $this->V3cd51241);
$this->showEllipsis(); $this->showLink($this->V198bf000, $this->Vcfa17b45); } } if($this->Vf8558a69< $this->Vcfa17b45){
 ?><a href="<?= $this->V572d4e42?>&pgl_page=<?= ($this->Vf8558a69+1) ?>&pgl_numPerPage=<?= $this->Vb6e2ff17?>" class="pgl prevnext">Next</a><?
 } ?> <script type="text/javascript"> <!--
 function pgl_form(){
 var theValue = document.getElementById('pgl_numPerPage').value;
if(theValue != parseFloat(theValue)){ alert('Please enter a number.'); document.getElementById('pgl_numPerPage').focus();
} else{ if(theValue<=0){ alert('Please enter a number greater than 0.'); document.getElementById('pgl_numPerPage').focus();
} else{ window.location = "<?= $this->V572d4e42; ?>&pgl_page=1&pgl_numPerPage="+document.getElementById('pgl_numPerPage').value;
} } }
 //--> </script> <div id="resultsPerPage"> <span># Results/Page:&nbsp;</span> <input id="pgl_numPerPage" class="pgl_numPerPage" type="text" value="<?= $this->Vb6e2ff17?>" />
 <input id="pgl_url" class="pgl_url" type="hidden" value="<?= $this->V572d4e42; ?>" /> <button onclick="pgl_form();" id="pgl_numPerPageGo" class="pgl_numPerPageGo">Go</button>
 </div> <div id="results" style="clear: both;"> <? $Vcd6f350d = (($this->Vf8558a69- 1) * $this->Vb6e2ff17) + 1;
$Vdbbe4941 = $this->Vf8558a69* $this->Vb6e2ff17; if ($Vdbbe4941 > $this->V7448f47a) { $Vdbbe4941 = $this->V7448f47a;
} ?> Showing results <?= $Vcd6f350d ?> - <?= $Vdbbe4941 ?> of <?= $this->V7448f47a?>. </div> <br />
 </div><? } } ?>