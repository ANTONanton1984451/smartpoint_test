<?php


namespace classes;

class Template
{
    public static function init(string $template)
    {
        $loader = new \Twig\Loader\FilesystemLoader(HOME.'\templates');

        $twig = new \Twig\Environment($loader);

        $template=$twig->load($template.'.tmpl');

        echo $template->render();

    }

}