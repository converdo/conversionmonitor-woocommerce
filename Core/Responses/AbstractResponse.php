<?php

namespace Converdo\ConversionMonitor\Core\Responses;

abstract class AbstractResponse
{
    /**
     * Sets the status code of the Response.
     *
     * @param  int      $status
     * @return $this
     */
    public function setStatusCode($status)
    {
        http_response_code($status);

        return $this;
    }

    /**
     * Sets the headers of the Response.
     *
     * @param  array    $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        foreach ($headers as $header) {
            header($header);
        }

        return $this;
    }
}