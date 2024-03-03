<?php

/**
 * Example real world 01
 * 
 * Render template with engine: PHP, Twig
 * - create Title Template
 * - create Page Template
 * - render
 */

interface TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate;
    public function createPageTemplate(): PageTemplate;
    public function getRenderer(): TemplateRenderer;
}

class PHPTemplateFactory implements TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate
    {
        return new PHPTemplateTitleTemplate();
    }

    public function createPageTemplate(): PageTemplate
    {
        return new PHPTemplatePageTemplate($this->createTitleTemplate());
    }

    public function getRenderer(): TemplateRenderer
    {
        return new PHPTemplateRenderer();
    }
}

interface TitleTemplate
{
    public function getTemplateString(): string;
}

class PHPTemplateTitleTemplate implements TitleTemplate
{
    public function getTemplateString(): string
    {
        return "<h1><?= \$title; ?></h1>";
    }
}

interface PageTemplate
{
    public function getTemplateString(): string;
}

abstract class BasePageTemplate implements PageTemplate
{
    public function __construct(
        protected TitleTemplate $titleTemplate
    ) {}
}

class PHPTemplatePageTemplate extends BasePageTemplate
{
    public function getTemplateString(): string
    {
        $rederedTitle = $this->titleTemplate->getTemplateString();

        return <<<HTML
        <div class="page">
            $rederedTitle
            <article class="content"><?= \$content; ?></article>
        </div>
        HTML;
    }
}

interface TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string;
}

class PHPTemplateRenderer implements TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string
    {
        extract($arguments);

        ob_start();
        eval(' ?>'.$templateString.'<?php ');
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}

class Page
{
    public function __construct(
        public $title,
        public $content
    ) {}

    public function render(TemplateFactory $factory): string
    {
        $pageTempalate = $factory->createPageTemplate();
        $renderer = $factory->getRenderer();

        return $renderer->render($pageTempalate->getTemplateString(), [
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
}

$page = new Page("Title Page 001", "This is content 001");
echo "Testing actual rendering with the PHPTemplate factory:\n";
echo $page->render(new PHPTemplateFactory());