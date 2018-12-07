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

use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Exception\InvalidResourceException;
use Symfony\Component\Translation\Loader\XliffFileLoader;

abstract class XliffValidatorTestCase extends TestCase
{
    /**
     * @var XliffFileLoader
     */
    protected $loader;

    /**
     * @var string[]
     */
    protected $errors = [];

    public function setUp(): void
    {
        $this->loader = new XliffFileLoader();
    }

    /**
     * @dataProvider getXliffPaths
     */
    public function testXliff($path): void
    {
        $this->validatePath($path);

        $this->assertCount(0, $this->errors, sprintf(
            'Unable to parse xliff files: %s',
            implode(', ', $this->errors)
        ));
    }

    /**
     * @return array List all path to validate xliff
     */
    abstract public function getXliffPaths();

    /**
     * @param string $file The path to the xliff file
     */
    protected function validateXliff($file): void
    {
        try {
            $this->loader->load($file, 'en');
            $this->assertTrue(true, sprintf('Successful loading file: %s', $file));
        } catch (InvalidResourceException $e) {
            $this->errors[] = sprintf('%s => %s', $file, $e->getMessage());
        }
    }

    /**
     * @param string $path The path to lookup for Xliff file
     */
    protected function validatePath($path): void
    {
        $files = glob(sprintf('%s/*.xliff', $path));

        foreach ($files as $file) {
            $this->validateXliff($file);
        }
    }
}