<?php
#----------------------------
# Excel Functions
#----------------------------
# save these functions into a file, i.e. "_excel.php"
#
# The basic steps to create Excel streams from PHP are
# 1. Call xlsBOF()
# 2. Write contents into cells by either using xlsWriteNumber(), or
#    xlsWriteLabel()
# 3. Call xlsEOF()
#
# "echo" functions can be also replaced by "fwrite" functions to write
# directly to the webserver instead of parsing the contents to the
# browser.
// ----- begin of function library -----
// Excel begin of file header
function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); 
    return;
}
// Excel end of file footer
function xlsEOF() {
    echo pack("sssssssC", 0x7D, 11, 1, 1, 12800,0,0,0);
    echo pack("ss", 0x0A, 0x00);
    return;
}
// Function to write a Number (double) into Row, Col
function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
}
// Function to write a label (text) into Row, Col
function xlsWriteLabel($Row, $Col, $Value ) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
return;
}
// ----- end of function library -----

//
// To display the contents directly in a MIME compatible browser
// add the following lines on TOP of your PHP file:
/* header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ('Content-type: application/x-msexcel');
header ("Content-Disposition: attachment; filename=EmplList.xls" );
header ("Content-Description: PHP/INTERBASE Generated Data" );
//
// the next lines demonstrate the generation of the Excel stream
//
xlsBOF();   // begin Excel stream
xlsWriteLabel(0,0,"This is a label");  // write a label in A1, use for dates too
xlsWriteNumber(0,1,9999);  // write a number B1
xlsEOF(); // close the stream */
?>