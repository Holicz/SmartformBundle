<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\Form\DataMapper;

use DobryProgramator\SmartformBundle\Entity\AbstractSmartformAddress;
use DobryProgramator\SmartformBundle\Exception\SmartformFieldNotFilledException;
use DobryProgramator\SmartformBundle\Form\Model\SmartformAddressModel;

final class SmartformAddressMapper
{
    /**
     * @throws SmartformFieldNotFilledException
     */
    public function mapEntityFromModel(AbstractSmartformAddress $entity, SmartformAddressModel $model): void
    {
        if (
            !$model->code ||
            !$model->latitude ||
            !$model->longitude ||
            !$model->houseNumber ||
            !$model->city ||
            !$model->zipCode ||
            !$model->district ||
            !$model->region ||
            !$model->country
        ) {
            throw new SmartformFieldNotFilledException();
        }

        $entity->setCode($model->code);
        $entity->setLatitude($model->latitude);
        $entity->setLongitude($model->longitude);
        /** @var string $street */
        $street = $model->street ?: $model->cityPart;
        $entity->setStreet($street);
        $entity->setHouseNumber($model->houseNumber);
        $entity->setOrientationNumber($model->orientationNumber);
        $entity->setCity($model->city);
        $entity->setZipCode($model->zipCode);
        $entity->setDistrict($model->district);
        $entity->setRegion($model->region);
        $entity->setCountry($model->country);
    }

    public function mapModelFromEntity(AbstractSmartformAddress $abstractAddress, SmartformAddressModel $abstractAddressModel): void
    {
        $abstractAddressModel->address = $abstractAddress->__toString();
        $abstractAddressModel->code = $abstractAddress->getCode();
        $abstractAddressModel->latitude = $abstractAddress->getLatitude();
        $abstractAddressModel->longitude = $abstractAddress->getLongitude();
        $abstractAddressModel->street = $abstractAddress->getStreet();
        $abstractAddressModel->houseNumber = $abstractAddress->getHouseNumber();
        $abstractAddressModel->orientationNumber = $abstractAddress->getOrientationNumber();
        $abstractAddressModel->district = $abstractAddress->getDistrict();
        $abstractAddressModel->city = $abstractAddress->getCity();
        $abstractAddressModel->zipCode = $abstractAddress->getZipCode();
        $abstractAddressModel->region = $abstractAddress->getRegion();
        $abstractAddressModel->country = $abstractAddress->getCountry();
    }
}
