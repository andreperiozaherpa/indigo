<?php
class Splp extends CI_Controller{
    public function index(){
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => '5djCAeA9fCW6TrLQqDbTtyhZufMa',    // The client ID assigned to you by the provider
            'clientSecret'            => 'weM6Tf_mIEHucn0ILgIVCcDYmEAa',    // The client password assigned to you by the provider
            // 'redirectUri'             => 'https://my.example.com/your-redirect-url/',
            'urlAuthorize'            => NULL,
            'urlAccessToken'          => 'https://125.213.129.172:9453/oauth2/token',
            'urlResourceOwnerDetails' => NULL
        ]);

        try {

            // Try to get an access token using the client credentials grant.
            $accessToken = $provider->getAccessToken('client_credentials');
            print_r($accessToken);

        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

            // Failed to get the access token
            exit($e->getMessage());

        }
    }
}
?>