<?php

namespace Pilipinews\Website\Bworld;

use Pilipinews\Common\Article;
use Pilipinews\Common\Interfaces\ScraperInterface;
use Pilipinews\Common\Scraper as AbstractScraper;

/**
 * Business World Scraper
 *
 * @package Pilipinews
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Scraper extends AbstractScraper implements ScraperInterface
{
    /**
     * @var string[]
     */
    protected $removables = array('script', '.td-post-share', '.td-post-source-tags', '.wp-caption-text');

    /**
     * Returns the contents of an article.
     *
     * @param  string $link
     * @return \Pilipinews\Common\Article
     */
    public function scrape($link)
    {
        $this->prepare((string) $link);

        $this->remove($this->removables);

        $title = $this->title('.entry-title');

        $body = $this->body('.td-post-content');

        $html = $this->html($body);

        return new Article($title, $html, $link);
    }
}
