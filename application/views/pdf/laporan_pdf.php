<!DOCTYPE html>
<html lang="en"><head>
      <title>Document</title>
</head><body>
    <table class="table display" id="" width="100%">
        <thead>
            <tr>

                <th>No</th>
                <th>Tanggal</th>
                <th>Kegiatan Keluar</th>
                <th>Mulai Pukul</th>
                <th>Sampai Pukul</th>
                <th>Lama Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($jurnalku as $u) : ?>
                <tr class="gradeX">
                    <td><?= $no++ ?></td>
                    <td><?= $u->tanggal_jurnal ?></td>
                    <td><?= ucwords($u->kegiatan_keluar) ?></td>
                    <td><?= ucwords($u->mulai_pukul) ?></td>
                    <td><?= ucwords($u->sampai_pukul) ?></td>

                    <td>
                        <?php if ($u->acc_jurnal == 1) : ?>
                            <?= ucwords($u->lama_keluar) ?> Menit
                        <?php else : ?>
                            <span class="badge">
                                <?php
                                $mulai_pukul = $u->mulai_pukul;
                                $time = new DateTime($mulai_pukul);
                                $now = new DateTime();

                                echo $time->diff($now)->format('%h jam %i menit');
                                ?>
                            </span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($u->acc_jurnal == 0) : ?>
                            <span class="badge bg-warning">Belum di acc</span>
                        <?php elseif ($u->acc_jurnal == 1) : ?>
                            <span class="badge bg-success">Selesai</span>
                        <?php elseif ($u->acc_jurnal == 2) : ?>
                            <?php if ($setting['status'] == 1) : ?>
                                <a data-ij_id="<?= $u->id_jurnal ?>" data-ij_ket="<?= $u->kegiatan_keluar ?>" data-toggle="modal" data-target="#modalJurnalSelesai" class="btn btn-warning btn-round tombol_acckembaliku"><i class="fa fa-pencil"></i> ACC TELAH KEMBALI</a>
                            <?php else : ?>
                                <span class="badge bg-primary">Belum kembali</span>
                            <?php endif ?>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            <?php if ($total_lamakeluar['lama_keluar'] != null) : ?>
                <tr class="gradeX">
                    <td>
                        <h5 class="bbold">Total Menit</h5>
                    </td>
                    <td>
                        <h5 class="bbold">
                            <?= $total_lamakeluar['lama_keluar'] ?> Menit
                        </h5>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>

</body></html>
