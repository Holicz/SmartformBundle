<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class SmartformAddressModel
{
    /**
     * @Assert\NotBlank(message="Kód z RÚIAN databáze je povinný")
     * @Assert\Length(max="255", maxMessage="Kód z RÚIAN databáze může mít maximálně {{ limit }} znaků")
     */
    public ?string $code = null;

    /**
     * @Assert\NotBlank(message="Zeměpisná šířka je povinná")
     * @Assert\Length(max="255", maxMessage="Zeměpisná šířka může mít maximálně {{ limit }} znaků")
     */
    public ?string $latitude = null;

    /**
     * @Assert\NotBlank(message="Zeměpisná délka je povinná")
     * @Assert\Length(max="255", maxMessage="Zeměpisná délka může mít maximálně {{ limit }} znaků")
     */
    public ?string $longitude = null;

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
    public ?string $cityPart = null;

    /**
     * @Assert\NotBlank(message="Číslo popisné je povinné")
     * @Assert\Length(max="255", maxMessage="Číslo popisné může mít maximálně {{ limit }} znaků")
     */
    public ?string $houseNumber = null;

    /**
     * @Assert\Length(max="255", maxMessage="Číslo orientační může mít maximálně {{ limit }} znaků")
     */
    public ?string $orientationNumber = null;

    /**
     * @Assert\NotBlank(message="Město je povinné")
     * @Assert\Length(max="255", maxMessage="Město může mít maximálně {{ limit }} znaků")
     */
    public ?string $city = null;

    /**
     * @Assert\NotBlank(message="PSČ je povinné")
     * @Assert\Regex("/^(\d{3})\s*(\d{2})$/", message="PSČ není ve správném formátu (např. 110 00)")
     */
    public ?string $zipCode = null;

    /**
     * @Assert\NotBlank(message="Okres je povinný")
     * @Assert\Length(max="255", maxMessage="Okres může mít maximálně {{ limit }} znaků")
     */
    public ?string $district = null;

    /**
     * @Assert\NotBlank(message="Kraj je povinný")
     * @Assert\Length(max="255", maxMessage="Kraj může mít maximálně {{ limit }} znaků")
     */
    public ?string $region = null;

    /**
     * @Assert\NotBlank(message="Země je povinná")
     * @Assert\Length(max="255", maxMessage="Země může mít maximálně {{ limit }} znaků")
     */
    public ?string $country = null;
}
