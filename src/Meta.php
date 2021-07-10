<?php

namespace Elijahcruz\Meta;

class Meta
{
    public MetaCollection $tags;

    public function __construct(string $url = '', string $method = 'function')
    {
        $this->tags = new MetaCollection($method);

        $this->tags->getTags($url);
    }

    public function all()
    {
        return $this->tags->all();
    }

    public function count()
    {
        return $this->tags->count();
    }

    public function tag(string $name = '')
    {
        return $this->tags->get($name);
    }

    public function exists(string $name = '')
    {
        if($this->tags->get($name) == null)
        {
            return false;
        }

        return true;
    }

    public static function getTags(string $url = '', string $method = 'function')
    {
        return new self($url, $method);
    }
}