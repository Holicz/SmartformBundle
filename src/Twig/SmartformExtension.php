<?php

declare(strict_types=1);

namespace DobryProgramator\SmartformBundle\Twig;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class SmartformExtension extends AbstractExtension
{
    private string $clientId;

    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'smartform_init',
                [
                    $this, 'smartformInit'
                ],
                [
                    'needs_environment' => true,
                    'is_safe' => ['html']
                ]
            ),
        ];
    }

    public function smartformInit(Environment $environment,array $classes = ['default']): string
    {
        return $environment->render(
            '@DobryProgramatorSmartform/smartform_init.html.twig',
            [
                'client_id' => $this->clientId,
                'classes' => $classes
            ]
        );
    }
}
