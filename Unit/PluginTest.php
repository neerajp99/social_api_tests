<?php

use Drupal\social_api\Plugin\NetworkManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\social_api\Plugin\NetworkInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Tests\UnitTestCase;

/**
 * Defines Social Network.
 *
 * @Annotation
 */
class PluginTest extends UnitTestCase {

  /**
   * Define __construct function.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests for class NetworkManager.
   */
  public function testNetworkManager() {
    $namespaces = $this->createMock(Traversable::class);
    $cache_backend = $this->createMock(CacheBackendInterface::class);
    $module_handler = $this->createMock(ModuleHandlerInterface::class);
    $networkManager = $this->getMockBuilder(NetworkManager::class)
      ->setConstructorArgs(array($namespaces, $cache_backend, $module_handler))
      ->getMock();
    parent::__construct();
    $this->assertTrue($networkManager instanceof NetworkManager);
    $this->assertTrue(
     method_exists($networkManager, 'setCacheBackend'),
     'NetworkManager does not implements setCacheBackend function/method'
    );
    $this->assertTrue(
     method_exists($networkManager, 'alterInfo'),
     'NetworkManager does not implements alterInfo function/method'
    );
  }

  /**
   * Tests for class NetworkInterface.
   */
  public function testNetworkInterface() {
    $networkInterface = $this->createMock(NetworkInterface::class);
    $this->assertTrue(
      method_exists($networkInterface, 'authenticate'),
      'NetworkManager does not implements authenticate function/method'
    );
    $this->assertTrue(
      method_exists($networkInterface, 'getSdk'),
      'NetworkManager does not implements getSdk function/method'
    );
  }

  /**
   * Tests for class NetworkBase.
   */
  public function testNetworkBase() {
    $entity_type_manager = $this->createMock(EntityTypeManagerInterface::class);
    $config_factory = $this->createMock(ConfigFactoryInterface::class);
    $container = $this->createMock(ContainerInterface::class);
    $configuration = array();
    $plugin_definition = array();

    $networkBase = $this->getMockBuilder('Drupal\social_api\Plugin\NetworkBase')
      ->setConstructorArgs(array($configuration,
        'drupal123',
        $plugin_definition,
        $entity_type_manager,
        $config_factory,
      ))
      ->setMethods(['getSdk', 'create'])
      ->getMockForAbstractClass();
    $this->assertTrue(
      method_exists($networkBase, 'init'),
      'NetworkBase does not implements init function/method'
    );
    $this->assertTrue(
      method_exists($networkBase, 'create'),
      'NetworkBase does not implements create function/method'
    );
    $this->assertTrue(
      method_exists($networkBase, 'authenticate'),
      'NetworkBase does not implements authenticate function/method'
    );
    $this->assertTrue(
      method_exists($networkBase, 'getSdk'),
      'NetworkBase does not implements getSdk function/method'
    );
  }

}
