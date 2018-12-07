<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\CoreBundle\Test;

@trigger_error(
    'The '.__NAMESPACE__.'\EntityManagerMockFactory class is deprecated since version 3.x and will be removed in 4.0.'
    .' Use Sonata\Doctrine\Test\EntityManagerMockFactory instead.',
    E_USER_DEPRECATED
);

/**
 * @deprecated since 3.x, to be removed in 4.0.
 */
class EntityManagerMockFactory extends \Sonata\Doctrine\Test\EntityManagerMockFactory
{
}