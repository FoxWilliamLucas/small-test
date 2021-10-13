<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'links' => [
                'path'            => $this->path()??null,
                'firstPageUrl'    => $this->url(1)??null,
                'lastPageUrl'     => $this->url($this->lastPage()??0)??null,
                'prevPageUrl'     => $this->previousPageUrl()??null,
                'nextPageUrl'     => $this->nextPageUrl()??null,
            ],
            'meta' =>[
                'currentPage'     => $this->currentPage()??0,
                'from'            => $this->firstItem()??0,
                'lastPage'        => $this->lastPage()??0,
                'perPage'         => $this->perPage()??0,
                'to'              => $this->lastItem()??0,
                'total'           => $this->total()??0,
                'count'           => $this->count()??0,
            ],
        ];
    }
}
