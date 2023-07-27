<?php
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use App\Application\Settings\SettingsInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
      EntityManager::class => function (ContainerInterface $c) {
            $settings = ($c->get(SettingsInterface::class))->get('doctrine');
            // Use the ArrayAdapter or the FilesystemAdapter depending on the value of the 'dev_mode' setting
            // You can substitute the FilesystemAdapter for any other cache you prefer from the symfony/cache library

            $cache = $settings['dev_mode'] ?
            DoctrineProvider::wrap(new ArrayAdapter()) :
            DoctrineProvider::wrap(new FilesystemAdapter($settings['cache_dir']));

            $config = Setup::createAnnotationMetadataConfiguration(
              $settings['metadata_dirs'],
              $settings['dev_mode'],
              null,
              $cache,
              false
            );

            return EntityManager::create($settings['connection'], $config);
      },
    ]);
};