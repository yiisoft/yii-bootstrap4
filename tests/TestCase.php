<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap4\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use RuntimeException;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetConverter;
use Yiisoft\Assets\AssetConverterInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Assets\AssetPublisherInterface;
use Yiisoft\Di\Container;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Files\FileHelper;
use Yiisoft\Widget\WidgetFactory;

use function readdir;

abstract class TestCase extends BaseTestCase
{
    protected Aliases $aliases;
    protected AssetManager $assetManager;
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = new Container($this->config());

        $this->aliases = $this->container->get(Aliases::class);
        $this->assetManager = $this->container->get(AssetManager::class);

        WidgetFactory::initialize($this->container, []);
    }

    protected function tearDown(): void
    {
        $this->removeAssets('@assets');

        unset($this->aliases, $this->assetManager, $this->container);

        parent::tearDown();
    }

    /**
     * Asserting two strings equality ignoring line endings.
     *
     * @param string $expected
     * @param string $actual
     * @param string $message
     */
    protected function assertEqualsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);
        $this->assertEquals($expected, $actual, $message);
    }

    /**
     * Asserting same ignoring slash.
     *
     * @param string $expected
     * @param string $actual
     */
    protected function assertSameIgnoringSlash(string $expected, string $actual): void
    {
        $expected = str_replace(['/', '\\'], '/', $expected);
        $actual = str_replace(['/', '\\'], '/', $actual);
        $this->assertSame($expected, $actual);
    }

    protected function removeAssets(string $basePath): void
    {
        $handle = opendir($dir = $this->aliases->get($basePath));
        if ($handle === false) {
            throw new RuntimeException("Unable to open directory: $dir");
        }
        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..' || $file === '.gitignore') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                FileHelper::removeDirectory($path);
            } else {
                FileHelper::unlink($path);
            }
        }
        closedir($handle);
    }

    private function config(): array
    {
        return [
            Aliases::class => [
                '__class' => Aliases::class,
                '__construct()' => [
                    [
                        '@root' => dirname(__DIR__, 1),
                        '@public' => '@root/tests/public',
                        '@assets' => '@public/assets',
                        '@assetsUrl' => '/',
                        '@npm' => '@root/node_modules',
                        '@view' => '@public/view',
                    ],
                ],
            ],

            LoggerInterface::class => NullLogger::class,

            AssetConverterInterface::class => AssetConverter::class,

            AssetPublisherInterface::class => AssetPublisher::class,

            AssetManager::class => [
                '__class' => AssetManager::class,
                'setConverter()' => [Reference::to(AssetConverterInterface::class)],
                'setPublisher()' => [Reference::to(AssetPublisherInterface::class)],
            ],
        ];
    }
}
