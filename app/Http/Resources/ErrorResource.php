<?php

namespace App\Http\Resources;

use App\Exceptions\AppException;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'error';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource instanceof AppException) {
            $result = [
                'code' => $this->resource->getErrorCode(),
                'message' => $this->resource->getErrorMessage(),
            ];
            return array_merge($result, $this->resource->getErrorData());
        }
        return parent::toArray($request);
    }
}
