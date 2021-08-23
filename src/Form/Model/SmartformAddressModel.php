<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\Form\Model;

use DobryProgramator\SmartformBundle\Entity\SmartformAddressInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class SmartformAddressModel
{
    public string $address;

    /**
     * @Assert\NotBlank(message="Kód z RÚIAN databáze je povinný")
     * @Assert\Length(max="255", maxMessage="Kód z RÚIAN databáze může mít maximálně {{ limit }} znaků")
     */
    public string $code;

    /**
     * @Assert\NotBlank(message="Zeměpisná šířka je povinná")
     * @Assert\Length(max="255", maxMessage="Zeměpisná šířka může mít maximálně {{ limit }} znaků")
     */
    public string $latitude;

    /**
     * @Assert\NotBlank(message="Zeměpisná délka je povinná")
     * @Assert\Length(max="255", maxMessage="Zeměpisná délka může mít maximálně {{ limit }} znaků")
     */
    public string $longitude;

    /**
     * @Assert\Expression("this.street or this.cityPart", message="Ulice je povinná")
     * @Assert\Length(max="255", maxMessage="Ulice může mít maximálně {{ limit }} znaků")
     */
    public ?string $street = null;

    /**
     * Important because Smartform sometimes puts street in the city_part attribute
     *
     * @Assert\Length(max="255", maxMessage="Ulice může mít maximálně {{ limit }} znaků")
     */
    public string $cityPart;

    /**
     * @Assert\Expression("this.houseNumber or this.evidenceNumber", message="Číslo popisné nebo evidenční je povinné")
     * @Assert\Length(max="255", maxMessage="Číslo popisné může mít maximálně {{ limit }} znaků")
     */
    public ?string $houseNumber = null;

    /**
     * @Assert\Length(max="255", maxMessage="Číslo orientační může mít maximálně {{ limit }} znaků")
     */
    public ?string $orientationNumber = null;

    /**
     * @Assert\Length(max="255", maxMessage="Číslo evidenční může mít maximálně {{ limit }} znaků")
     */
    public ?string $evidenceNumber = null;

    /**
     * @Assert\NotBlank(message="Město je povinné")
     * @Assert\Length(max="255", maxMessage="Město může mít maximálně {{ limit }} znaků")
     */
    public string $city;

    /**
     * @Assert\NotBlank(message="PSČ je povinné")
     * @Assert\Regex("/^(\d{3})\s*(\d{2})$/", message="PSČ není ve správném formátu (např. 110 00)")
     */
    public string $zipCode;

    /**
     * @Assert\NotBlank(message="Okres je povinný")
     * @Assert\Length(max="255", maxMessage="Okres může mít maximálně {{ limit }} znaků")
     */
    public string $district;

    /**
     * @Assert\NotBlank(message="Kraj je povinný")
     * @Assert\Length(max="255", maxMessage="Kraj může mít maximálně {{ limit }} znaků")
     */
    public string $region;

    /**
     * @Assert\NotBlank(message="Země je povinná")
     * @Assert\Length(max="255", maxMessage="Země může mít maximálně {{ limit }} znaků")
     */
    public string $country;

    public static function createEmpty(): self
    {
        return new self();
    }

    public static function createFromEntity(SmartformAddressInterface $entity): self
    {
        $model = self::createEmpty();

        $model->address = $entity->__toString();
        $model->code = $entity->getCode();
        $model->latitude = $entity->getLatitude();
        $model->longitude = $entity->getLongitude();
        $model->street = $entity->getStreet();
        $model->houseNumber = $entity->getHouseNumber();
        $model->orientationNumber = $entity->getOrientationNumber();
        $model->evidenceNumber = $entity->getEvidenceNumber();
        $model->district = $entity->getDistrict();
        $model->city = $entity->getCity();
        $model->zipCode = $entity->getZipCode();
        $model->region = $entity->getRegion();
        $model->country = $entity->getCountry();

        return $model;
    }

    /**
     * Create from array you get by submitting the form
     *
     * @param array<string, string> $data
     */
    public static function createFromArray(array $data): self
    {
        $smartformAddressModel = new self();

        $smartformAddressModel->code = $data['code'];
        $smartformAddressModel->latitude = $data['latitude'];
        $smartformAddressModel->longitude = $data['longitude'];
        $smartformAddressModel->street = $data['street'];
        $smartformAddressModel->cityPart = $data['city_part'];
        $smartformAddressModel->houseNumber = $data['house_number'];
        $smartformAddressModel->orientationNumber = $data['orientation_number'];
        $smartformAddressModel->evidenceNumber = $data['evidence_number'];
        $smartformAddressModel->city = $data['city'];
        $smartformAddressModel->zipCode = $data['zip'];
        $smartformAddressModel->district = $data['district'];
        $smartformAddressModel->region = $data['region'];
        $smartformAddressModel->country = $data['country'];

        return $smartformAddressModel;
    }
}
