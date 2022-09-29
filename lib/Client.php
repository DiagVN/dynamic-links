<?php

namespace DiagVN\DynamicLink;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    protected string $domain = 'https://firebasedynamiclinks.googleapis.com';
    protected string $version = 'v1';

    public function __construct(protected GuzzleClient $client) {

    }

    public function createLink(string $link) {
        $option['json'] = [
            'dynamicLinkInfo' => [
                'domainUriPrefix' => config('dynamic_link.domain'),
                'link' => $link,
            ]
        ];
        $option['query'] = [
            'key' => config('dynamic_link.api_key')
        ];
        $response = $this->client->request(
            'POST',
            $this->domain.'/'.$this->version.'/shortLinks',
            $option
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
