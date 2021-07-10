<?php

namespace Elijahcruz\Meta;

use Elijahcruz\Meta\Exception\MethodNotFoundException;
use Elijahcruz\Meta\Exception\UrlNotSpecifiedException;

class MetaCollection implements \IteratorAggregate, \Countable
{
    /**
     * The meta tags
     *
     * @var array
     */
    private array $metatags = [];

    private string $method = 'function';

    public function __construct(string $method = 'function')
    {
        $this->method = $method;
    }

    /**
     * Gets the current MetaCollection as an Iterator that includes all routes.
     *
     * It implements \IteratorAggregate.
     *
     * @see all()
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->all());
    }

    /**
     * Gets the number of Metatags in this collection.
     *
     * @return int The number of routes
     */
    public function count()
    {
        return \count($this->metatags);
    }

    public function add($name, $value)
    {
        $this->metatags[$name] = $value;
    }

    public function all()
    {
        return $this->metatags;
    }

    public function getTags(string $url = '')
    {
        if($url == ''){
            throw new UrlNotSpecifiedException('No URL to check metatags was entered.');
        }

        if($this->method == 'function')
        {
            $tags = get_meta_tags($url);
        }
        else{
            throw new MethodNotFoundException('The method ' . $this->method . ' is not a supported method.');
        }

        if($tags == false)
        {
            return;
        }

        foreach($tags as $name => $value)
        {
            $this->add($name, $value);
        }

    }

    public function get(string $name)
    {
        return $this->metatags[$name] ?? null;
    }

    /**
     * Removes the selected meta tags.
     *
     * @param string|string[] $name
     * @return void
     */
    public function remove($name)
    {
        foreach ((array) $name as $name) {
            unset($this->routes[$name]);
        }
    }

    public function addCollection(self $collection)
    {
        // we need to remove all routes with the same names first because just replacing them
        // would not place the new route at the end of the merged array
        foreach ($collection->all() as $name => $value) {
            unset($this->metatags[$name]);
            $this->metatags[$name] = $value;
        }

        foreach ($collection->all() as $key => $value) {
            $this->add($name, $value);
        }
    }


    public function removeAll()
    {
        unset($this->metatags);

        $this->metatags = [];
    }

    


}