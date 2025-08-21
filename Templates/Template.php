<?php

namespace Templates;

class Template
{

    /**
     * @var string
     */
    private $file_name = '';

    /**
     * @var array|null
     */
    private $variables = null;


    /**
     * @param string $file_name,
     * @param array|null $variables
     * @return null
     */
    function __construct($file_name, $variables)
    {
        $this->file_name = $file_name;
        $this->variables = $variables;
    }

    /**
     * @return string
     */
    public function view(): string
    {
        $file_name = $this->getFileName();

        $variables = $this->getVariables();

        if ($variables) {
            foreach ($variables as $key => $value) {
                $$key = $value;
            }
        }

        ob_start();
        include $file_name;
        return ob_get_clean();
    }

    /**
     * @return string
     */
    protected function getFileName(): string
    {
        return $this->file_name;
    }

    /**
     * @return array|null
     */
    protected function getVariables()
    {
        return $this->variables;
    }
}
