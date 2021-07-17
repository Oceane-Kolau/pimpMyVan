<?php

namespace App\Data;

use App\Entity\TypeVan;
use App\Entity\SizeVan;
use App\Entity\BrandVan;
use App\Entity\YearVan;
use App\Entity\KilometerVan;

class SearchAdsVanData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var TypeVan[]
     */
    public $typeVan = [];

    /**
     * @var SizeVan[]
     */
    public $sizeVan = [];

    /**
     * @var BrandVan[]
     */
    public $brandVan = [];

    /**
     * @var YearVan[]
     */
    public $yearVan = [];

    /**
     * @var KilometerVan[]
     */
    public $kilometerVan = [];
}