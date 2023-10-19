<?php

namespace App\Http\Controllers;

use App\Models\Spt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Style\Border;
use PhpOffice\PhpWord\Style\Table;

class WordController extends Controller
{
    public function index(Request $request, Spt $data)
    {
        $pegawaispts = Spt::with(['pegawaispt', 'penandatanganspt.pegawai'])->where('id', $data->id)->first();

        $template = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        $table = new \PhpOffice\PhpWord\Element\Table();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $fontStyle = array('name' => 'Times New Roman', 'size' => 12);
        $table = $section->addTable('Fancy Table');
        $noSpace = array('spaceAfter' => 50, 'spaceBefore' => 50);
        $no_urut = 1;
        foreach ($pegawaispts->pegawaispt as $pegawaispt) {
            $table->addRow();
            $table->addCell(500)->addText(htmlspecialchars($no_urut), $fontStyle, $noSpace);
            $table->addCell(3000)->addText(htmlspecialchars('Nama'), $fontStyle, $noSpace);
            $table->addCell(300)->addText(htmlspecialchars(':'), $fontStyle, $noSpace);
            if ($pegawaispt->pegawai->gelar_depan != null) {
                $table->addCell(5000)->addText(htmlspecialchars($pegawaispt->pegawai->gelar_depan . " " . strtoupper($pegawaispt->pegawai->nama) . " " . $pegawaispt->pegawai->gelar_belakang), $fontStyle, $noSpace);
            } else {

                $table->addCell(5000)->addText(htmlspecialchars(strtoupper($pegawaispt->pegawai->nama) . " " . $pegawaispt->pegawai->gelar_belakang), $fontStyle, $noSpace);
            }
            $table->addRow();
            $table->addCell()->addText(htmlspecialchars(""), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars("NIP"), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars(":"), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars($pegawaispt->pegawai->nip), $fontStyle, $noSpace);

            $table->addRow();
            $table->addCell()->addText(htmlspecialchars(""), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars("Pangkat/Golongan Ruang"), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars(":"), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars($pegawaispt->pegawai->pangkat . " (" . $pegawaispt->pegawai->gol . "/" . $pegawaispt->pegawai->ruang . ")"), $fontStyle, $noSpace);

            $table->addRow();
            $table->addCell()->addText(htmlspecialchars(""), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars("Jabatan"), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars(":"), $fontStyle, $noSpace);
            $table->addCell()->addText(htmlspecialchars($pegawaispt->pegawai->jabatan), $fontStyle, $noSpace);
            $no_urut++;
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord);
        $fullxml = $objWriter->getWriterPart('Document')->write($table);;
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);

        $template->setValue('table', $tablexml);

        if ($data->pulang == $data->berangkat) {
            $template->setValues([
                'kegiatan' => $data->judul . " pada tanggal " . Carbon::parse($data->berangkat)->isoFormat('D MMMM Y'),
            ]);
        } else {
            $template->setValues([
                'kegiatan' => $data->judul . " pada tanggal " . Carbon::parse($data->berangkat)->isoFormat('D MMMM Y') . " s.d. " . Carbon::parse($data->pulang)->isoFormat('D MMMM Y'),
            ]);
        }
        $template->setValues([
            'nomor' => $data->no_surat,
            'tgl_spt' => Carbon::parse($data->tgl)->isoFormat('D MMMM Y'),
        ]);

        if ($pegawaispts->penandatanganspt->jabatan == 'Kepala Dinas') {
            $template->setValues([
                'an' => '',
                'ttd_nama' => $pegawaispts->penandatanganspt->pegawai->gelar_depan . " " . strtoupper($pegawaispts->penandatanganspt->pegawai->nama . " " . $pegawaispts->penandatanganspt->pegawai->gelar_belakang),
                'ttd_pangkat' => $pegawaispts->penandatanganspt->pegawai->pangkat,
                'ttd_nip' => $pegawaispts->penandatanganspt->pegawai->nip,
                'ttd_jabatan' => ''
            ]);
        } else {
            $template->setValues([
                'an' => 'a.n. ',
                'ttd_nama' => $pegawaispts->penandatanganspt->pegawai->gelar_depan . " " . strtoupper($pegawaispts->penandatanganspt->pegawai->nama . " " . $pegawaispts->penandatanganspt->pegawai->gelar_belakang),
                'ttd_pangkat' => $pegawaispts->penandatanganspt->pegawai->pangkat,
                'ttd_nip' => $pegawaispts->penandatanganspt->pegawai->nip,
                'ttd_jabatan' => ucfirst(strtolower($pegawaispts->penandatanganspt->jabatan))
            ]);
        }

        $path = Storage::path('data/spt/hasil.docx');
        $template->saveAs($path);
        return response()->json(['download' => url('download')]);
    }
}
