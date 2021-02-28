<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<style rel="stylesheet">
	body {color:black;font-size: 24px;}
</style>
</head>
<body>

<div id="printableArea" style="font-family: 'Times New Roman';width:310px">
      <div style="margin-left:22px;border:1px solid black;">
	  Print me asdasd 1234567890 1 2 3 4 567<br> 1234567890
	  </div>
</div>

<input type="button" onclick="printDiv('printableArea')" value="print a div!" />


<script>

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>
</html>