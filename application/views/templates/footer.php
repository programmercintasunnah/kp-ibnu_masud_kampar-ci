<!-- js placed at the end of the document so the pages load faster -->
<script src="<?= base_url("assets/") ?>lib/jquery/jquery.min.js"></script>

<script src="<?= base_url("assets/") ?>lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?= base_url("assets/") ?>lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?= base_url("assets/") ?>lib/jquery.scrollTo.min.js"></script>
<script src="<?= base_url("assets/") ?>lib/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?= base_url("assets/") ?>lib/jquery.sparkline.js"></script>
<!--common script for all pages-->
<script type="text/javascript" src="<?= base_url('assets/') ?>js/plugins/sweetalert.min.js"></script>
<script src="<?= base_url("assets/") ?>lib/common-scripts.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/gritter-conf.js"></script>
<!--script for this page-->
<script src="<?= base_url("assets/") ?>lib/sparkline-chart.js"></script>
<script src="<?= base_url("assets/") ?>lib/zabuto_calendar.js"></script>

<!-- untuk datatable -->
<!-- js placed at the end of the document so the pages load faster -->
<script type="text/javascript" language="javascript" src="<?= base_url("assets/") ?>lib/advanced-datatable/js/jquery.js"></script>
<script class="include" type="text/javascript" src="<?= base_url("assets/") ?>lib/jquery.dcjqaccordion.2.7.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url("assets/") ?>lib/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/advanced-datatable/js/DT_bootstrap.js"></script>

<script src="<?= base_url("assets/") ?>lib/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?= base_url("assets/") ?>lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="<?= base_url("assets/") ?>lib/advanced-form-components.js"></script>

<script>
    $(document).ready(function() {
        $('table.display').DataTable();
    });
</script>

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?= base_url("assets/") ?>lib/raphael/raphael.min.js"></script>
<script src="<?= base_url("assets/") ?>lib/morris/morris.min.js"></script>

<!--script for this page-->
<script src="<?= base_url("assets/") ?>lib/morris-conf.js"></script>

<script type="text/javascript">
    /* Formating function for row details */
    // function fnFormatDetails(oTable, nTr) {
    //     var aData = oTable.fnGetData(nTr);
    //     var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    //     sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
    //     sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    //     sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    //     sOut += '</table>';

    //     return sOut;
    // }

    $(document).ready(function() {
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement('th');
        var nCloneTd = document.createElement('td');
        // nCloneTd.innerHTML = '<span class="fa fa-eye"></span>';
        // nCloneTd.className = "center";

        // $('#mytable thead tr').each(function() {
        //     this.insertBefore(nCloneTh, this.childNodes[0]);
        // });

        // $('#mytable tbody tr').each(function() {
        //     this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        // });

        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#mytable').dataTable({


            "aoColumnDefs": [{
                "bSortable": true,
                "aTargets": [0]
            }],
            "aaSorting": [
                [0, 'asc']
            ],
        });




        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        // $('#mytable tbody td img').live('click', function() {
        //     var nTr = $(this).parents('tr')[0];
        //     if (oTable.fnIsOpen(nTr)) {
        //         /* This row is already open - close it */
        //         this.src = "<?= base_url("assets/") ?>lib/advanced-datatable/media/images/details_open.png";
        //         oTable.fnClose(nTr);
        //     } else {
        //         /* Open this row */
        //         this.src = "<?= base_url("assets/") ?>lib/advanced-datatable/images/details_close.png";
        //         oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        //     }
        // });
    });
</script>

