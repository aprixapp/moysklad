<?php

namespace AprixApp\MoySklad\Entities;

use AprixApp\MoySklad\MSReport;

class Stock extends MSReport
{
    const CODE_ENTITY = 'stock';

    public function useExtendedReportMode(): self
    {
        $this->mode = 'all';
        $this->partHref .= '/all';

        return $this;
    }

    public function useShortReportByStoreMode(): self
    {
        $this->mode = 'bystore/current';
        $this->partHref .= '/bystore/current';

        return $this;
    }

    public function useShortReportAllMode(): self
    {
        $this->mode = 'all/current';
        $this->partHref .= '/all/current';

        return $this;
    }

    public function useByStoreReportMode(): self
    {
        $this->mode = 'bystore';
        $this->partHref .= '/bystore';

        return $this;
    }

    public function useByOperationReportMode(string $uuidDocument): self
    {
        $this->mode = "byoperation";
        $this->partHref .= '/byoperation';
        $this->arQuery["operation.id"] = $uuidDocument;

        return $this;
    }

    public function enabledIncludeRelated(): self
    {
        if ($this->mode != 'all') {
            throw new \Exception('The "includeRelated" parameter can only be set when requesting an extended stock report.');
        }

        $this->arQuery['includeRelated'] = 'true';

        return $this;
    }

    public function disabledIncludeRelated(): self
    {
        if ($this->mode != 'all') {
            throw new \Exception('The "includeRelated" parameter can only be set when requesting an extended stock report.');
        }

        $this->arQuery['includeRelated'] = 'false';

        return $this;
    }

    public function enabledIncludeZeroLines(): self
    {
        if ($this->mode != 'bystore/current' && $this->mode != 'all/current') {
            throw new \Exception('The "include" parameter can only be set when requesting a brief stock report.');
        }

        $this->arQuery['include'] = "zeroLines";

        return $this;
    }

    public function disabledIncludeZeroLines(): self
    {
        if ($this->mode != 'bystore/current' && $this->mode != 'all/current') {
            throw new \Exception('The "include" parameter can only be set when requesting a brief stock report.');
        }

        unset($this->arQuery["include"]);

        return $this;
    }

    public function setChangedSince(\DateTime $dateTime): self
    {
        if ($this->mode != 'bystore/current' && $this->mode != 'all/current') {
            throw new \Exception('The "changedSince" parameter can only be set when requesting a brief stock report.');
        }

        $this->arQuery["changedSince"] = $dateTime->format("Y-m-d H:i:s");

        return $this;
    }

    public function setStockType(string $stockType): self
    {
        if ($this->mode != 'bystore/current' && $this->mode != 'all/current') {
            throw new \Exception('The "stockType" parameter can only be set when requesting a brief stock report.');
        }

        $listValidValues = [
            "stock",
            "freeStock",
            "quantity",
            "reserve",
            "inTransit"
        ];

        if (!in_array($stockType, $listValidValues)) {
            throw new \Exception('The value for the "stockType" field is incorrect. Allowed values are: "stock", "freeStock", "quantity", "reserve", "inTransit".');
        }

        $this->arQuery["stockType"] = $stockType;

        return $this;
    }
}