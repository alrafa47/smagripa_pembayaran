<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">SMK PGRI PAKISAJI</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>

<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
<!-- page script Table -->
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function() {
        $('#example1').DataTable();
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
    // modal Pembayaran DPP
    $(document).ready(function() {
        $('#SiswaBelumLunas').change(function() {
            let nisn = $('#SiswaBelumLunas').find(':selected').val();
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>DataPembayaranDPP/detail_siswa/true',
                data: {
                    "nisn": nisn
                },
                success: function(data) {
                    var dataSiswa = JSON.parse(data);
                    console.log(dataSiswa);
                    $('#jurusan_kelas').val(dataSiswa.nama_jurusan);
                    $('#kelas').val(dataSiswa.kelas);
                    $('#jumlahAngsuran').val(dataSiswa.jumlah_angsuran);
                    $('#nominal').val(dataSiswa.nominal_dpp);
                    $('#nominalAngsuran').val(dataSiswa.nominal_dpp / dataSiswa.jumlah_angsuran);
                    var dataAngsuran = dataSiswa.angsuran;
                    var html = '<table class="table table-bordered">';
                    html += `
                        <tr>
                            <td colspan="` + dataSiswa.jumlah_angsuran + `">
                            Detail Angsuran
                            </td>
                        </tr>
                        `;
                    html += '<tr>';
                    for (let index = 1; index <= dataSiswa.jumlah_angsuran; index++) {
                        if (dataAngsuran != false) {
                            if (dataAngsuran.includes(index + "")) {
                                console.log('ketemu');
                                html += `
                                        <td> 
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked disabled>
                                                <label class="form-check-label" >
                                                Angsuran Ke-` + index + ` (lunas)
                                                </label>
                                            </div>
                                        </td>
                                        `;
                            } else {
                                html += `
                                        <td> 
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="angsuran[]" id='chkAngsuran' value="` + index + `" >
                                                <label class="form-check-label">
                                                Angsuran Ke-` + index + `
                                                </label>
                                            </div>
                                        </td>
                                        `;
                            }
                        } else {
                            html += `
                                        <td> 
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="angsuran[]" id='chkAngsuran' value="` + index + `" >
                                                <label class="form-check-label">
                                                Angsuran Ke-` + index + `
                                                </label>
                                            </div>
                                        </td>
                                        `;
                        }
                    }
                    html += '</tr>';
                    html += '</table>';
                    $('#DetailPembaryaran').html(html);
                    $('#btnSaveAngsuran').removeAttr('disabled');
                }
            })
        });
        // modal pembayaran SPP
        $('#bayarSPP').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var nisn = button.data('nisn')
            var modal = $(this)
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>DataPembayaranSPP/searchSiswa',
                data: {
                    'nisn': nisn
                },
                success: function(data) {
                    // alert(data);
                    var dataSiswa = JSON.parse(data);
                    console.log(dataSiswa);
                    modal.find('#dataNISN').text(dataSiswa.nisn)
                    modal.find('#NIS').val(dataSiswa.nisn)
                    modal.find('#dataNama').text(dataSiswa.nama_siswa)
                    modal.find('#dataJurusan').text(dataSiswa.kode_jurusan)
                    modal.find('#dataJenisSPP').text(dataSiswa.kategori)
                    modal.find('#dataNominalSPP').text('Rp. ' + dataSiswa.nominal_jenis)
                    modal.find('#jenisSpp').val(dataSiswa.kode_jenis)
                    modal.find('#nominalspp').val(dataSiswa.nominal_jenis)
                    modal.find('#selectKelas').html(dataSiswa.selectKelas)
                    modal.find('#dataDaftarTagihan').html(dataSiswa.list_tagihan)
                }
            })
        })
        // modal detail siswa
        $('#detailsiswa').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var nisn = button.data('nisn') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>DataSiswa/tampildata',
                data: {
                    'nisn': nisn
                },
                success: function(data) {
                    var dataSiswa = JSON.parse(data);
                    modal.find('#nisn').text(dataSiswa.nisn)
                    modal.find('#nama_siswa').text(dataSiswa.nama_siswa)
                    modal.find('#password').text(dataSiswa.password)
                    modal.find('#jk').text(dataSiswa.jk)
                    modal.find('#tempat_lahir').text(dataSiswa.tempat_lahir)
                    modal.find('#tgl_lahir').text(dataSiswa.tgl_lahir)
                    modal.find('#alamat').text(dataSiswa.alamat)
                    modal.find('#no_telfon').text(dataSiswa.no_telfon)
                    modal.find('#tahun_ajaran').text(dataSiswa.tahun_ajaran)
                    modal.find('#jurusan').text(dataSiswa.jurusan)
                    modal.find('#kelas_1').text(dataSiswa.kelas_1)
                    modal.find('#kelas_2').text(dataSiswa.kelas_2)
                    modal.find('#kelas_3').text(dataSiswa.kelas_3)
                    modal.find('#jenis_spp').text(dataSiswa.jenis_spp)
                    console.log(dataSiswa)
                }
            })
        })


        $('#selectjurusan').change(function() {
            let selected = $('#selectjurusan').find(':selected').val();
            $.ajax({
                type: 'post',
                url: "<?= base_url('DataDPPSiswa/cariKelas') ?>",
                data: {
                    'kode_jurusan': selected
                },
                success: function(data) {
                    var datakelas = JSON.parse(data);
                    $('#selectkelas').html(datakelas).show();
                }
            })

        });

        $('#kelasmendatang').change(function() {
            let selected = $('#kelasmendatang').find(':selected').val();
            if (selected == 'lulus') {
                $("input[type='checkbox']").attr('checked', 'checked');
            } else {
                let kelas = selected.split('_');
                $('.opt-' + kelas[0] + ' option[data-kelas=' + selected + ']').attr("selected", "selected");
            }
        });

        // modal detail DPP
        $('#detailDPP').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var nisn = button.data('nisn') // Extract info from data-* attributes
            var modal = $(this)

            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>DataDPPSiswa/tampildata',
                data: {
                    'nisn': nisn
                },
                success: function(data) {
                    var dataDPPSiswa = JSON.parse(data);
                    modal.find('#nisn').text(dataDPPSiswa.nisn)
                    modal.find('#nominal_dpp').text(dataDPPSiswa.nominal_dpp)
                    modal.find('#jumlah_angsuran').text(dataDPPSiswa.jumlah_angsuran)
                    modal.find('#nominal_angsuran').text(dataDPPSiswa.nominal_angsuran)
                    var status = "";
                    if (dataDPPSiswa.status == 0) {
                        status = "belum lunas"

                    } else {
                        status = "lunas"
                    }
                    modal.find('#status').text(status)
                    console.log(dataDPPSiswa)
                }
            })
        })
        <?php if ($this->uri->segment(1) == 'DataNaikKelas') { ?>
            $('').change(function() {

            });
        <?php } ?>
        <?php if ($this->uri->segment(1) == 'DataTahunAjaran') { ?>
            $('#ganti_konfigurasi').click(function() {
                $('#UTS').removeAttr('disabled');
                $('#UAS').removeAttr('disabled');
                $('#UNBK').removeAttr('disabled');
                $('#btn_save').removeAttr('disabled');
            });
        <?php } ?>

        <?php if ($this->uri->segment(1) == 'DataPembayaranUjian') { ?>

            $('#tahunAjaran').change(function() {
                var result = $('#tahunAjaran option:selected').data('kelas').split('_');
                var resultTahun = $('#tahunAjaran option:selected').data('tahun');
                var html = "";
                if (result[0] == 'XII') {
                    html = '<option value="">pilih Jenis Pembayaran</option><option value="UAS">UAS</option> <option value ="UTS">UTS</option><option value ="UNBK">UNBK</option>';
                } else {
                    html = '<option value="">pilih Jenis Pembayaran</option><option value="UAS">UAS</option> <option value = "UTS">UTS</option>';
                }
                $('#jenis_pembayaran').html(html);
                $('#jenis_pembayaran').removeAttr('disabled');
            });

            $('#jenis_pembayaran').change(function() {
                let dataNisn = "<?= $this->uri->segment(3) ?>";
                let ta = $('#tahunAjaran').val();
                let jenisPembayaran = $(this).val();
                if (jenisPembayaran != '-') {
                    if (ta != '-') {
                        $.ajax({
                            url: "<?= base_url('DataPembayaranUjian/JumlahPembayaran') ?>",
                            type: 'POST',
                            data: {
                                'nisn': dataNisn,
                                'pembayaran': jenisPembayaran,
                                'ta': ta
                            },
                            success: function(response) {
                                let data = JSON.parse(response);
                                $('#dataPembayaran').html(data.html);
                                let nominal = data.nominal;
                                if (jenisPembayaran == 'UNBK') {
                                    nominal = parseInt(data.nominal) / 12;
                                }
                                $('#nominal').val(nominal);
                                $('#id_pembayaran').val(data.id_pembayaran);
                            }
                        });
                    } else {
                        alert('pilih jenis pembayaran');
                        $(this).val('-')
                    }
                } else {
                    alert('pilih tahun ajaran');
                    $(this).val('-')
                }
            });

        <?php }  ?>

    });
</script>


</body>

</html>