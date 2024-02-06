<?php

namespace kejarkoding\SatuSehat;

use kejarkoding\SatuSehat\Model as Model;
use kejarkoding\SatuSehat\JsonResult as JsonResult;
use kejarkoding\SatuSehat\Util\HttpRequest;
use kejarkoding\SatuSehat\Util\Security;
use kejarkoding\SatuSehat\Util\Url;

class Session

{
    public static function getPatientByNik($nik)
    {
        $url = Url::patientUrl($nik);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Patient::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function getPractitionerByNik($nik)
    {
        $url = Url::practitionerUrl($nik);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Practitioner::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function showOrganization()
    {
        $url = Url::showOrganizationUrl();
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Organization::show($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createOrganization($kode, $name)
    {
        $url = Url::createOrganizationUrl();
        $formData = Model\Organization::formCreateData($kode,$name);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Organization::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateOrganization($ihsNumber, $kode, $name)
    {
        $url = Url::updateOrganizationUrl($ihsNumber);
        $formData = Model\Organization::formUpdateData($ihsNumber,$kode,$name);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Organization::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function showLocation($ihsNumberOrganization)
    {
        $url = Url::showLocationUrl($ihsNumberOrganization);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Location::show($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createLocation($organization,$kode,$name)
    {
        $url = Url::createLocationUrl();
        $formData = Model\Location::formCreateData($organization,$kode,$name);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Location::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateLocation($ihsNumber,$organization,$kode,$name)
    {
        $url = Url::updateLocationUrl($ihsNumber);
        $formData = Model\Location::formUpdateData($ihsNumber,$organization,$kode,$name);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Location::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateConsent($ihsNumber,$petugas,$status)
    {
        $url = Url::updateConsentPatientUrl();
        $formData = Model\Consent::formData($ihsNumber,$petugas,$status);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Consent::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createEncounter($noRawat,$date,$time,$patient,$practitioner,$location)
    {
        $url = Url::createEncounterUrl();
        $formData = Model\Encounter::formCreateData($noRawat,$date,$time,$patient,$practitioner,$location);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Encounter::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateEncounter($encounter,$patient,$practitioner,$location)
    {
        $url = Url::updateEncounterUrl($encounter->ihs_number);
        $formData = Model\Encounter::formUpdateData($encounter,$patient,$practitioner,$location);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Encounter::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function cancelEncounter($encounter,$patient,$practitioner,$location)
    {
        $url = Url::updateEncounterUrl($encounter->ihs_number);
        $formData = Model\Encounter::formCancelData($encounter,$patient,$practitioner,$location);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Encounter::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateEncounterCondition($encounter,$dataDiagnosa)
    {
        $url = Url::updateEncounterUrl($encounter->ihs_number);
        $formData = Model\Encounter::formUpdateCondition($encounter,$dataDiagnosa);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Encounter::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyEncounter($ihsNumberPatient)
    {
        $url = Url::historyEncounterUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Encounter::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createCondition($encounter,$code,$name)
    {
        $url = Url::createConditionUrl();
        $formData = Model\Condition::formCreateData($encounter,$code,$name);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Condition::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateCondition($ihsNumber,$encounter,$code,$name)
    {
        $url = Url::updateConditionUrl($ihsNumber);
        $formData = Model\Condition::formUpdateData($ihsNumber,$encounter,$code,$name);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Condition::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyCondition($ihsNumberPatient)
    {
        $url = Url::historyConditionUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Condition::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createObservation($encounter,$practitioner,$name,$value)
    {
        $url = Url::createObservationUrl();
        $formData = Model\Observation::formCreateData($encounter,$practitioner,$name,$value);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Observation::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateObservation($ihsNumber,$encounter,$practitioner,$name,$value)
    {
        $url = Url::updateObservationUrl($ihsNumber);
        $formData = Model\Observation::formUpdateData($ihsNumber,$encounter,$practitioner,$name,$value);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Observation::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyObservation($ihsNumberPatient)
    {
        $url = Url::historyObservationUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Observation::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createComposition($encounter,$noRawat,$code,$name,$text)
    {
        $url = Url::createCompositionUrl();
        $formData = Model\Composition::formCreateData($encounter,$noRawat,$code,$name,$text);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Composition::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateComposition($ihsNumber,$encounter,$noRawat,$code,$name,$text)
    {
        $url = Url::updateCompositionUrl($ihsNumber);
        $formData = Model\Composition::formUpdateData($ihsNumber,$encounter,$noRawat,$code,$name,$text);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Composition::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyComposition($ihsNumberPatient)
    {
        $url = Url::historyCompositionUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Composition::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createProcedure($encounter, $procedureCode, $procedureName)
    {
        $url = Url::createProcedureUrl();
        $formData = Model\Procedure::formCreateData($encounter, $procedureCode, $procedureName);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Procedure::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateProcedure($ihsNumber, $encounter, $procedureCode, $procedureName)
    {
        $url = Url::updateProcedureUrl($ihsNumber);
        $formData = Model\Procedure::formUpdateData($ihsNumber, $encounter, $procedureCode, $procedureName);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Procedure::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyProcedure($ihsNumberPatient)
    {
        $url = Url::historyProcedureUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Procedure::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createMedication($noResep, $kodeObat, $namaObat)
    {
        $url = Url::createMedicationUrl();
        $formData = Model\Medication::formCreateData($noResep, $kodeObat, $namaObat);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Medication::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateMedication($ihsNumber,$noResep,$kodeObat,$namaObat)
    {
        $url = Url::updateMedicationUrl($ihsNumber);
        $formData = Model\Medication::formUpdateData($ihsNumber,$noResep,$kodeObat,$namaObat);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Medication::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createMedicationRequest($encounter,$medication,$noRawat,$aturanPakai)
    {
        $url = Url::createMedicationRequestUrl();
        $formData = Model\MedicationRequest::formCreateData($encounter, $medication, $noRawat, $aturanPakai);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\MedicationRequest::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateMedicationRequest($ihsNumber,$encounter,$medication,$noRawat,$aturanPakai)
    {
        $url = Url::updateMedicationRequestUrl($ihsNumber);
        $formData = Model\MedicationRequest::formUpdateData($ihsNumber, $encounter,$medication,$noRawat,$aturanPakai);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\MedicationRequest::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyMedicationRequest($ihsNumberPatient)
    {
        $url = Url::historyMedicationRequestUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\MedicationRequest::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createMedicationDispense($encounter,$practitoner,$noRawat,$medicationRequest)
    {
        $url = Url::createMedicationDispenseUrl();
        $formData = Model\MedicationDispense::formCreateData($encounter,$practitoner,$noRawat,$medicationRequest);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\MedicationDispense::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateMedicationDispense($ihsNumber,$encounter,$practitoner,$noRawat,$medicationRequest)
    {
        $url = Url::updateMedicationDispenseUrl($ihsNumber);
        $formData = Model\MedicationDispense::formUpdateData($ihsNumber,$encounter,$practitoner,$noRawat,$medicationRequest);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\MedicationDispense::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyMedicationDispense($ihsNumberPatient)
    {
        $url = Url::historyMedicationDispenseUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\MedicationDispense::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function createServiceRequest($noRawat,$encounter,$location,$performer)
    {
        $url = Url::createServiceRequestUrl();
        $formData = Model\ServiceRequest::formCreateData($noRawat,$encounter,$location,$performer);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\ServiceRequest::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function updateServiceRequest($ihsNumber,$noRawat,$encounter,$location,$performer)
    {
        $url = Url::updateServiceRequestUrl($ihsNumber);
        $formData = Model\ServiceRequest::formUpdateData($ihsNumber,$noRawat,$encounter,$location,$performer);
        $http = HttpRequest::put($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\ServiceRequest::convert($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyServiceRequest($ihsNumberPatient)
    {
        $url = Url::historyServiceRequestUrl($ihsNumberPatient);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\ServiceRequest::history($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function searchProductsByCode($code)
    {
        $url = Url::searchProductsByCode($code);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Kfa::convertByCode($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function searchProductsByType($type,$start = 1,$limit = 10)
    {
        $url = Url::searchProductsByType($type,$start,$limit);
        $http = HttpRequest::get($url);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Kfa::convertByType($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function KycGenerateUrl($nik,$name)
    {
        $url = Url::kycGenerateUrl();
        $keyPair = Security::generateKey();
        $formData = Model\Kyc::formDataGenerateUrl($keyPair,$nik,$name);
        $http = HttpRequest::postTextPlain($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Kyc::convertGenerateUrl($keyPair,$response);
        }
        return JsonResult\Error::http($http);
    }

    public static function KycChallengeCode($nik,$name)
    {
        $url = Url::kycChallengeCode();
        $formData = Model\Kyc::formDataChallengeCode($nik,$name);
        $http = HttpRequest::post($url,$formData);
        if ($http['status']) {
            $response = $http['response'];
            return JsonResult\Kyc::convertChallengeCode($response);
        }
        return JsonResult\Error::http($http);
    }

    public static function historyPatient($ihsNumber)
    {
        $dataHistory = [];
        $urls['encounter'] = Url::historyEncounterUrl($ihsNumber);
        $urls['condition'] = Url::historyConditionUrl($ihsNumber);
        $urls['observation'] = Url::historyObservationUrl($ihsNumber);
        $urls['composition'] = Url::historyCompositionUrl($ihsNumber);
        $urls['procedure'] = Url::historyProcedureUrl($ihsNumber);
        $urls['medicationRequest'] = Url::historyMedicationRequestUrl($ihsNumber);
        $urls['medicationDispense'] = Url::historyMedicationDispenseUrl($ihsNumber);
        $urls['serviceRequest'] = Url::historyServiceRequestUrl($ihsNumber);
        /////////////////////////////////////
        $gets = HttpRequest::poolGet($urls);
        ///////////////////////////////////
        $getEncounter = $gets['encounter'];
        if ($getEncounter['status']) {
            $dataHistory['encounter'] = JsonResult\Encounter::history($getEncounter['response']);
        }
        $getCondition = $gets['condition'];
        if ($getCondition['status']) {
            $dataHistory['condition'] = JsonResult\Condition::history($getCondition['response']);
        }
        $getObservation = $gets['observation'];
        if ($getObservation['status']) {
            $dataHistory['observation'] = JsonResult\Observation::history($getObservation['response']);
        }
        $getComposition = $gets['composition'];
        if ($getComposition['status']) {
            $dataHistory['composition'] = JsonResult\Composition::history($getComposition['response']);
        }
        $getProcedure = $gets['procedure'];
        if ($getProcedure['status']) {
            $dataHistory['procedure'] = JsonResult\Procedure::history($getProcedure['response']);
        }
        $getMedicationRequest = $gets['medicationRequest'];
        if ($getMedicationRequest['status']) {
            $dataHistory['medicationRequest'] = JsonResult\MedicationRequest::history($getMedicationRequest['response']);
        }
        $getMedicationDispense = $gets['medicationDispense'];
        if ($getMedicationDispense['status']) {
            $dataHistory['medicationDispense'] = JsonResult\MedicationDispense::history($getMedicationDispense['response']);
        }
        $getServiceRequest = $gets['serviceRequest'];
        if ($getServiceRequest['status']) {
            $dataHistory['serviceRequest'] = JsonResult\ServiceRequest::history($getServiceRequest['response']);
        }
        /////////////////////
        return $dataHistory;
    }
}
