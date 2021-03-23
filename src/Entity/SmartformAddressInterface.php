<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\Entity;

use DobryProgramator\SmartformBundle\Form\Model\SmartformAddressModel;

interface SmartformAddressInterface
{
    public function setCode(string $code): void;

    public function getCode(): string;

    public function setLatitude(string $latitude): void;

    public function getLatitude(): string;

    public function setLongitude(string $longitude): void;

    public function getLongitude(): string;

    public function setStreet(string $street): void;

    public function getStreet(): string;

    public function setHouseNumber(string $houseNumber): void;

    public function getHouseNumber(): string;

    public function setOrientationNumber(?string $orientationNumber): void;

    public function getOrientationNumber(): ?string;

    public function getBuildingNumber(): string;

    public function getStreetAndBuildingNumber(): string;

    public function setCity(string $city): void;

    public function getCity(): string;

    public function setZipCode(string $zipCode): void;

    public function getZipCode(): string;

    public function setRegion(string $region): void;

    public function getRegion(): string;

    public function setDistrict(string $district): void;

    public function getDistrict(): string;

    public function setCountry(string $country): void;

    public function getCountry(): string;

    public function mapFromModel(SmartformAddressModel $model): void;
}
