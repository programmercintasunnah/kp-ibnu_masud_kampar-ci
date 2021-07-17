<?php
$pdf = new Pdfku('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('JURNALKU');
$pdf->SetTopMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();
$i = 0;
$html = "<h3 style='text-align:center'>JURNAL PEGAWAI PONDOK PESANTREN SALAFIYAH IBNU MAS'UD KAMPAR</h3>";
$html .= '<h4 style="text-align:center">MULAI PUKUL 07:15 SAMPAI KEGIATAN SHALAT ASHAR</h4>
        <table cellspacing="2" bgcolor="#666666" cellpadding="2">
            <tr bgcolor="#ffffff">
                <th width="14%" align="center">TANGGAL</th>
                <th width="50%" align="center">KEGIATAN KELUAR</th>
                <th width="12%" align="center">MULAI PUKUL</th>
                <th width="12%" align="center">SAMPAI PUKUL</th>
                <th width="12%" align="center">LAMA KELUAR</th>
            </tr>';
foreach ($jurnalku as $row) {
    $html .= '<tr bgcolor="#ffffff">
            
                <td align="center">' . $row->tanggal_jurnal . '</td>
                <td>' . ucfirst($row->kegiatan_keluar) . '</td>
                <td align="center">' . $row->mulai_pukul . '</td>
                <td align="center">' . $row->sampai_pukul . '</td>
                <td align="center">' . $row->lama_keluar . ' Menit </td>
            </tr>';
}
$html .= '<tr bgcolor="#ffffff">
                <td colspan="4">Total</td>
                <td align="center">' . $total_lamakeluar['lama_keluar'] . ' Menit</td>
            </tr>';
$html .= '</table>';
$html .= '<table cellspacing="1" bgcolor="#666666" cellpadding="1">
            <tr bgcolor="#ffffff">
                <td width="50%" align="center"></td>
                <td width="50%" align="center"></td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="50%" align="center"></td>
                <td width="50%" align="center"></td>
            </tr>';
$html .= '<table cellspacing="1" bgcolor="#666666" cellpadding="1">
            <tr bgcolor="#ffffff">
                <td width="50%" align="left">Mengetahui,</td>
                <td width="50%" align="right">Kampar, ' . date('d-m-Y') . '</td>
            </tr>
            <tr bgcolor="#ffffff">
                <td width="50%" align="left">Pengawas Yayasan Nida As-Sunnah Kampar,</td>
                <td width="50%" align="right">Yang Mengisi,</td>
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
                <td width="50%" align="left">' . ucwords($pengawas_yayasan['nama_pegawai']) . '</td>
                <td width="50%" align="right">' . ucwords($profile['nama_pegawai']) . '</td>
            </tr>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('jurnalku.pdf', 'I');
