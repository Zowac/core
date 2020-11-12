<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use ApiPlatform\Core\Metadata\Property\Factory\AnnotationPropertyMetadataFactory;
use ApiPlatform\Core\Metadata\Property\Factory\AnnotationSubresourceMetadataFactory;
use ApiPlatform\Core\Metadata\Resource\Factory\AnnotationResourceFilterMetadataFactory;
use ApiPlatform\Core\Metadata\Resource\Factory\AnnotationResourceMetadataFactory;
use ApiPlatform\Core\Metadata\Resource\Factory\AnnotationResourceNameCollectionFactory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('api_platform.metadata.resource.name_collection_factory.annotation', AnnotationResourceNameCollectionFactory::class)
            ->decorate('api_platform.metadata.resource.name_collection_factory')
            ->args([ref('annotation_reader'), param('api_platform.resource_class_directories'), ref('api_platform.metadata.resource.name_collection_factory.annotation.inner')])

        ->set('api_platform.metadata.resource.metadata_factory.annotation', AnnotationResourceMetadataFactory::class)
            ->decorate('api_platform.metadata.resource.metadata_factory', null, 40)
            ->args([ref('annotation_reader'), ref('api_platform.metadata.resource.metadata_factory.annotation.inner'), param('api_platform.defaults')])

        ->set('api_platform.metadata.resource.filter_metadata_factory.annotation', AnnotationResourceFilterMetadataFactory::class)
            ->decorate('api_platform.metadata.resource.metadata_factory', null, 20)
            ->args([ref('annotation_reader'), ref('api_platform.metadata.resource.filter_metadata_factory.annotation.inner')])

        ->set('api_platform.metadata.property.metadata_factory.annotation', AnnotationPropertyMetadataFactory::class)
            ->decorate('api_platform.metadata.property.metadata_factory', null, 20)
            ->args([ref('annotation_reader'), ref('api_platform.metadata.property.metadata_factory.annotation.inner')])

        ->set('api_platform.metadata.subresource.metadata_factory.annotation', AnnotationSubresourceMetadataFactory::class)
            ->decorate('api_platform.metadata.property.metadata_factory', null, 30)
            ->args([ref('annotation_reader'), ref('api_platform.metadata.subresource.metadata_factory.annotation.inner')]);
};
