<?php

namespace Xi\Netvisor\Resource\Xml;

class ProductPackageInformation
{
    private $packageWidth;
    private $packageHeight;
    private $packageLength;

    /**
     * @param string $packageWidth
     * @param string $packageHeight
     * @param string $packageLength
     */
    public function __construct(
        $packageWidth,
        $packageHeight,
        $packageLength
    ) {
        $this->packageWidth = $packageWidth;
        $this->packageHeight = $packageHeight;
        $this->packageLength = $packageLength;
    }
}
