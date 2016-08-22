<?php

namespace CodeceptionQaApi\Generator;

use \Codeception\Util\Shared\Namespaces;
use \Codeception\Util\Template;

class Helper
{
    use Namespaces;

    protected $template = <<<EOF
<?php

{{namespace}}

// here you can define custom actions
// all public methods declared in helper class will be available in \$I

use {{module}};

class QaApi extends Module
{

}

EOF;

    protected $namespace;
    protected $name;

    public function __construct($name, $namespace = '')
    {
        $this->namespace = $namespace;
        $this->name = $name;
    }

    public function produce()
    {
        return (new Template($this->template))
            ->place('namespace', $this->getNamespaceHeader($this->namespace . '\\Helper\\' . $this->name))
            ->place('module', $this->namespace . '\\_generated\\QaApi\\Module')
            ->produce();
    }

    public function getHelperName()
    {
        return rtrim('\\' . $this->namespace, '\\') . '\\Helper\\' . $this->name;
    }
}
