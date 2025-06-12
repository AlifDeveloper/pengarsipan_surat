<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lembar Disposisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }
        .logo {
            position: absolute;
            left: 20px;
            top: 0;
            width: 70px;
        }
        .header-text {
            font-weight: bold;
            line-height: 1.5;
        }
        .title {
            text-align: center;
            font-weight: bold;
            border: 1px solid black;
            padding: 5px;
            /* margin-bottom: 15px; */
            letter-spacing: 5px;
        }
        .content {
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 8px;
            vertical-align: top;
        }
        .no-top-border {
            border-top: none;
        }
        .checkbox {
            width: 12px;
            height: 12px;
            border: 1px solid black;
            display: inline-block;
            margin-right: 5px;
            font-weight: bold;
            font-size: 16pt;
        }
        .checked {
            background-color: black;
        }
        .checkbox-label {
            display: block;
            margin-bottom: 5px;
        }
        .signature {
            text-align: right;
            padding-top: 10px;
        }
        .notes {
            margin-top: 5px;
        }
        .dotted-line {
            border-bottom: 1px dotted black;
            height: 20px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-text">
            KABUPATEN GUNUNGKIDUL<br>
            KAPANEWON WONOSARI<br>
            <strong>PEMERINTAH KALURAHAN KARANGREJEK</strong><br>
            Jalan Baron Km.02 Karangrejek Wonosari Kode Pos 55851 Telepon/Fax: 0274 391148
        </div>
    </div>

    <div class="title">L E M B A R &nbsp; D I S P O S I S I</div>

    <div class="content">
        <table>
            <tr>
                <td width="50%">
                    Surat dari : <?php echo e($disposisi->petugas->jabatan ?? '-'); ?>

                    <br><br>
                    No. Surat : <?php echo e($disposisi->no_suratmasuk ?? '-'); ?>

                    <br><br>
                    Tgl. Surat : <?php echo e($disposisi->surat_masuk->tgl_surat ?? '-'); ?>

                </td>
                <td width="50%">
                    Diterima Tgl : <?php echo e($disposisi->tgl_diterima ?? '-'); ?>

                    <br><br>
                    No. Agenda : <?php echo e($noAgenda ?? '-'); ?>

                    <br><br>
                    Sifat : <span><?php echo e($disposisi->sifat_arsip->nama_sifat); ?></span> <br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Perihal : <?php echo e($disposisi->perihal ?? '-'); ?>

                </td>
            </tr>
            <tr>
                <td>
                    Diteruskan kepada Sdr. :
                    <br><br>
                    <div class="checkbox-label">
                        <span class=""><?php echo e($disposisi->tujuan_surat); ?></span>
                    </div>
                </td>
                <td>
                    Dengan hormat harap :
                    <br><br>
                    <div class="checkbox-label">
                        <span class="checkbox"><?php echo e(isset($harapan) && in_array('Tanggapan dan Saran', $harapan) ? '✓' : ''); ?></span> Tanggapan dan Saran
                    </div>
                    <div class="checkbox-label">
                        <span class="checkbox"><?php echo e(isset($harapan) && in_array('Proses lebih lanjut', $harapan) ? '✓' : ''); ?></span> Proses lebih lanjut
                    </div>
                    <div class="checkbox-label">
                        <span class="checkbox"><?php echo e(isset($harapan) && in_array('Koordinasi/konfirmasikan', $harapan) ? '✓' : ''); ?></span> Koordinasi/konfirmasikan
                    </div>
                    <div class="dotted-line"></div>
                    <div class="dotted-line"></div>
                    <div class="dotted-line"></div>
                    <div class="dotted-line"></div>
                    <div class="dotted-line"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="no-top-border">
                    <div class="notes">
                        <div class="dotted-line">Catatan :</div>
                    </div>
                    <div class="signature">
                        Kaur Tata Laksana
                        <br><br><br><br>
                        ____________________
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php /**PATH D:\0. joki\Refa\Revisi\pengarsipan_surat\resources\views\content\pengarsipan\disposisi\cetakDisposisi.blade.php ENDPATH**/ ?>