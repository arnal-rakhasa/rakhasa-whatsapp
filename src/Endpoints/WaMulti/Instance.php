<?php

namespace Rakhasa\Whatsapp\Endpoints\WaMulti;

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
        $response = $this->adapter->asForm()->post('/api/profile/scanqr?', $this->validateRequest([
            'sessionId' => $sessionId,
            'hookURL' => $webhook,
            'proxyURL' => $proxyUrl
        ]));

        if ($response->failed()) {
            throw new ApiResponseException($response->json('message'));
        }

        return $this->qrToBase64($response->json('base64'));
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
        $response = $this->adapter->asForm()->post('api/profile/logout', $this->validateRequest([
            'sessionId' => $sessionId
        ]));

        if ($response->failed()) {
            if ($response->json('message') == 'Invalid Session Id') {
                throw new InvalidSessionIdException($sessionId);
            } elseif ($response->json('message') == 'Whatsapp not LoggedIn') {
                throw new WhatsappNotLoggedIn;
            }

            throw new ApiResponseException($response->json('message'));
        }

        return true;
    }

    /**
     * Get list contacts
     *
     * @throws ApiResponseException
     * @param string $sessionId
     * @return array
     */
    public function contacts(string $sessionId): array
    {
        $response = $this->adapter->get('api/profile/contacts', $this->validateRequest([
            'sessionId' => $sessionId
        ]));

        if ($response->failed()) {
            throw new ApiResponseException($response->json('message'));
        }

        return $response->json();
    }

    /**
     * convert qrcode to base64 image
     *
     * @param string $qrcode
     * @return string
     */
    private function qrToBase64(string $qrcode): string
    {
        return 'data:image/png;base64, ' . base64_encode(QrCode::format('png')->size(256)->generate($qrcode));
    }
}
