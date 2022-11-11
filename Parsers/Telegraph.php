<?php

namespace Parsers;

class Telegraph extends RSS
{
    protected $rssNamespace;

    protected function getRssNamespace()
    {
        return $this->rssNamespace;
    }

    protected function setRssNamespace()
    {
    }

    protected function parseItem(\SimpleXMLElement $item): void
    {
        $namespaces = $this->document->getNamespaces(true);

        $this->setItem([
            'title' => (string)$item->title,
            'link' => (string)$item->link,
            'description' => (string)$item->description,
            'category' => (string)$item->category,
            'full_text' => (string)$item->children($namespaces['yandex']),
            'pub_date' => date('Y-m-d H:i:s', strtotime($item->pubDate)),
            'source' => 'Telegraf'
        ]);
    }
}
