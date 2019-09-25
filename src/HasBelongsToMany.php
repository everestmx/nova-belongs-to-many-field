<?php

namespace Everestmx\BelongsToManyField;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Trait HasBelongsToMany.
 */
trait HasBelongsToMany
{
    /**
     * @param $relationModel
     *
     * @return BelongsToMany
     */
    public function model($relationModel): BelongsToMany
    {
        $model = app($relationModel);

        return $this->belongsToMany($model);
    }

    /**
     * @param $values
     * @param $attribute
     * @param $relationModel
     */
    public function syncManyValues($values, $attribute, $relationModel)
    {
        $arrayIds = array_column($values, 'id');
        $this->$attribute()->sync($arrayIds);
    }
}
