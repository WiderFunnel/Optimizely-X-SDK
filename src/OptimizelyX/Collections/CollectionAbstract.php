<?php

namespace WiderFunnel\OptimizelyX\Collections;

use Illuminate\Support\Collection;

/**
 * Class CollectionAbstract
 * @package WiderFunnel\Collections
 */
abstract class CollectionAbstract extends Collection
{
    public abstract static function createFromJson($json);
}