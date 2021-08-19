<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\Entity;

use DobryProgramator\SmartformBundle\Form\Model\SmartformAddressModel;

abstract class AbstractSmartformAddress implements SmartformAddressInterface
{
    private string $code;

    private string $latitude;

    private string $longitude;

    private string $street;

    private ?string $houseNumber;

    private ?string $orientationNumber;

    private ?string $evidenceNumber;

    private string $city;

    private string $zipCode;

    private string $district;

    private string $region;

    private string $country;

    public function __toString(): string
    {
        return $this->getStreetAndBuildingNumber() . ', ' . $this->getCity();
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setHouseNumber(?string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setOrientationNumber(?string $orientationNumber): void
    {
        $this->orientationNumber = $orientationNumber;
    }

    public function getOrientationNumber(): ?string
    {
        return $this->orientationNumber;
    }

    public function setEvidenceNumber(?string $evidenceNumber): void
    {
        $this->evidenceNumber = $evidenceNumber;
    }

    public function getEvidenceNumber(): ?string
    {
        return $this->evidenceNumber;
    }

    public function getBuildingNumber(): string
    {
        if ($this->getOrientationNumber()) {
            return $this->getHouseNumber() . '/' . $this->getOrientationNumber();
        }

        if ($this->getEvidenceNumber()) {
            return 'ev.č. ' . $this->getEvidenceNumber();
        }

        return $this->getHouseNumber() ?? '';
    }

    public function getStreetAndBuildingNumber(): string
    {
        return $this->getStreet() . ' ' . $this->getBuildingNumber();
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setZipCode(string $zipCode): void
    {
        // Remove spaces
        $this->zipCode = (string) \Safe\preg_replace('/\s+/', '', $zipCode);
    }

    public function getZipCode(): string
    {
        // Format zip code to XXX XX
        return \Safe\substr($this->zipCode, 0, 3) . ' ' . \Safe\substr($this->zipCode, 3);
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }


    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function mapFromModel(SmartformAddressModel $model): void
    {
        $this->setCode($model->code);
        $this->setLatitude($model->latitude);
        $this->setLongitude($model->longitude);
        $street = $model->street ?? $model->cityPart;
        $this->setStreet($street);
        $this->setHouseNumber($model->houseNumber);
        $this->setOrientationNumber($model->orientationNumber);
        $this->setCity($model->city);
        $this->setZipCode($model->zipCode);
        $this->setDistrict($model->district);
        $this->setRegion($model->region);
        $this->setCountry($model->country);
        $this->setEvidenceNumber($model->evidenceNumber);
    }
}
