<?php

function TemplateLoader($Template = "main")
{
    return new Ashley\TemplateEngine\Environment(__DIR__ . "/../../public/template/$Template/", ".php");
}
