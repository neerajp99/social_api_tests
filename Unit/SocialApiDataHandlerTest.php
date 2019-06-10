<?php

use Drupal\social_api\SocialApiDataHandler;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Drupal\Tests\UnitTestCase;

/**
 * Defines SocialApiDataHandler class.
 *
 * @Annotation
 */
class SocialApiDataHandlerTest extends UnitTestCase {

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
   * Tests for class SocialApiDataHandler.
   */
  public function testSocialApiDataHandler() {
    $key = "drupal";
    $value = "drupal123";
    $session = $this->getMock(SessionInterface::class);
    $socialApiDataHandler = $this->getMockBuilder(SocialApiDataHandler::class)
      ->setConstructorArgs(array($session))
      ->setMethods(array('set', 'get'))
      ->getMockForAbstractClass();
    $socialApiDataHandler->method('get')
      ->with($key)
      ->willReturn($session->get($socialApiDataHandler->getSessionPrefix() . $key));
    $socialApiDataHandler->setSessionPrefix('1234');
    $this->assertEquals('1234_', $socialApiDataHandler->getSessionPrefix());
    $this->assertEquals($session->get($socialApiDataHandler->getSessionPrefix() . $key), $socialApiDataHandler->get($key));
    $session->set($socialApiDataHandler->getSessionPrefix(), $value);
  }

}
