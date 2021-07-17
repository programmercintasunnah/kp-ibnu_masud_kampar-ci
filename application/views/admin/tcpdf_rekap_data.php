<?php
$pdf = new Pdfku('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('REKAP DATA');
$pdf->AddPage('L');
$smstr = '';
$tp = date('Y');
$tp1 = '';
if (date('m') == 1 || date('m') == 2 || date('m') == 3 || date('m') == 4 || date('m') == 5 || date('m') == 6) {
    $smstr = 'GENAP';
    $tp1 = date('Y', strtotime('-1 year', strtotime(date('Y'))));
    $tpp = $tp1 . '/' . $tp;
} else {
    $smstr = 'GANJIL';
    $tp1 = date('Y', strtotime('+1 year', strtotime(date('Y'))));
    $tpp = $tp . '/' . $tp1;
}
if (date('m') == 1) {
    $bulanini = "JANUARI";
} elseif (date('m') == 2) {
    $bulanini = "FEBRUARI";
} elseif (date('m') == 3) {
    $bulanini = "MARET";
} elseif (date('m') == 4) {
    $bulanini = "APRIL";
} elseif (date('m') == 5) {
    $bulanini = "MEI";
} elseif (date('m') == 6) {
    $bulanini = "JUNI";
} elseif (date('m') == 7) {
    $bulanini = "JULI";
} elseif (date('m') == 8) {
    $bulanini = "AGUSTUS";
} elseif (date('m') == 9) {
    $bulanini = "SEPTEMBER";
} elseif (date('m') == 10) {
    $bulanini = "OKTOBER";
} elseif (date('m') == 11) {
    $bulanini = "NOVEMBER";
} elseif (date('m') == 12) {
    $bulanini = "DESAMBER";
}
$i = 0;
$html = '<h1 style="text-align:center">REKAP DATA KEHADIRAN PENDIDIK DAN TENAGA KEPENDIDIKAN</h1>';
$html .= '<h3 style="text-align:center">SEMESTER : ' . $smstr . ' TP.' . $tpp . '</h3>';
$html .= '<p style="font-weight:bold">BULAN : ' . $bulanini . ' ' . date('Y') . '</p>';
$html .= '<table cellspacing="2" bgcolor="#666666" cellpadding="2" weight="10px">
        <tr bgcolor="#ffffff">
            <th rowspan="2" width="5%" align="center">No</th>
            <th rowspan="2" width="35%" align="center">Nama</th>
            <th rowspan="2" width="30%" align="center">Jabatan</th>
            <th colspan="4" width="24%" align="center">KETIDAKHADIRAN</th>
            <th rowspan="2" width="7%" align="center">Ket</th>
        </tr>
        <tr bgcolor="#ffffff">
            <th width="6%" align="center">S</th>
            <th width="6%" align="center">I</th>
            <th width="6%" align="center">A</th>
            <th width="6%" align="center">JML</th>
     
        </tr>';
$no = 1;
foreach ($rekapdata_kehadiran as $u) {
    $html .= '<tr bgcolor="#ffffff">';
    $html .= '<td align="center">' . $no++ . '</td>
                <td>' . strtoupper($u->nama_pegawai) . '</td>
                <td>' . strtoupper($u->nama_jabatan) . '</td>
                <td align="center">' . $u->sakit . '</td>
                <td align="center">' . $u->cuti . '</td>
                <td align="center">' . $u->tanpaket . '</td>
                <td align="center">' . $u->jml . '</td>
                <td></td>
            </tr>';
}
$html .= '</table>';
$html .= '<table cellspacing="1" bgcolor="#666666" cellpadding="1">
            <tr bgcolor="#ffffff">
                <td width="50%" align="center"></td>
                <td width="50%" align="center"></td>
            </tr>';
$html .= '<table cellspacing="1" bgcolor="#666666" cellpadding="1">
            <tr bgcolor="#ffffff">
                <td width="50%" align="left">Ket : S = Sakit, I = Izin, A = Alpa</td>
                <td width="50%" align="center">Koto Perambahan, ' . date('d-m-Y') . '</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="50%" align="left"></td>
                <td width="50%" align="center">Kepala Pesantren</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="50%" align="center"></td>
                <td width="50%" align="center"></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="50%" align="center"></td>
                <td width="50%" align="center"></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="50%"></td>
                <td width="50%" align="center">' . ucwords($mudir['nama_pegawai']) . '</td>
            </tr>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Rekap_Data.pdf', 'I');
