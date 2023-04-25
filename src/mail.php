<?php

function render_candidate_basic_information($candidate)
{
    return "<table>";
}


function render_email_candidate_information_clt($candidate)
{
    $information = "<table>";
    $information .= "<thead><tr><th colspan='2'>Informações do candidato</th></tr></thead>";
    $information .= "<tbody>";
    $information .= "<tr><td>Nome:</td><td>" . $candidate['nome'] . "</td></tr>";
    $information .= "<tr><td>Endereço:</td><td>" .
        $candidate['rua'] . ", " .
        $candidate['numero'] . " - " .
        $candidate['complemento'] . ", " .
        "</td></tr>";
    $information .= "<tr><td>Bairro:</td><td>" . $candidate['bairro'] . "</td></tr>";
    $information .= "<tr><td>Cidade/UF:</td><td>" . $candidate['cidade'] . "/" . $candidate['uf_residencia'] . "</td></tr>";
    $information .= "<tr><td>CEP:</td><td>" . $candidate['cep'] . "</td></tr>";
    $information .= "<tr><td>Telefone:</td><td>" . $candidate['telefone'] . "</td></tr>";
    $information .= "<tr><td>Nascimento:</td><td>" . $candidate['nascimento'] . "</td></tr>";
    $information .= "<tr><td>email:</td><td>" . $candidate['email'] . "</td></tr>";
    $information .= "<tr><td>RG:</td><td>" . $candidate['rg'] . $candidate['local_emissao'] . $candidate['uf_rg'] . "</td></tr>";
    $information .= "<tr><td>CPF:</td><td>" . $candidate['cpf'] . "</td></tr>";
    $information .= "<tr><td>Pai:</td><td>" . $candidate['nome_pai'] . "</td></tr>";
    $information .= "<tr><td>Mãe:</td><td>" . $candidate['nome_mae'] . "</td></tr>";
    $information .= "<tr><td>Estado civil:</td><td>" . $candidate['estado_civil'] . "</td></tr>";
    $information .= "<tr><td>Tem filhos:</td><td>" . $candidate['filhos'] . "</td></tr>";
    $information .= "<tr><td>Quantos:</td><td>" . $candidate['quantos_filhos'] . "</td></tr>";
    $information .= "</tbody></table>";

    return $information;
}


function render_email_candidate_information_pj($candidate)
{
    return "<p><strong>Nome:</strong> $candidate->name</p>";
}


function render_email_candidate_information_coop($candidate)
{
    return "<p><strong>Nome:</strong> $candidate->name</p>";
}

function send_mail_with_file($candidate, $type, $file_path)
{
    $uppercase_type = strtoupper($type);
    $candidate_information = render_candidate_basic_information($candidate);
    if ($type == RegistrationType::CLT) {
        $candidate_information .= render_email_candidate_information_clt($candidate);
    } else if ($type == RegistrationType::PJ) {
        $candidate_information .= render_email_candidate_information_pj($candidate);
    } else if ($type == RegistrationType::COOP) {
        $candidate_information .= render_email_candidate_information_coop($candidate);
    } else {
        $candidate_information .= "<p><strong>Modalidade:</strong> Desconhecida</p>";
    }

    $to = 'marcelino.sandroni@gmail.com';
    $subject = 'Novo registro de candidato ' . strtoupper($type);
    $message = "<html><body>";
    $message .= "<p>O candidato <strong>" . $candidate['nome'] . "</strong> se registrou no site na modalidade <strong>$uppercase_type</strong></p>";
    $message .= "<p>Em anexo, a ficha de registro preenchida com os dados do candidato.<p>";
    $message .= "Abaixo seguem os dados do candidato:</p>";
    $message .= "<br>$candidate_information<br>";
    // $message .= "<p><strong>Nome:</strong>" . $candidate['nome'] . "</p>";
    $message .= "<br><br><p>Atenciosamente,</p>";
    $message .= "<p>Equipe Antlia</p>";
    $message .= "<br><br><p>Enviado automaticamente pelo sistema de registro de candidatos, favor não responder este e-mail</p>";
    $message .= "</body></html>";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $attachments = array($file_path);
    $mail_send = wp_mail($to, $subject, $message, $headers, $attachments);

    if ($mail_send) {
        $response = array(
            'status' => 'success',
            'message' => 'Email sent successfully',
        );
        return new WP_REST_Response($response, 200);
    } else {
        $mail_error = print_r(error_get_last(), true);

        $response = array(
            'status' => 'error',
            'message' => 'Error while sending the email',
            'error_details' => $mail_error,
        );
        return new WP_REST_Response($response, 500);
    }

}