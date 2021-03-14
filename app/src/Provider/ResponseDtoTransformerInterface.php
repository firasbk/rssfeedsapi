<?php
declare(strict_types=1);

namespace App\Provider;

interface ResponseDtoTransformerInterface
{
    public function transformFromObject($object);
    public function transformFromObjects(iterable $objects): iterable;
}