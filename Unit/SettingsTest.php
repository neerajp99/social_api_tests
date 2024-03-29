<?php

use Drupal\social_api\Settings\SettingsBase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Drupal\Core\Config\StorageInterface;
use Drupal\Core\Config\TypedConfigManagerInterface;
use Drupal\Tests\UnitTestCase;

/**
 * Defines Settings Class.
 *
 * @Annotation
 */
class SettingsTest extends UnitTestCase {

  /**
   * Tests for class Settings.
   */
  public function testSettingsBase() {
    $config = $this->getMockBuilder('Drupal\Core\Config\Config')
      ->disableOriginalConstructor()
      ->getMock();

    $storage = $this->createMock(StorageInterface::class);
    $event_dispatcher = $this->createMock(EventDispatcherInterface::class);
    $typed_config = $this->createMock(TypedConfigManagerInterface::class);

    $configs = $this->getMockBuilder('Drupal\Core\Config\ImmutableConfig')
      ->setConstructorArgs([$config,
        $storage,
        $event_dispatcher,
        $typed_config,
      ])
      ->getMock();

    $settingsBase = $this->getMockBuilder(SettingsBase::class)
      ->setConstructorArgs([$configs])
      ->setMethods(null)
      ->getMockForAbstractClass();

    $this->assertTrue(
      method_exists($settingsBase, 'getConfig'),
      'SettingsBase does not implements getConfig function/method'
    );

    $this->assertTrue(
      method_exists($settingsBase, 'factory'),
      'SettingsBase does not implements factory function/method'
    );

    $this->assertNotNull($settingsBase->factory($configs));

    $this->assertEquals($configs, $settingsBase->getConfig());
  }

}
