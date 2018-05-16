<?php

declare(strict_types=1);

namespace WH\VosFacturesBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BillManager
 *
 * @package WH\VosFacturesBundle\Services
 */
class BillManager
{
    private $curlRequester;
    private $container;

    private $baseUrl = '/invoices.json';
    private $testMode;

    /**
     * BillManager constructor.
     *
     * @param CurlRequester      $curlRequester
     * @param ContainerInterface $container
     */
    public function __construct(CurlRequester $curlRequester, ContainerInterface $container)
    {
        $this->curlRequester = $curlRequester;
        $this->container = $container;
        $this->testMode = $this->container->getParameter('vos_factures.testMode');
    }

    /**
     * @param array $parameters
     *
     * @return mixed
     */
    public function index(array $parameters = [])
    {
        return $this->curlRequester->get($this->baseUrl, $parameters);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function get($id)
    {
        return $this->curlRequester->get("/invoices/".$id.".json");
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getPdfLink($id)
    {
        $bill = $this->get($id);

        if (!empty($bill['token'])) {
            return $this->curlRequester->getBaseUrl()."/invoice/".$bill['token'].".pdf";
        }

        return '';
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data = [])
    {
        $data['invoice']['kind'] = 'vat';

        $data['invoice']['test'] = $this->testMode;

        return $this->curlRequester->post($this->baseUrl, $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->curlRequester->delete("/invoices/".$id.".json");
    }
}