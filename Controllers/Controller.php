<?php

namespace Controllers;

include __DIR__ . '/../Templates/Template.php';

use Templates\Template;

abstract class Controller
{
    /**
     * @param string $file_name
     * @param array|null $vars
     * @return string
     */
    public function Template($file_name, $variables = null): string
    {
        $template = new Template($file_name, $variables);

        return $template->view();
    }

    /**
     * @return void
     */
    public function View(): void
    {
        echo  $this->Header() . $this->Layout() .  $this->Footer();
    }

    /**
     * @return string
     */
    protected function Header(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Main/header.html");
    }

    /**
     * @return string
     */
    protected abstract function Layout(): string;

    /**
     * @return string
     */
    protected function Footer(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Main/footer.html");
    }
}
