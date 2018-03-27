<?php

namespace Converdo\ConversionMonitor\Core\API;

use Converdo\ConversionMonitor\Core\Contracts\Requestable;

class Client
{
    /**
     * Send a request to the conversion monitor api.
     *
     * @param  Requestable      $requestable
     * @return string
     */
    public function send(Requestable $requestable)
    {
        if (cvd_config()->platform()->disabled()) {
            return null;
        }

        try {
            $ch = curl_init($requestable->url());

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($requestable->method()));
            curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/resources/api_cert_chain.pem');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);

            if ($requestable->method() === 'POST') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestable->payload()));
            }

            $response = trim((string) curl_exec($ch));

            if ($response === false) {
                cvd_logger()->error(curl_error($ch));
            }

            curl_close($ch);

            $response = json_decode($response, true);

            if (! isset($response['message'])) {
                cvd_logger()->error("Something went wrong reading the response.");

                return null;
            }

            cvd_logger()->info($response['message']);

            return $response['message'];
        } catch (\Exception $exception) {
            cvd_logger()->emergency($exception->getMessage());
        }

        return null;
    }
}