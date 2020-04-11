Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Requirements
----------------------------------
* PHP 7.4
* Symfony 5
* Twig 3

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require dobryprogramator/smartform-bundle
```

Now proceed to chapter `Configuration`.

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require dobryprogramator/smartform-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    DobryProgramator\SmartformBundle\DobryProgramatorSmartformBundle::class => ['all' => true],
];
```

Now proceed to chapter `Configuration`.

Configuration
=============
Add following to the `.env` a replace the `FILL_IN` with your `client_id`.

```
SMARTFORM_CLIENT_ID=FILL_IN
```

Create file `config/packages/dobry_programator_smartform.yaml` with following content:
```
dobry_programator_smartform:
    client_id: '%env(SMARTFORM_CLIENT_ID)%'
```

Usage
=====
For more detailed look into the bundle visit the [demo repository](https://github.com/DobryProgramator/SmartformBundleDemo).

**This bundle supports only using forms with DTO as explained [here](https://blog.martinhujer.cz/symfony-forms-with-request-objects/).**

Entity
------
```php
<?php

namespace App\Entity;

use DobryProgramator\SmartformBundle\Entity\AbstractSmartformAddress;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address extends AbstractSmartformAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
```

Model
-----
```php
<?php

declare(strict_types=1);

namespace App\Form\Model;

use DobryProgramator\SmartformBundle\Form\Model\SmartformAddressModel;
use Symfony\Component\Validator\Constraints as Assert;

final class AddressModel
{
    /**
     * @Assert\Valid
     *
     * @var SmartformAddressModel
     */
    public $address;
}
```

Form
----
```php
<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Form\Model\AddressModel;
use DobryProgramator\SmartformBundle\Form\Type\SmartformWholeAddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'address',
                SmartformWholeAddressType::class,
                [
                    'label' => 'Address'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => AddressModel::class
            ]
        );
    }

    public function getBlockPrefix(): string
    {
        return 'app_address_';
    }
}
```

DataMapper
-----------
To transport the data between DTO and entity
```php
<?php

declare(strict_types=1);

namespace App\Form\DataMapper;

use App\Entity\Address;
use App\Form\Model\AddressModel;
use DobryProgramator\SmartformBundle\Exception\SmartformFieldNotFilledException;
use DobryProgramator\SmartformBundle\Form\DataMapper\SmartformAddressMapper;

final class AddressDataMapper
{
    private SmartformAddressMapper $smartformAddressMapper;

    public function __construct(SmartformAddressMapper $smartformAddressMapper)
    {
        $this->smartformAddressMapper = $smartformAddressMapper;
    }

    /**
     * @throws SmartformFieldNotFilledException
     */
    public function mapEntityFromModel(Address $entity, AddressModel $model): void
    {
        $this->smartformAddressMapper->mapEntityFromModel($entity, $model->address);
    }

    public function mapModelFromEntity(Address $entity, AddressModel $model): void
    {
        $this->smartformAddressMapper->mapModelFromEntity($entity, $model->address);
    }
}
```

Controller
----------
```php
...
$addressModel = new AddressModel();
$addressForm = $this->createForm(AddressType::class, $addressModel);

$addressForm->handleRequest($request);
if($addressForm->isSubmitted() && $addressForm->isValid()) {
    $address = new Address();
    $this->addressDataMapper->mapEntityFromModel($address, $addressModel);
    
    // Do whatever you need with the entity, for example persist to the databas
}
...
```

Template
--------
```twig
{{ smartform_init() }}

{{ form_start(address_form) }}
    {% if address_form.address.vars.errors.count %}
        <small class="form-text text-danger">
            Address is not valid
        </small>
    {% endif %}
    Address
    {{ form_widget(address_form.address) }}

    <button type="submit" class="btn btn-primary">Submit</button>
{{ form_end(address_form) }}
```
