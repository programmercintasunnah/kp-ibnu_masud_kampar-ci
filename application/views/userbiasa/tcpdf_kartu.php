<?php
$pdf = new Pdfku('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('KARTU KU');
$pdf->SetTopMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();
$i = 0;

$html = '<table cellspacing="2" bgcolor="#666666" cellpadding="2">
            <tr bgcolor="#ffffff">
                <th align="center" colspan="4">KARTU PEGAWAI IBNU MAS"UD KAMPAR</th>
            </tr>';
$html .= '<table cellspacing="2" bgcolor="#666666" cellpadding="2">
            <tr bgcolor="#ffffff">
                 <th align="center" colspan="2"></th>
                <th align="center" colspan="2"></th>
            </tr>';
$html .= '<tr bgcolor="#ffffff">
            
                <td align="center" width="100" rowspan="3"><img src="assets/img/profile/' . $profile['foto'] . '"></td>
                <td align="center" width="100" rowspan="3"><img src="assets/img/qrcode/' . $profile['id_user'] . '.png"></td>
                <td align="">Nama Pegawai</td>
                <td> : ' . ucfirst($profile['nama_pegawai']) . '</td>
                </tr>';
$html .= '<tr bgcolor="#ffffff">
                <td align="">Jabatan</td>
                <td> : ' . ucfirst($profile['nama_jabatan']) . '</td>
                </tr>';
$html .= '<tr bgcolor="#ffffff">
                <td align="">Alamat</td>
                <td> : ' . ucfirst($profile['alamat']) . '</td>
                </tr>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('kartu_pegawai.pdf', 'I');
