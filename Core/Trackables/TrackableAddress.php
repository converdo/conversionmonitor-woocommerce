<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;

class TrackableAddress implements Renderable
{
    /**
     * The street name and house number.
     *
     * @var string
     */
    protected $address;

    /**
     * The address postal code.
     *
     * @var string
     */
    protected $postal;

    /**
     * The address city.
     *
     * @var string
     */
    protected $city;

    /**
     * The address country
     *
     * @var string
     */
    protected $country;

    /**
     * Set the street name and house number.
     *
     * @param  string       $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the street name and house number.
     *
     * @return string
     */
    public function address()
    {
        return $this->address;
    }

    /**
     * Set the address postal code.
     *
     * @param  string       $postal
     * @return $this
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;

        return $this;
    }

    /**
     * Get the address postal code.
     *
     * @return string
     */
    public function postal()
    {
        return $this->postal;
    }

    /**
     * Set the address city.
     *
     * @param  string       $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the address city.
     *
     * @return string
     */
    public function city()
    {
        return $this->city;
    }

    /**
     * Set the country.
     *
     * @param  string       $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the country.
     *
     * @return string
     */
    public function country()
    {
        return $this->country;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'ad' => $this->address(),
            'po' => $this->postal(),
            'ci' => $this->city(),
            'co' => $this->country(),
        ];
    }
}