<?php

class miniGreX_seo_manager
{
    protected $pdo;

    protected $tags = [];

    public function __construct($indentation = null, $order = null)
    {
        $this->indentation = $indentation ?: '    ';
        $this->order = $order ?: ['title', 'meta', 'og', 'twitter', 'link', 'json-ld'];
    }

    public function link($key, $value)
    {
        if (! empty($value)) {
            $attributes = ['rel' => $key];

            if (is_array($value)) {
                foreach ($value as $key => $v) {
                    $attributes[$key] = $v;
                }
            } else {
                $attributes['href'] = $value;
            }

            $tag = $this->createTag('link', $attributes);

            $this->addToTagsGroup('link', $key, $tag);

            return $tag;
        }
    }


    public function meta($key, $value)
    {
        if (! empty($value)) {
            $attributes = ['name' => $key];

            if (is_array($value)) {
                foreach ($value as $key => $v) {
                    $attributes[$key] = $v;
                }
            } else {
                $attributes['content'] = $value;
            }

            $tag = $this->createTag('meta', $attributes);

            $this->addToTagsGroup('meta', $key, $tag);

            return $tag;
        }
    }

 
    public function og($key, $value, $prefixed = true)
    {
        if (! empty($value)) {
            $key = $prefixed ? "og:{$key}" : $key;
            $tag = $this->createTag('meta', [
                'property' => $key,
                'content' => $value
            ]);

            $this->addToTagsGroup('og', $key, $tag);

            return $tag;
        }
    }

    public function jsonld($schema)
    {
        if (! empty($schema)) {
            $json = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

            $script = "<script type=\"application/ld+json\">\n" . $json . "\n</script>";

            // Fix schema indentation
            $this->tags['json-ld'][] = implode(
                "\n" . $this->indentation,
                explode("\n", $script)
            );

            return $script;
        }
    }

 
    public function title($value)
    {
        if (! empty($value)) {
            $tag = "<title>{$this->escapeAll($value)}</title>";

            $this->tags['title'][] = $tag;

            return $tag;
        }
    }

   
    public function twitter($key, $value, $prefixed = true)
    {
        if (! empty($value)) {
            $key = $prefixed ? "twitter:{$key}" : $key;
            $tag = $this->createTag('meta', [
                'name' => $key,
                'content' => $value
            ]);

            $this->addToTagsGroup('twitter', $key, $tag);

            return $tag;
        }
    }

    public function render($groups = null)
    {
        $groups = ! is_null($groups) ? (array) $groups : $this->order;
        $html = [];

        foreach ($groups as $group) {
            $html[] = $this->renderGroup($group);
        }

        $html = implode('', $html);

        // Remove first indentation
        return preg_replace("/^{$this->indentation}/", '', $html, 1);
    }

    protected function renderGroup($group)
    {
        if (! isset($this->tags[$group])) {
            return;
        }

        $html = [];

        foreach ($this->tags[$group] as $tag) {
            if (is_array($tag)) {
                foreach ($tag as $t) {
                    $html[] = $t;
                }
            } else {
                $html[] = $tag;
            }
        }

        return count($html) > 0
                ? $this->indentation . implode("\n" . $this->indentation, $html) . "\n"
                : '';
    }

   
    protected function addToTagsGroup($group, $key, $tag)
    {
        if (isset($this->tags[$group][$key])) {
            $existingTag = $this->tags[$group][$key];

            if (is_array($existingTag)) {
                $this->tags[$group][$key][] = $tag;
            } else {
                $this->tags[$group][$key] = [$existingTag, $tag];
            }
        } else {
            $this->tags[$group][$key] = $tag;
        }
    }

    protected function attributes(array $attributes)
    {
        $html = [];

        foreach ($attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }


    protected function attributeElement($key, $value)
    {
        if (! is_null($value)) {
            return $key . '="' . $this->escapeAll($value) . '"';
        }
    }

  
    protected function createTag($tagName, $attributes)
    {
        if (! empty($tagName) && is_array($attributes)) {
            return "<{$tagName}{$this->attributes($attributes)}>";
        }
    }

  
    protected function escapeAll($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }
}
