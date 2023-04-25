<?php 

use PhpOffice\PhpSpreadsheet\IOFactory;
function register_coop($candidate) {
    $excelFilePath = __DIR__ . '/files/registration-clt.xlsx';
    $spreadsheet = IOFactory::load($excelFilePath);
    $worksheet = $spreadsheet->getActiveSheet();
    // $worksheet->setCellValue('C7', $candidate['nome']);
    fill_excel_coop_information($candidate, $worksheet);
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $updatedFilePath = __DIR__ . '/files/updated-file.xlsx';
    $writer->save($updatedFilePath);
    return $updatedFilePath;
}

function fill_excel_coop_information($candidate, $worksheet) {
    $worksheet->setCellValue('C8', $candidate['nome']);
    $worksheet->setCellValue('C9', $candidate['rua']);
    $worksheet->setCellValue('P9', $candidate['numero']);
    $worksheet->setCellValue('T9', $candidate['complemento']);
    $worksheet->setCellValue('C10', $candidate['bairro']);
    $worksheet->setCellValue('K10', $candidate['cidade']);
    $worksheet->setCellValue('R10', $candidate['uf_residencia']);
    $worksheet->setCellValue('T10', $candidate['cep']);
    $worksheet->setCellValue('M11', $candidate['telefone']);
    $worksheet->setCellValue('C12', $candidate['nascimento']);
    // $worksheet->setCellValue('K11', $candidate['sexo']);
    // $worksheet->setCellValue('R12', $candidate['natural']);
    $worksheet->setCellValue('C13', $candidate['email']);
    $worksheet->setCellValue('C14', $candidate['rg']);
    $worksheet->setCellValue('L14', $candidate['local_emissao'] . ' - ' . $candidate['uf_rg']);
    // $worksheet->setCellValue('T14', $candidate['data_expedicao']);
    $worksheet->setCellValue('C15', $candidate['cpf']);
    // $worksheet->setCellValue('L15', $candidate['titulo_eleitor']);
    // $worksheet->setCellValue('R15', $candidate['zone']);
    // $worksheet->setCellValue('T15', $candidate['secao']);
    // $worksheet->setCellValue('E16', $candidate['emissao_titulo']);
    $worksheet->setCellValue('C23', $candidate['nome_pai']);
    $worksheet->setCellValue('C24', $candidate['nome_mae']);
    $worksheet->setCellValue('C25', $candidate['estado_civil']);
    $worksheet->setCellValue('C27', $candidate['filhos']);
    $worksheet->setCellValue('H27', $candidate['quantos_filhos']);

    // has no field in the excel file
    // $worksheet->setCellValue('C27', $candidate['fumante']);
    // $worksheet->setCellValue('H27', $candidate['foto_3x4']);

}