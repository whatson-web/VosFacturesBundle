<?php

declare(strict_types=1);

namespace WH\VosFacturesBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CurlRequester
 *
 * @package WH\VosFacturesBundle\Services
 */
class CurlRequester
{
    private $container;

    private $baseUrl;
    private $apiToken;

    /**
     * CurlRequester constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->apiToken = $this->container->getParameter('vos_factures.api_token');
        $accountName = $this->container->getParameter('vos_factures.account_name');

        $this->baseUrl = "https://".$accountName.".vosfactures.fr";
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $url
     * @param array  $parameters
     *
     * @return mixed
     */
    public function get(string $url, array $parameters = [])
    {
        return $this->curlRequest('GET', $url, $parameters);
    }

    /**
     * @param string $url
     * @param array  $data
     *
     * @return mixed
     */
    public function post(string $url, array $data = [])
    {
        return $this->curlRequest('POST', $url, [], $data);
    }

    /**
     * @param string $url
     *
     * @return mixed
     */
    public function delete(string $url)
    {
        return $this->curlRequest('DELETE', $url);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array  $parameters
     * @param array  $data
     *
     * @return mixed
     */
    public function curlRequest(string $method, string $url, array $parameters = [], array $data = [])
    {
        $parameters['api_token'] = $this->apiToken;

        $url = $this->baseUrl.$url."?".http_build_query($parameters);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, 1);

                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    [
                        'Accept: application/json',
                        'Content-Type: application/json',
                    ]
                );
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $output = curl_exec($ch);
        $output = json_decode($output, true);

        return $output;
    }
}