<?php

namespace kejarkoding\SatuSehat\JsonResult;

class Patient
{
    public static function convert($response): array
    {
        if (!Error::searchIsEmpty($response)) {
            $data = json_decode($response,true);
            $entry = $data['entry'] ?? false;
            if ($entry) {
                $resource = $entry[0]['resource'];
                $resType = $resource['resourceType'];
                if ($resType == 'Patient') {
                    return [
                        'status' => true,
                        'data' => [
                            'nik' => $resource['identifier'][1]['value'],
                            'ihs_number' => $resource['id'],
                            'name' => $resource['name'][0]['text']
                        ]
                    ];
                }
                return Error::checkOperationOutcome($resType,$data);
            }
            return [
                'status' => false,
                'message' => $response
            ];
        }
        return [
            'status' => false,
            'message' => 'Data tidak ditemukan!'
        ];
    }
}
