<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Items\Experiment;

/**
 * Class VariationsAdapter
 * @package GrowthOptimized
 */
class VariationsAdapter extends AdapterAbstract
{

    /**
     * @param array $variations
     * @return static
     */
    public function update(array $variations)
    {
        $response = $this->client->patch(
            "experiments/{$this->getResourceId()}",
            ["variations" => $variations]
        );

        return Experiment::createFromJson($response->getBody()->getContents());
    }

}