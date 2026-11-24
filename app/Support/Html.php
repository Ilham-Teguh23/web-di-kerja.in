<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use Illuminate\Support\Str;

/**
 * Membersihkan HTML dari editor Quill di dashboard sebelum ditampilkan di halaman publik.
 */
class Html
{
    protected const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'ol', 'ul', 'li', 'a', 'h2', 'h3', 'h4', 'blockquote',
    ];

    // Heading utama halaman sudah dipakai judul, jadi h1 dari editor diturunkan
    protected const RENAMED_TAGS = ['h1' => 'h2'];

    // Dibuang beserta isinya
    protected const DROPPED_TAGS = [
        'script', 'style', 'iframe', 'object', 'embed', 'form', 'input', 'button', 'textarea', 'select', 'svg', 'math', 'template',
    ];

    public static function clean(?string $html): string
    {
        if (blank($html)) {
            return '';
        }

        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="utf-8"?><div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $root = $document->getElementsByTagName('div')->item(0);

        if (! $root) {
            return e(static::text($html));
        }

        static::sanitizeChildren($root);

        $output = '';

        foreach ($root->childNodes as $child) {
            $output .= $document->saveHTML($child);
        }

        return trim($output);
    }

    /**
     * Versi teks polos, untuk meta description dan ringkasan kartu.
     */
    public static function text(?string $html, int $limit = 0): string
    {
        $html = preg_replace('/<(br|\/p|\/li|\/h[1-6])\s*\/?>/i', ' ', (string) $html);
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $text));

        return $limit > 0 ? Str::limit($text, $limit) : $text;
    }

    protected static function sanitizeChildren(DOMNode $node): void
    {
        foreach (iterator_to_array($node->childNodes) as $child) {
            if ($child instanceof DOMElement) {
                static::sanitizeElement($child);
            } elseif (in_array($child->nodeType, [XML_COMMENT_NODE, XML_PI_NODE], true)) {
                $node->removeChild($child);
            }
        }
    }

    protected static function sanitizeElement(DOMElement $element): void
    {
        $parent = $element->parentNode;
        $tag = strtolower($element->tagName);

        // Elemen bantu tampilan Quill (penanda list) tidak perlu ikut tampil
        if (in_array($tag, self::DROPPED_TAGS, true) || str_contains($element->getAttribute('class'), 'ql-ui')) {
            $parent->removeChild($element);

            return;
        }

        // Quill 2 menyimpan bullet list sebagai <ol><li data-list="bullet">
        $newTag = $tag === 'ol' && static::isBulletList($element) ? 'ul' : (self::RENAMED_TAGS[$tag] ?? $tag);
        $href = $tag === 'a' ? static::safeUrl($element->getAttribute('href')) : null;

        static::sanitizeChildren($element);

        if (! in_array($newTag, self::ALLOWED_TAGS, true) || ($tag === 'a' && $href === null)) {
            static::unwrap($element);

            return;
        }

        $replacement = $element->ownerDocument->createElement($newTag);

        while ($element->firstChild) {
            $replacement->appendChild($element->firstChild);
        }

        if ($tag === 'a') {
            $replacement->setAttribute('href', $href);
            $replacement->setAttribute('target', '_blank');
            $replacement->setAttribute('rel', 'noopener nofollow');
        }

        $parent->replaceChild($replacement, $element);
    }

    protected static function unwrap(DOMElement $element): void
    {
        $parent = $element->parentNode;

        while ($element->firstChild) {
            $parent->insertBefore($element->firstChild, $element);
        }

        $parent->removeChild($element);
    }

    protected static function isBulletList(DOMElement $list): bool
    {
        foreach ($list->childNodes as $item) {
            if ($item instanceof DOMElement) {
                return $item->getAttribute('data-list') === 'bullet';
            }
        }

        return false;
    }

    protected static function safeUrl(string $url): ?string
    {
        $url = trim($url);

        return preg_match('~^(https?://|mailto:|tel:|/|#)~i', $url) ? $url : null;
    }
}