<script>
    $(function() {
        $('#nohpde').on('keydown', '#nohpden', function(e) {
            -1 !== $
                .inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/
                .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) ||
                35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
                (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    })
</script>

<script>
    $(function() {
        $('#nohp_e').on('keydown', '#nohp_ep', function(e) {
            -1 !== $
                .inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/
                .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) ||
                35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
                (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    })
</script>
<script>
    $(function() {
        $('#nohpku').on('keydown', '#nohp', function(e) {
            -1 !== $
                .inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/
                .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) ||
                35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
                (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    })
</script>

<script>
    $(function() {
        $('#nohpqu').on('keydown', '#nohpq', function(e) {
            -1 !== $
                .inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/
                .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) ||
                35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
                (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    })
</script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Dashio!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
            // (string | optional) the image to display on the left
            image: 'img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: 8000,
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
    });
</script> -->
<script type="application/javascript">
    $(document).ready(function() {
        $("#date-popover").popover({
            html: true,
            trigger: "manual"
        });
        $("#date-popover").hide();
        $("#date-popover").click(function(e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function() {
                return myDateFunction(this.id, false);
            },
            action_nav: function() {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [{
                    type: "text",
                    label: "Special event",
                    badge: "00"
                },
                {
                    type: "block",
                    label: "Regular event",
                }
            ]
        });
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    };

    $('.tombol-hapus').on('click', function(e) {
        e.preventDefault();

        const href = $(this).attr('href');

        swal({
            title: "Apakah anda yakin?",
            text: "Data akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus Data!",
            cancelButtonText: "Batal!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                document.location.href = href;
                swal("Terhapus!", "Data sudah terhapus", "success");
            } else {
                swal("Dibatalkan", "Data batal dihapus", "error");
            }
        });
    });
    $('.tombol-hapussemua').on('click', function(e) {
        e.preventDefault();

        const href = $(this).attr('href');

        swal({
            title: "Apakah anda yakin?",
            text: "Data akan dihapus secara keseluruan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus Seluruh Data!",
            cancelButtonText: "Batal!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                document.location.href = href;
                swal("Terhapus!", "Data sudah terhapus", "success");
            } else {
                swal("Dibatalkan", "Data batal dihapus", "error");
            }
        });
    });
    $('.tombol-hapus2').on('click', function(e) {
        e.preventDefault();

        const href = $(this).attr('href');

        swal({
            title: "Apakah anda yakin?",
            text: "Data Kelas & Semester akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus Data!",
            cancelButtonText: "Batal!",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                document.location.href = href;
                swal("Terhapus!", "Data kelas & semester sudah terhapus", "success");
            } else {
                swal("Dibatalkan", "Data kelas & semester batal dihapus", "error");
            }
        });
    });
    $('.editprofilpegawai').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('id_e');
        const nama = $(this).data('nama_e');
        const username = $(this).data('username_e');
        const jabatan = $(this).data('jabatan_e');
        const tl = $(this).data('tl_e');
        const tgl = $(this).data('tgl_lahir_e');
        const pend = $(this).data('pend_e');
        const alumni = $(this).data('alumni_e');
        const keahlian = $(this).data('keahlian_e');
        const nohp = $(this).data('nohp_e');
        const asal = $(this).data('asal_e');
        const alamat = $(this).data('alamat_e');
        const level = $(this).data('level_e');
        const tamatan = $(this).data('alumni_e');
        $('#id_ep').val(id);
        $('#nama_ep').val(nama);
        $('#jabatan_ep').val(jabatan);
        $('#username_ep').val(username);
        $('#tl_ep').val(tl);
        $('#tgl_ep').val(tgl);
        $('#nohp_ep').val(nohp);
        $('#level_ep').val(level);
        $('#pend_ep').val(pend);
        $('#asal_ep').val(asal);
        $('#alamat_ep').val(alamat);
        $('#tamatan_ep').val(tamatan);
        $('#keahlian_ep').val(keahlian);
    });
    $('.lihatprofilpegawai').on('click', function(event) {

        var modal = $(this)
        // const id = $(this).data('id_u');
        const nama = $(this).data('nama_u');
        const jabatan = $(this).data('jabatan_u');
        const tl = $(this).data('tl_u');
        const tgl = $(this).data('tgl_lahir_u');
        const pend = $(this).data('pend_u');
        const alumni = $(this).data('alumni_u');
        const keahlian = $(this).data('keahlian_u');
        const nohp = $(this).data('nohp_u');
        const asal = $(this).data('asal_u');
        const alamat = $(this).data('alamat_u');
        // $('#id_up').text(id);
        $('#nama_up').text(nama.toUpperCase());
        $('#jabatan_up').text(jabatan.toUpperCase());
        $('#ttl_up').text(tl.toUpperCase() + ", " + tgl);
        $('#pend_up').text(pend.toUpperCase());
        $('#alumni_up').text(alumni.toUpperCase());
        if (keahlian == "") {
            $('#keahlian_up').text("-");
        } else {
            $('#keahlian_up').text(keahlian.toUpperCase());
        }
        if (nohp == "") {
            $('#nohp_up').text("-");
        } else {
            $('#nohp_up').text(nohp.toUpperCase());
        }
        $('#asal_up').text(asal.toUpperCase());
        $('#alamat_up').text(alamat.toUpperCase());

        const foto = $(this).data('foto_u');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#foto_u').attr('src', fotoku);

    });
    $('.tombol_isikehadiran').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('ik_id');
        const nama = $(this).data('ik_nama');

        $('#ik_id').val(id);
        $('#ik_nama').val(nama.toUpperCase());

        const foto = $(this).data('ik_foto');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ik_foto').attr('src', fotoku);

    });

    $('.tombol_pulangcepat').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('id_p');
        const idk = $(this).data('fk_kehadiran_p');
        const nama = $(this).data('nama_p');

        $('#p_id').val(id);
        $('#p_nama').val(nama.toUpperCase());
        $('#p_idk').val(idk);

        const foto = $(this).data('foto_p');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#p_foto').attr('src', fotoku);

    });
    $('.tombol_editjabatan').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('id_j');
        const nama = $(this).data('nama_j');

        $('#id_ej').val(id);
        $('#jabatan_ej').val(nama);

    });
    $('.tombol_isijurnal').on('click', function(event) {
        $('#myModalLabel').html('Isi Jurnal');
        $('.modal-footer button[type=submit]').html('SIMPAN');
        var modal = $(this)
        const id = $(this).data('ij_id');
        const nama = $(this).data('ij_nama');
        const ket = $(this).data('ij_ket');
        document.getElementById("ij_ket").readOnly = false;

        $('#ij_id').val(id);
        $('#ij_nama').val(nama.toUpperCase());
        $('#ij_ket').val("");
        const acc = $(this).data('ij_acc');

        $('#ij_acc').val(acc);
        const foto = $(this).data('ij_foto');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ij_foto').attr('src', fotoku);

    });
    $('.tombol_accjurnal').on('click', function(event) {
        $('#myModalLabel').html('ACC Jurnal');
        $('.modal-footer button[type=submit]').html('ACC JURNAL');
        document.getElementById("ij_ket").readOnly = true;

        var modal = $(this)
        const id = $(this).data('ij_id');
        const nama = $(this).data('ij_nama');
        const ket = $(this).data('ij_ket');
        const acc = $(this).data('ij_acc');

        $('#ij_acc').val(acc);
        $('#ij_id').val(id);
        $('#ij_nama').val(nama.toUpperCase());
        $('#ij_ket').val(ket);

        const foto = $(this).data('ij_foto');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ij_foto').attr('src', fotoku);

    });
    $('.editpassword').on('click', function(event) {
        var modal = $(this)
        const id = $(this).data('id_ep');
        const nama = $(this).data('nama_ep');

        $('#ep_id').val(id);
        $('#ep_nama').val(nama.toUpperCase());

        const foto = $(this).data('foto_ep');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ep_foto').attr('src', fotoku);

    });
    $('.tombol_editkehadiran').on('click', function(event) {
        $('#myModalLabel').html('Edit Kehadiran');
        $('.modal-footer button[type=submit]').html('EDIT KEHADIRAN');
        var modal = $(this)
        const id = $(this).data('k_id');
        const nama = $(this).data('k_nama');
        const fk = $(this).data('k_fk');
        const absen = $(this).data('k_absen');
        const jamd = $(this).data('k_jamd');
        const ketd = $(this).data('k_ketd');
        // const jamp = $(this).data('k_jamp');
        // const ketp = $(this).data('k_ketp');

        $('#ek_id').val(id);
        $('#ek_fk').val(fk);
        $('#ek_nama').val(nama.toUpperCase());
        $('#ek_absen').val(absen);
        $('#ek_jamd').val(jamd);
        $('#ek_ketd').val(ketd);
        // $('#ek_jamp').val(jamp);
        // $('#ek_ketp').val(ketp);
        const foto = $(this).data('k_foto');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ek_foto').attr('src', fotoku);

    });
    $('.tombol_editjurnal').on('click', function(event) {
        $('#myModalLabel').html('Edit Jurnal');
        $('.modal-footer button[type=submit]').html('EDIT JURNAL');
        var modal = $(this)
        const id = $(this).data('e_id');
        const nama = $(this).data('e_nama');
        const ket = $(this).data('e_ket');
        const fk = $(this).data('e_fk');
        const mulaip = $(this).data('e_mulaip');
        const sampaip = $(this).data('e_sampaip');

        $('#ej_id').val(id);
        $('#ej_fk').val(fk);
        $('#ej_nama').val(nama.toUpperCase());
        $('#ej_ket').val(ket);
        $('#ej_mulaip').val(mulaip);
        $('#ej_sampaip').val(sampaip);
        const foto = $(this).data('e_foto');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ej_foto').attr('src', fotoku);

    });
    $('.tombol_editjurnal1').on('click', function(event) {
        $('#myModalLabel').html('Edit Jurnal');
        $('.modal-footer button[type=submit]').html('EDIT JURNAL');
        var modal = $(this)
        const id = $(this).data('e_id');
        const nama = $(this).data('e_nama');
        const ket = $(this).data('e_ket');
        const fk = $(this).data('e_fk');
        const mulaip = $(this).data('e_mulaip');
        const sampaip = $(this).data('e_sampaip');

        $('#ej_id1').val(id);
        $('#ej_fk1').val(fk);
        $('#ej_nama1').val(nama.toUpperCase());
        $('#ej_ket1').val(ket);
        $('#ej_mulaip1').val(mulaip);
        const foto = $(this).data('e_foto');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ej_foto1').attr('src', fotoku);

    });
    $('.tombol_acckembali').on('click', function(event) {
        $('#myModalLabel1').html('ACC Pegawai Telah Kembali Ke Pondok');
        $('.modal-footer button[type=submit]').html('ACC TELAH KEMBALI');
        document.getElementById("ij_ket1").readOnly = true;

        var modal = $(this)
        const id = $(this).data('ij_id');
        const fk = $(this).data('ij_fk');
        const nama = $(this).data('ij_nama');
        const ket = $(this).data('ij_ket');
        const acc = $(this).data('ij_acc');
        // const mulai = $(this).data('ij_mulaipukul');

        $('#ij_acc1').val(acc);
        $('#ij_fk1').val(fk);
        $('#ij_id1').val(id);
        $('#ij_nama1').val(nama.toUpperCase());
        $('#ij_ket1').val(ket);
        // $('#mulai_pukul1').val(mulai);

        const foto = $(this).data('ij_foto');
        const fotoku = '<?= base_url() ?>assets/img/profile/' + foto;
        const a = $('#ij_foto1').attr('src', fotoku);

    });
    $('.tombol_acckembaliku').on('click', function(event) {
        $('#myModalLabel1').html('Konfirmasi Telah Kembali Ke Pondok');
        $('.modal-footer button[type=submit]').html('ACC TELAH KEMBALI');
        document.getElementById("ij_ket1").readOnly = true;

        var modal = $(this)
        const id = $(this).data('ij_id');
        const ket = $(this).data('ij_ket');
        $('#ij_id1').val(id);
        $('#ij_ket1').val(ket);

    });
    $('.tombol_editjam').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('ej_id');
        const hari = $(this).data('ej_hari');
        const jamd = $(this).data('ej_jamd');
        const jamp = $(this).data('ej_jamp');

        $('#ej_id').val(id);
        $('#ej_hari').val(hari.toUpperCase());
        $('#ej_jamd').val(jamd);
        $('#ej_jamp').val(jamp);
    });
    $('.tombol_isijam').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('ij_id');
        const hari = $(this).data('ij_hari');

        $('#ij_id').val(id);
        $('#ij_hari').val(hari.toUpperCase());
    });
    $('.tombol_editusername').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('eu_id');
        const username = $(this).data('eu_username');
        $('#eu_id').val(id);
        $('#eu_username').val(username);
    });
    $('.tombol_editpassword').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('eu_id2');
        const password = $(this).data('eu_password');
        $('#eu_id2').val(id);
        // $('#eu_password').val(password);
    });
    $('.tombol_edit_pengumuman').on('click', function(event) {

        var modal = $(this)
        const id = $(this).data('idp');
        const isi = $(this).data('isip');
        const ke = $(this).data('ke');

        $('#idp').val(id);
        document.getElementById('isip').value = isi;
        $('#ke').val(ke);
    });
</script>
</body>

</html>