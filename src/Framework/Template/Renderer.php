<?php

declare(strict_types=1);

namespace Framework\Template;
// use Framework\Template\RendererInterface;

class Renderer implements RendererInterface
{
    public function render(string $template): string 
    {
        ob_start();
        
        require (dirname(__DIR__, 3) . "/views/$template.php");
        
        return ob_get_clean();

    }
}