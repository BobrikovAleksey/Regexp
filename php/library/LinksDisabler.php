<?php

class LinksDisabler {
    private string $httpPattern = '/^(http)[^s]/i';
    private string $hostsPattern;
    private string $html;
    private array $ignoreHosts;

    function __construct(string $html, array $ignoreHosts = []) {
        $this->ignoreHosts = $ignoreHosts;
        $this->createHostsPattern();
        $this->disableLinks($html);
    }

    /**
     * Создает шаблон регулярного выражения для игнорирования необходимых хостов
     */
    protected function createHostsPattern(): void {
        $pattern = '/^(((https?):\/\/)?(.+\.)?(';
        foreach ($this->ignoreHosts as $key => $host) {
            $newHost = str_replace('.', '\.', $host);
            $pattern .= ($key > 0 ? '|' : '') . "($newHost)";
        }
        $pattern .= ')(\/|$))|(^\/.+$)/i';

        $this->hostsPattern = $pattern;
    }

    /**
     * Добавляет выключающий атрибут тегам с атрибутом href и заменяет http на https в ссылках
     * @param string $html
     */
    protected function disableLinks(string $html): void {
        $pos = 0;
        $newHtml = '';
        while (true) {
            $hrefPos = mb_stripos($html, 'href', $pos);
            if ($hrefPos !== 0 && !$hrefPos) break;

            $openQuote = mb_strpos($html, '"', $hrefPos + 4);
            $closeQuote = mb_strpos($html, '"', $openQuote + 1);
            $link = mb_substr($html, $openQuote + 1, $closeQuote - $openQuote - 1);
            if (preg_match($this->httpPattern, $link)) {
                $link = mb_substr($link, 0, 4) . 's' . mb_substr($link, 4);
            }

            $newHtml .= mb_substr($html, $pos, $openQuote - $pos) . "\"$link\"";
            if (!preg_match($this->hostsPattern, $link)) $newHtml .= ' rel="nofollow"';

            $pos = $closeQuote + 1;
        }
        $this->html = $newHtml . mb_substr($html, $pos);
    }

    /**
     * @return string
     */
    public function getHtml(): string {
        return $this->html;
    }

    /**
     * @return array
     */
    public function getIgnoreHosts(): array {
        return $this->ignoreHosts;
    }
}
