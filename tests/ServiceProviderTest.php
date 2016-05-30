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
      'Googleauthenticator' => 'Faheem00\LaravelGoogleAuthenticator\Facades\GoogleAuthenticator'
    ];
  }

  public function testFacade()
  {
    $facade_instance = $this->app->make('Faheem00\LaravelGoogleAuthenticator\GoogleAuthenticator')->getInstance();
    $this->assertInstanceOf(OTPHP\TOTP::class,$facade_instance);
    Googleauthenticator::getInstance();
  }
}
