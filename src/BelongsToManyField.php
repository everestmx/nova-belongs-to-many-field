<?php

namespace Everestmx\BelongsToManyField;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Everestmx\BelongsToManyField\Rules\ArrayRules;

/**
 * Class BelongsToManyField
 * @package Everestmx\BelongsToManyField
 */
class BelongsToManyField extends Field
{
    /**
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * @var bool
     */
    public $showOnDetail = true;

    /**
     * @var bool
     */
    public $isAction = false;

    /**
     * @var string
     */
    public $height = '350px';

    /**
     * The field's component.
     *
     * @var string
     */

    public $component = 'belongs-to-many-field';

    /**
     * @var null
     */
    public $relationModel;

    /**
     * Create a new field.
     *
     * @param string      $name
     * @param string|null $attribute
     * @param string|null $resource
     *
     * @return void
     */
    public function __construct($name, $attribute = null, $resource = null)
    {
        parent::__construct($name, $attribute);

        $resource = $resource ?? ResourceRelationshipGuesser::guessResource($name);

        $this->resource               = $resource;
        $this->resourceClass          = $resource;
        $this->resourceName           = $resource::uriKey();
        $this->manyToManyRelationship = $this->attribute;

        $this->fillUsing(function ($request, $model, $attribute, $requestAttribute) use ($resource) {
            if (is_subclass_of($model, Model::class)) {
                $model::saved(function ($model) use ($attribute, $request) {
                    $values = array_column(json_decode($request->$attribute, true), 'id');
                    $model->$attribute()->sync($values);
                });
                unset($request->$attribute);
            }
        });
    }

    /**
     * @param string $optionsLabel
     *
     * @return BelongsToManyField
     */
    public function optionsLabel(string $optionsLabel = "name")
    {
        return $this->withMeta(['optionsLabel' => $optionsLabel]);
    }

    /**
     * @param $options
     *
     * @return BelongsToManyField
     */
    public function options($options)
    {
        $options = collect($options);

        return $this->withMeta(['options' => $options]);
    }

    /**
     * @param $model
     *
     * @return $this
     */
    public function relationModel($model)
    {
        $this->relationModel = $model;

        return $this;
    }

    /**
     * @param bool $isAction
     *
     * @return BelongsToManyField
     */
    public function isAction($isAction = true)
    {
        $this->isAction = $isAction;

        return $this->withMeta(['height' => $this->height]);
    }

    /**
     * @param array|callable|string $rules
     *
     * @return $this|Field
     */
    public function rules($rules)
    {
        $rules = ($rules instanceof Rule || is_string($rules)) ? func_get_args() : $rules;

        $this->rules = [new ArrayRules($rules)];

        return $this;
    }

    /**
     * @param mixed $resource
     * @param null  $attribute
     */
    public function resolve($resource, $attribute = null)
    {
        if ($this->isAction) {
            parent::resolve($resource, $attribute);
        } else {
            parent::resolve($resource, $attribute);

            if ($value = json_decode($resource->{$this->attribute})) {
                $this->value = $value;
            }
        }
    }
}
