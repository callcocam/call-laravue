<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\FileManager\Filters;


use SIGA\FileManager\Filters\Drivers\Ordering\ViewsOrder;
use SIGA\Filters\FiltersAbstract;

class FileManagerFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'important' => ImportantFilter::class,
        'recent' => RecentFilter::class,
        'shared' => SharedFilter::class,
        'trashed' => TrashedFilter::class,
        'video' => MimeTypeFilter::class,
        'file' => MimeTypeFilter::class,
        'image' => MimeTypeFilter::class,
        'type' => TypeFilter::class,
        'search' => SearchFilter::class,
        'ordering' => ViewsOrder::class
    ];


    /**
     * Mappings for course filter values.
     *
     * @return array
     */
    public static function mappings()
    {
        $map = [
            [
                'shared' => [
                    'label'=>'Shared',
                    'icon'=>'fa-share-alt',
                    'val'=>1,
                    'color'=>'info',
                ],
                'important' => [
                    'label'=>'Important',
                    'icon'=>'fa-regular-star',
                    'val'=>1,
                    'color'=>'warning',
                ],
                'recent' => [
                    'label'=>'Recent',
                    'icon'=>'fa-regular-clock',
                    'val'=>1,
                    'color'=>'error',
                ],
                'trashed' => [
                    'label'=>'Trashed',
                    'icon'=>'fa-regular-trash-alt',
                    'val'=>1,
                    'color'=>'success',
                ],
            ],
            [
                'image' => [
                    'label'=>'Image',
                    'icon'=>'fa-file-image',
                    'val'=>['png','jpg','jpeg'],
                    'color'=>'warning',
                ],
                'video' => [
                    'label'=>'Video',
                    'icon'=>'fa-video',
                    'val'=>['mp4'],
                    'color'=>'error',
                ],
                'file' => [
                    'label'=>'Files',
                    'icon'=>'fa-file',
                    'val'=>['pdf'],
                    'color'=>'prmary',
                ],

            ]
        ];

        return $map;
    }
}
