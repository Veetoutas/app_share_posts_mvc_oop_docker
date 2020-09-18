<?php


namespace VFramework\DTO;

class CountryDTO
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $alpha2Code;

    /**
     * @var string
     */
    private $capital;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $subregion;

    /**
     * @var int
     */
    private $population;

    /**
     * @var string
     */
    private $latlng;

    /**
     * @var float
     */
    private $area;

    /**
     * @var string
     */
    private $timezones;

    /**
     * CountryDTO constructor.
     * @param string $name
     * @param string $alpha2Code
     * @param string $capital
     * @param string $region
     * @param string $subregion
     * @param int $population
     * @param string $latlng
     * @param float $area
     * @param string $timezones
     */
    public function __construct(
        string $name,
        string $alpha2Code,
        string $capital,
        string $region,
        string $subregion,
        int $population,
        string $latlng,
        float $area,
        string $timezones)
    {
        $this->name = $name;
        $this->alpha2Code = $alpha2Code;
        $this->capital = $capital;
        $this->region = $region;
        $this->subregion = $subregion;
        $this->population = $population;
        $this->latlng = $latlng;
        $this->area = $area;
        $this->timezones = $timezones;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlpha2Code(): string
    {
        return $this->alpha2Code;
    }

    /**
     * @return string
     */
    public function getCapital(): string
    {
        return $this->capital;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getSubregion(): string
    {
        return $this->subregion;
    }

    /**
     * @return int
     */
    public function getPopulation(): int
    {
        return $this->population;
    }

    /**
     * @return string
     */
    public function getLatlng(): string
    {
        return $this->latlng;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return $this->area;
    }

    /**
     * @return string
     */
    public function getTimezones(): string
    {
        return $this->timezones;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'alpha2Code' => $this->getAlpha2Code(),
            'capital' => $this->getCapital(),
            'region' => $this->getRegion(),
            'subregion' => $this->getSubregion(),
            'population' => $this->getPopulation(),
            'latlng' => $this->getLatlng(),
            'area' => $this->getArea(),
            'timezones' => $this->getTimezones()
        ];
    }
}
