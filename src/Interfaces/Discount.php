<?php

namespace Cone\Bazar\Interfaces;

interface Discount
{
    /**
     * Calculate the discount for the given model.
     *
     * @param  \Cone\Bazar\Interfaces\Discountable  $model
     * @return float
     */
    public function calculate(Discountable $model): float;
}