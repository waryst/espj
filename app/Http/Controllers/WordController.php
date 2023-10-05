<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\Style\Border;
use PhpOffice\PhpWord\Style\Table;

class WordController extends Controller
{
    public function index(Request $request)
    {
        $nama = $request->nama;



        // $my_template = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');

        // $table = new \PhpOffice\PhpWord\Element\Table();

        // $myFontStyle = array('name' => 'Minion Pro', 'size' => 10, 'bold' => true);
        // $myParagraphStyle = array('align' => 'center', 'spaceBefore' => 50, 'spaceafter' => 50);

        // $table->addRow();
        // $table->addCell()->addText('Cell 1', $myFontStyle, $myParagraphStyle);
        // $table->addCell()->addText('Cell 2', $myFontStyle, $myParagraphStyle);
        // $table->addCell()->addText('Cell 3', $myFontStyle, $myParagraphStyle);
        // $my_template->setComplexBlock('table', $table);
        // $my_template->saveAs('Hasil.docx');

        // $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        // $phpWord->setValues(['nama' => $nama]);
        // $phpWord->saveAs('Hasil.docx');

        $template = new \PhpOffice\PhpWord\TemplateProcessor('template.docx');
        $table = new \PhpOffice\PhpWord\Element\Table();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        // 1. Basic table
        // $section->addText(htmlspecialchars('Fancy table'), $header);

        // $styleTable = array('borderSize' => 3, 'borderColor' => '000000', 'spaceAfter' => 0, 'spaceBefore' => 0, 'spacing' => 0, 'cellMargin' => 0, 'lineHeight' => 2.0);
        // $styleCell = array('valign' => 'center', 'align' => 'center');
        $fontStyle = array('name' => 'Times New Roman', 'size' => 12);
        $table = $section->addTable('Fancy Table');
        $noSpace = array('spaceAfter' => 50, 'spaceBefore' => 50);
        for ($x = 1; $x <= 3; $x++) {
            $table->addRow();
            $table->addCell(500)->addText(htmlspecialchars("{$x}"), $fontStyle, $noSpace);
            $table->addCell(3000)->addText(htmlspecialchars('Nama'), $fontStyle, $noSpace);
            $table->addCell(300)->addText(htmlspecialchars(':'), $fontStyle, $noSpace);
            $table->addCell(4000)->addText(htmlspecialchars('Warist Amru Khoiruddin,S.ST'), $fontStyle, $noSpace);
            for ($i = 1; $i <= 4; $i++) {
                $table->addRow();
                if ($i == 1) {
                    $table->addCell()->addText(htmlspecialchars(""), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars("NIP"), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars(":"), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars("19860408 202012 1 003"), $fontStyle, $noSpace);
                }
                if ($i == 2) {
                    $table->addCell()->addText(htmlspecialchars(""), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars("Pangkat/Golongan Ruang"), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars(":"), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars("Pengatur (II/C"), $fontStyle, $noSpace);
                }
                if ($i == 3) {
                    $table->addCell()->addText(htmlspecialchars(""), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars("Jabatan"), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars(":"), $fontStyle, $noSpace);
                    $table->addCell()->addText(htmlspecialchars("Pranata Komputer Terampil"), $fontStyle, $noSpace);
                }
                if ($i == 4) {
                    $table->addCell()->addText(htmlspecialchars(""), $fontStyle, ['spaceAfter' => 0, 'spaceBefore' => 0]);
                    $table->addCell()->addText(htmlspecialchars(""), $fontStyle, ['spaceAfter' => 0, 'spaceBefore' => 0]);
                    $table->addCell()->addText(htmlspecialchars(""), $fontStyle, ['spaceAfter' => 0, 'spaceBefore' => 0]);
                    $table->addCell()->addText(htmlspecialchars(""), $fontStyle, ['spaceAfter' => 0, 'spaceBefore' => 0]);
                }
            }
        }





        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord);
        $fullxml = $objWriter->getWriterPart('Document')->write($table);;
        $tablexml = preg_replace('/^[\s\S]*(<w:tbl\b.*<\/w:tbl>).*/', '$1', $fullxml);

        $template->setValue('table', $tablexml);
        $template->setValues(['nama' => $nama]);
        $template->saveAs('Hasil.docx');
        // $phpWord->save('Hasil.docx');
    }
}
