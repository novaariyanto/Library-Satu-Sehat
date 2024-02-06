<?php

namespace kejarkoding\SatuSehat\Model;

class Consent
{
    public static function formData($ihsNumber,$petugas,$action)
    {
        return [
            'patient_id' => $ihsNumber,
            'action' => $action,
            'agent' => $petugas
        ];
    }
}