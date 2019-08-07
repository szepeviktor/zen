<?php
declare(strict_types=1);

namespace WoohooLabs\Zen\Config\Preload;

use WoohooLabs\Zen\Utils\NamespaceUtil;
use function trim;

class Psr4NamespacePreload extends AbstractPreload
{
    /**
     * @var string
     */
    private $namespace;

    /**
     * @var bool
     */
    private $recursive;

    public static function create(string $namespace, bool $recursive = true): Psr4NamespacePreload
    {
        return new Psr4NamespacePreload($namespace, $recursive);
    }

    public function __construct(string $namespace, bool $recursive = true)
    {
        $this->namespace = trim($namespace, "\\");
        $this->recursive = $recursive;
    }

    /**
     * @return string[]
     * @internal
     */
    public function getClassNames(): array
    {
        return NamespaceUtil::getClassesInPsr4Namespace($this->namespace, $this->recursive, false);
    }
}
