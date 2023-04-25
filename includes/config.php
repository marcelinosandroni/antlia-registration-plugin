<?php
# Plugin default configuration

# File location
define('CLT_REGISTRATION_FILE', 'clt-registration.xlsx');
define('PJ_REGISTRATION_FILE', 'pj-registration.xlsx');
define('COOP_REGISTRATION_FILE', 'coop-registration.xlsx');

# Mail options
define('MAIL_FROM', 'registration@antlia.com.br');
define('MAIL_FROM_NAME', 'Antlia Registration');
define('MAIL_SUBJECT', 'Cadastro Antlia');
define('MAIL_BODY', 'Segue em anexo o seu cadastro na Antlia');

# Define the mail recipients in a list
define('MAIL_RECIPIENTS', array(
    'leandro@antlia.com.br',
    'marcelino.dias@antlia.com.br'
));

class RegistrationType {
    const CLT = 'Pessoa Física';
    const PJ = 'Pessoa Jurídica';
    const COOP = 'Cooperativa';
}

class AntliaRegistrationConfig
{
    public static function getRegistrationFile($type)
    {
        switch ($type) {
            case RegistrationType::CLT:
                return CLT_REGISTRATION_FILE;
            case RegistrationType::PJ:
                return PJ_REGISTRATION_FILE;
            case RegistrationType::COOP:
                return COOP_REGISTRATION_FILE;
            default:
                return null;
        }
    }
}