<?php

namespace Rakhasa\Whatsapp\Endpoints\Wabot;

use Rakhasa\Whatsapp\Exceptions\ApiResponseException;
use Rakhasa\Whatsapp\Concerns\HasRequest;
use Rakhasa\Whatsapp\Contracts\Adapter;
use Rakhasa\Whatsapp\Contracts\Endpoint;
use Rakhasa\Whatsapp\Exceptions\InvalidSessionIdException;
use Rakhasa\Whatsapp\Exceptions\WhatsappNotLoggedIn;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Instance implements Endpoint
{
    use HasRequest;

    /**
     * adapter class instance
     *
     * @var Adapter
     */
    protected Adapter $adapter;

    /**
     * instance construct
     *
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * get qrcode response
     *
     * @throws ApiResponseException
     * @param string $sessionId
     * @return string
     */
    public function qrcode(string $sessionId, string $webhook = '', string $proxyUrl = ''): string
    {
        $response = $this->adapter->get('instance/init', $this->validateRequest([
            'key' => $sessionId,
            'webhookUrl' => $webhook
        ]));

        if ($response->failed()) {
            throw new ApiResponseException($response->json('message'));
        }

        return $this->getQrCode($sessionId);
    }

    /**
     * logout whatsapp session
     *
     * @throws ApiResponseException
     * @param string $sessionId
     * @return boolean
     */
    public function logout(string $sessionId): bool
    {
        $response = $this->adapter->delete('instance/logout', $this->validateRequest([
            'key' => $sessionId,
        ]));

        if ($response->failed()) {
            if ($response->json('message') == 'no key query was present') {
                return true;
            }

            throw new ApiResponseException($response->json('message'));
        }

        return true;
    }

    /**
     * Get QR Code
     *
     * @throws ApiResponseException
     * @param string $sessionId
     * @return string
     */
    private function getQrCode(string $sessionId): string
    {
        $response = $this->fetchQrcode($sessionId);

        $qrCode = $response->json('qrcode');
        $maxRetry = 10;
        $qrRetry = 1;

        while ($qrCode == '' && $qrRetry <= $maxRetry) {
            $response = $this->fetchQrcode($sessionId);
            if ($response->failed()) {
                throw new ApiResponseException($response->json('message'));
            }
            $qrCode = $response->json('qrcode');
            $qrRetry++;
            sleep(1);
        }

        return $qrCode;
    }

    /**
     * fetch qrcode
     *
     * @param string $sessionId
     * @return object
     */
    private function fetchQrcode(string $sessionId): object
    {
        return $this->adapter->get('instance/qrbase64', $this->validateRequest([
            'key' => $sessionId
        ]));
    }
}
