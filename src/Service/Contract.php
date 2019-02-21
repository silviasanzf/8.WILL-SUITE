<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 25/01/19
 * Time: 11:51
 */

namespace App\Service;

use App\Entity\Artist;
use App\Entity\Project;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use DateTime;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\TranslatorInterface;

class Contract
{

    const DOC_FOLDER = __DIR__ . '/../../public/assets/documents/';

    private $translator;

    private $flashBag;

    public function __construct(TranslatorInterface $translator, FlashBagInterface $flashBag)
    {
        $this->translator = $translator;
        $this->flashBag = $flashBag;
    }

    public function generate(Artist $artist, Project $project): BinaryFileResponse
    {

        $date = new DateTime('now');
        $dateFormat = $date->format('d\-m\-Y');
        $dateArray = explode('-', $dateFormat);
        $currentDate = $dateArray[0] . $dateArray[1] . $dateArray[2];

        $contractDoc = strtolower($artist->getFirstname() . $artist->getBirthName()) . '-' . $currentDate;

        $document = new TemplateProcessor(self::DOC_FOLDER . 'contratAutomatique.docx');

        if ($birthDate = $artist->getBirthDate()) {
            $document->setValue('ARTIST_BIRTHDATE', date_format($birthDate, 'd\-m\-Y'));
        }
        if ($medicalDate = $artist->getLastMedicalVisit()) {
            $document->setValue('ARTIST_LAST_MEDICAL_VISIT', date_format($medicalDate, 'd\-m\-Y'));
        }
        if ($expiryDate = $artist->getExpiryDateResident()) {
            $document->setValue('ARTIST_EXPIRY_DATE_RESIDENT', date_format($expiryDate, 'd\-m\-Y'));
        }
        $document->setValue('ARTIST_FIRSTNAME', $artist->getFirstname());
        $document->setValue('ARTIST_BIRTHNAME', $artist->getBirthName());
        $document->setValue('ARTIST_BIRTH_CITY', $artist->getBirthCity());
        $document->setValue('ARTIST_BIRTH_DEPT', $artist->getBirthDept());
        $document->setValue('ARTIST_BIRTH_COUNTRY', $artist->getBirthCountry());
        $document->setValue('ARTIST_NATIONALITY', $artist->getNationality());
        $document->setValue('ARTIST_ADDRESS', $artist->getAddress());
        $document->setValue('ARTIST_CITY', $artist->getCity());
        $document->setValue('ARTIST_PHONE', $artist->getPhone());
        $document->setValue('ARTIST_SOCIAL_SECURITY_NO', $artist->getSocialSecurityNo());
        $document->setValue('ARTIST_SHOW_NO', $artist->getShowNo());
        $document->setValue('ARTIST_RESIDENT_PERMIS_NO', $artist->getResidentPermitNo());

        if ($artist->getResidentPermitNo()) {
            $expiryDateResident = $artist->getExpiryDateResident();
            if ($expiryDateResident) {
                $formatedExpiryDateResident = $expiryDateResident->format('d\/m\/Y');
            } else {
                $this->flashBag->add('danger', 'Aucune date de fin de titre de séjour renseigné');
                $formatedExpiryDateResident = '--/--/----';
            }

            $residentArtistInfos = $this->translator->trans(
                'RESIDENT_ARTIST_INFOS',
                [
                    '%ARTIST_RESIDENT_PERMIS_NO%' => $artist->getResidentPermitNo(),
                    '%ARTIST_EXPIRY_DATE_RESIDENT%' => $formatedExpiryDateResident
                ]
            );
            $document->setValue('RESIDENT_ARTIST_INFOS', $residentArtistInfos);
        } else {
            $document->setValue('RESIDENT_ARTIST_INFOS', '');
        }

        $document->setValue('PROJECT_TITLE', $project->getTitle());
        $document->setValue('PROJECT_SEGMENT_NUMBER', $project->getSegmentNumber());
        if ($company = $project->getProductionCompagny()) {
            $document->setValue('NOM_PROD', $company->getName());
            $document->setValue('SIRET_PROD', $company->getSiret());
            $document->setValue('ADRESS_PROD', $company->getAddress());
            $document->setValue('ZIPCODE_PROD', $company->getZipCode());
            $document->setValue('CITY_PROD', $company->getCity());
            $document->setValue('CEO_PROD', $company->getCeo());
        }

        // save as a random file in temp file
        $fileName = $contractDoc . '.docx';

        if ($temp_file = tempnam(sys_get_temp_dir(), $fileName)) {
            $document->saveAs($temp_file);
            // Send the temporal file as response (as an attachment)
            $response = new BinaryFileResponse($temp_file);
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $contractDoc . '.docx'
            );

            return $response;
        }
    }
}
