<?php

namespace Converdo\ConversionMonitor\Core\Responses;

use Converdo\Common\Controllers\AbstractResponse;

class JsonResponse extends AbstractResponse
{
    /**
     * Returns a JSON response.
     *
     * @param  array    $data
     * @param  int      $status
     * @param  array    $headers
     * @return string
     */
    public function json(array $data, $status = 200, array $headers = [])
    {
        $headers[] = 'Content-Type: application/json;charset=utf-8';

        $this->setHeaders($headers);

        $this->setStatusCode($status);

        return $this->output($data);
    }

    /**
     * Prints the data to the view.
     *
     * @param  array    $data
     * @return string
     */
    public function output(array $data)
    {
        return json_encode($data);
    }
}