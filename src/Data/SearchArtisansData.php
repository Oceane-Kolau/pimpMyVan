<?php

namespace App\Data;

use App\Entity\SpecificSetup;
use App\Entity\GeneralSetup;
use App\Entity\Region;
use App\Entity\SpecialtiesVanArtisan;

class SearchArtisansData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var SpecialtiesVanArtisan[]
     */
    public $specialtiesVanArtisan = [];

    /**
     * @var Region[]
     */
    public $region = [];

    /**
     * @var GeneralSetup[]
     */
    public $generalSetup = [];

    /**
     * @var SpecificSetup[]
     */
    public $specificSetup = [];
}