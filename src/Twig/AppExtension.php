<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;


class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    // private $markdownHelper;
    private $container;
    // public function __construct(MarkdownHelper $markdownHelper)
    // {
    //     $this->markdownHelper = $markdownHelper;
    // }

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('cached_markdown',  [AppRuntime::class, 'processMarkdown'], ['is_safe' => ['html']]),
        ];
    }



    public function processMarkdown($value)
    {
        $this->container
            ->get(MarkdownHelper::class)
            ->parse($value);
    }
    public static function getSubscribedServices()
    {
        return [
            MarkdownHelper::class,
        ];
    }
}
