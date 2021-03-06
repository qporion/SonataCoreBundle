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

namespace Sonata\CoreBundle\Tests\Form\EventListener;

use PHPUnit\Framework\TestCase;
use Sonata\CoreBundle\Form\EventListener\FixCheckboxDataListener;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Forms;

/**
 * @group legacy
 */
class FixCheckboxDataListenerTest extends TestCase
{
    /**
     * @dataProvider valuesProvider
     */
    public function testFixCheckbox($data, $expected, $suscriber, $transformer)
    {
        $dispatcher = new EventDispatcher();

        if ($suscriber) {
            $dispatcher->addSubscriber($suscriber);
        }

        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtensions([])
            ->getFormFactory();

        $formBuilder = new FormBuilder('checkbox', 'stdClass', $dispatcher, $formFactory);

        if ($transformer) {
            $formBuilder->addViewTransformer($transformer);
        }

        $form = $formBuilder->getForm();
        $form->submit($data);

        $this->assertSame($expected, $form->getData());
    }

    public function valuesProvider()
    {
        return [
            ['0', true, null, new BooleanToStringTransformer('1')],
            ['0', false, new FixCheckboxDataListener(), new BooleanToStringTransformer('1')],
        ];
    }
}
