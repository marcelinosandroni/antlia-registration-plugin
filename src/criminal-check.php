<?php 

function check_criminal_records($name, $mother_name, $father_name, $birth_date) {
    $url = 'https://h-apigateway.conectagov.estaleiro.serpro.gov.br/apiantecedentes-criminais/v1/certidao';
    $headers = array(
        'Content-Type' => 'text/xml',
        'SOAPAction' => 'http://www.dpf.gov.br/ns/CacWebService#consultaAntecedentesCriminais'
    );
    $xml_data = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:int="http://www.dpf.gov.br/ns/CacWebService">
                    <soapenv:Header/>
                    <soapenv:Body>
                        <int:consultaAntecedentesCriminais>
                            <nome>' . $name . '</nome>
                            <inicialMae>' . $mother_name[0] . '</inicialMae>
                            <inicialPai>' . $father_name[0] . '</inicialPai>
                            <dataNascimento>' . $birth_date . '</dataNascimento>
                        </int:consultaAntecedentesCriminais>
                    </soapenv:Body>
                </soapenv:Envelope>';
    $args = array(
        'body' => $xml_data,
        'headers' => $headers,
        'method' => 'POST'
    );

    $response = wp_remote_request($url, $args);
    $error_message = 'Não foi possível comunicar com o serviço para verificar os antecedentes criminais';

    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $xml = simplexml_load_string($body);
        $data = (string)$xml->xpath('//return')[0];
        if (! is_string($data) || strlen($data) < 5) {
            return $error_message;
        }
        return $data;
    } else {
        return $error_message;
    }
}

