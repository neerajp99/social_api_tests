<?php

use Drupal\social_api\Plugin\NetworkManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\social_api\Plugin\NetworkInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Tests\UnitTestCase;
use Drupal\social_api\Plugin\NetworkBase;

/**
 * Defines Social Network.
 *
 * @Annotation
 */
class PluginTest extends UnitTestCase {

  /**
   * Tests for class NetworkManager.
   */
  public function testNetworkManager() {
    $namespaces = $this->createMock(Traversable::class);
    $cache_backend = $this->createMock(CacheBackendInterface::class);
    $module_handler = $this->createMock(ModuleHandlerInterface::class);

    $networkManager = $this->getMockBuilder(NetworkManager::class)
      ->setConstructorArgs([$namespaces, $cache_backend, $module_handler])
      ->setMethods(null)
      ->getMock();

    $this->assertTrue(
     method_exists($networkManager, 'setCacheBackend'),
     'NetworkManager class does not implements setCacheBackend function/method'
    );

    $this->assertTrue(
     method_exists($networkManager, 'alterInfo'),
     'NetworkManager class does not implements alterInfo function/method'
    );
  }

  /**
   * Tests for class NetworkInterface.
   */
  public function testNetworkInterface() {
    $networkInterface = $this->createMock(NetworkInterface::class);

    $this->assertTrue(
      method_exists($networkInterface, 'authenticate'),
      'NetworkManagerInterface class does not implements authenticate function/method'
    );

    $this->assertTrue(
      method_exists($networkInterface, 'getSdk'),
      'NetworkManagerInterface class does not implements getSdk function/method'
    );
  }

  /**
   * Tests for class NetworkBase.
   */
  public function testNetworkBase() {
    $entity_type_manager = $this->createMock(EntityTypeManagerInterface::class);
    $config_factory = $this->createMock(ConfigFactoryInterface::class);
    $container = $this->createMock(ContainerInterface::class);
    $configuration = [];
    $plugin_definition = [];

    $networkBase = $this->getMockBuilder(NetworkBase::class)
      ->setConstructorArgs([$configuration,
        'drupal123',
        $plugin_definition,
        $entity_type_manager,
        $config_factory,
      ])
      ->getMockForAbstractClass();

    $this->assertTrue(
      method_exists($networkBase, 'init'),
      'NetworkBase class does not implements init function/method'
    );

    $this->assertTrue(
      method_exists($networkBase, 'create'),
      'NetworkBase class does not implements create function/method'
    );

    $this->assertTrue(
      method_exists($networkBase, 'authenticate'),
      'NetworkBase class does not implements authenticate function/method'
    );

    $this->assertTrue(
      method_exists($networkBase, 'getSdk'),
      'NetworkBase class does not implements getSdk function/method'
    );
  }

}
