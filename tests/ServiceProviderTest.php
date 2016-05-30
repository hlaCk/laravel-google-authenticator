<?php

class ServiceProviderTest extends \Orchestra\Testbench\TestCase
{
  /**
    * Setup the test environment.
    */
   public function setUp()
   {
       parent::setUp();
   }

   /**
   *  Get Package Providers
   */
  protected function getPackageProviders($app)
  {
    return [
      'Faheem00\LaravelGoogleAuthenticator\Providers\GoogleAuthenticatorServiceProvider'
    ];
  }

  /**
  *  Get Package Aliases
  */
  protected function getPackageAliases($app)
  {
    return [
      'Googleauth' => 'Faheem00\LaravelGoogleAuthenticator\Facades\GoogleAuthenticatorFacade'
    ];
  }

  public function testFacade()
  {
    $facade_instance = Googleauth::getInstance();
    $this->assertInstanceOf(OTPHP\TOTP::class,$facade_instance);
  }
}
