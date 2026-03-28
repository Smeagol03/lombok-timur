<?php

namespace App\Helpers;

class HtmlSanitizer
{
    protected array $allowedTags = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'ul', 'ol', 'li',
        'a',
        'blockquote', 'pre', 'code',
        'span', 'div',
        'img',
        'table', 'thead', 'tbody', 'tr', 'th', 'td',
    ];

    protected array $allowedAttributes = [
        'a' => ['href', 'title', 'target', 'rel'],
        'img' => ['src', 'alt', 'title', 'width', 'height'],
        'span' => ['style'],
        'p' => ['style'],
        'div' => ['style'],
        'table' => ['style', 'border', 'cellpadding', 'cellspacing'],
        'td' => ['style', 'colspan', 'rowspan'],
        'th' => ['style', 'colspan', 'rowspan'],
    ];

    protected array $allowedStyles = [
        'color',
        'background-color',
        'font-size',
        'font-weight',
        'font-style',
        'text-align',
        'text-decoration',
        'margin',
        'margin-top',
        'margin-bottom',
        'margin-left',
        'margin-right',
        'padding',
        'padding-top',
        'padding-bottom',
        'padding-left',
        'padding-right',
        'width',
        'height',
    ];

    public function sanitize(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        $html = $this->removeScriptTags($html);
        $html = $this->removeEventHandlers($html);
        $html = $this->removeJavascriptUrls($html);
        $html = $this->removeIframes($html);
        $html = $this->removeObjects($html);
        $html = $this->removeEmbeds($html);
        $html = $this->sanitizeAttributes($html);

        return $html;
    }

    protected function removeScriptTags(string $html): string
    {
        return preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $html);
    }

    protected function removeEventHandlers(string $html): string
    {
        return preg_replace('/\s*on\w+\s*=\s*["\'][^"\']*["\']/i', '', $html);
    }

    protected function removeJavascriptUrls(string $html): string
    {
        return preg_replace('/href\s*=\s*["\']javascript:[^"\']*["\']/i', 'href="#"', $html);
    }

    protected function removeIframes(string $html): string
    {
        return preg_replace('/<iframe\b[^>]*>.*?<\/iframe>/is', '', $html);
    }

    protected function removeObjects(string $html): string
    {
        return preg_replace('/<object\b[^>]*>.*?<\/object>/is', '', $html);
    }

    protected function removeEmbeds(string $html): string
    {
        return preg_replace('/<embed\b[^>]*>/is', '', $html);
    }

    protected function sanitizeAttributes(string $html): string
    {
        if (empty(trim($html))) {
            return '';
        }

        $dom = new \DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">'.$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        if ($dom->documentElement === null) {
            return $html;
        }

        $this->sanitizeNode($dom->documentElement);

        $result = $dom->saveHTML($dom->documentElement);

        return $result ?: $html;
    }

    protected function sanitizeNode(?\DOMNode $node): void
    {
        if ($node === null) {
            return;
        }

        if ($node->nodeType === XML_ELEMENT_NODE) {
            $element = $node;
            $tagName = strtolower($element->nodeName);

            if (! in_array($tagName, $this->allowedTags)) {
                $element->parentNode?->removeChild($element);

                return;
            }

            $this->sanitizeElementAttributes($element, $tagName);
        }

        if ($node->hasChildNodes()) {
            $children = [];
            foreach ($node->childNodes as $child) {
                $children[] = $child;
            }
            foreach ($children as $child) {
                $this->sanitizeNode($child);
            }
        }
    }

    protected function sanitizeElementAttributes(\DOMElement $element, string $tagName): void
    {
        $attributesToRemove = [];

        foreach ($element->attributes as $attribute) {
            $attrName = strtolower($attribute->name);

            if (! isset($this->allowedAttributes[$tagName]) ||
                ! in_array($attrName, $this->allowedAttributes[$tagName])) {
                if ($attrName !== 'style') {
                    $attributesToRemove[] = $attrName;
                }
            }
        }

        foreach ($attributesToRemove as $attrName) {
            $element->removeAttribute($attrName);
        }

        if ($element->hasAttribute('style')) {
            $element->setAttribute('style', $this->sanitizeStyle($element->getAttribute('style')));
        }

        if ($tagName === 'a' && $element->hasAttribute('href')) {
            $href = $element->getAttribute('href');
            if (preg_match('/^javascript:/i', $href)) {
                $element->setAttribute('href', '#');
            }
            if (! $element->hasAttribute('rel')) {
                $element->setAttribute('rel', 'noopener noreferrer');
            }
            if (! $element->hasAttribute('target')) {
                $element->setAttribute('target', '_blank');
            }
        }

        if ($tagName === 'img' && $element->hasAttribute('src')) {
            $src = $element->getAttribute('src');
            if (preg_match('/^data:image\//i', $src) || preg_match('/^https?:\/\//i', $src)) {
            } elseif (! preg_match('/^\//', $src)) {
                $element->removeAttribute('src');
            }
        }
    }

    protected function sanitizeStyle(string $style): string
    {
        $styles = [];
        $parts = explode(';', $style);

        foreach ($parts as $part) {
            $part = trim($part);
            if (empty($part)) {
                continue;
            }

            if (strpos($part, ':') === false) {
                continue;
            }

            [$property, $value] = explode(':', $part, 2);
            $property = trim(strtolower($property));
            $value = trim($value);

            if (in_array($property, $this->allowedStyles)) {
                if (! preg_match('/url\s*\(/i', $value) &&
                    ! preg_match('/expression\s*\(/i', $value) &&
                    ! preg_match('/javascript:/i', $value)) {
                    $styles[] = "$property: $value";
                }
            }
        }

        return implode('; ', $styles);
    }
}
