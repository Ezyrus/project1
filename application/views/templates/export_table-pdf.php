<?php
require FCPATH . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML('<h1 style="text-align: center;">' . $title . '</h1>');

$html = '<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">';
$html .= '<thead style="background-color: #343a40; color: #ffffff;">';
$html .= '<tr>';
$html .= '<th style="padding: 8px; border: 1px solid #dddddd;">ID</th>';
$html .= '<th style="padding: 8px; border: 1px solid #dddddd;">Admin ID</th>';
$html .= '<th style="padding: 8px; border: 1px solid #dddddd;">Time In</th>';
$html .= '<th style="padding: 8px; border: 1px solid #dddddd;">Time Out</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

if ($adminDtr) {
    foreach ($adminDtr as $admin_dtr):
        $html .= '<tr>';
        $html .= '<td style="padding: 8px; border: 1px solid #dddddd;">' . $admin_dtr["id"] . '</td>';
        $html .= '<td style="padding: 8px; border: 1px solid #dddddd;">' . $admin_dtr["admin_id"] . '</td>';
        $html .= '<td style="padding: 8px; border: 1px solid #dddddd;">' . Main::formatDateTime($admin_dtr["time_in"]) . '</td>';
        $html .= '<td style="padding: 8px; border: 1px solid #dddddd;">' . Main::formatDateTime($admin_dtr["time_out"]) . '</td>';
        $html .= '</tr>';
    endforeach;
} else {
    // If $adminDtr is empty, show a message row
    $html .= '<tr><td colspan="4" style="padding: 8px; border: 1px solid #dddddd; text-align: center; color: red;">No Recorded DTR.</td></tr>';
}

$html .= '</tbody>';
$html .= '</table>';

$mpdf->WriteHTML($html);

$mpdf->SetFooter('<div style="text-align: center;">Generated at ' . Main::getCurrentDateTime() . '</div>');

$fileName = $fullname . '_' . Main::getCurrentDateTime();

$mpdf->Output($fileName, \Mpdf\Output\Destination::INLINE);



?>