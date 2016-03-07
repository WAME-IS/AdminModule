<?php 

namespace Wame\AdminModule\Components\AdminMenuControl;

class Item
{	
    /** @var string */
    private $badge;
    
    /** @var string */
    private $class;
    
    /** @var string */
    private $description;
    
    /** @var string */
    private $icon;
    
    /** @var string */
    private $link;
    
    /** @var string */
    private $title;
    
    /** @var array */
    private $childs = [];
    
    /**
     * Set item badge
     * 
     * @param string $badge
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
	public function setBadge($badge)
    {
        $this->badge = $badge;
        
        return $this;
    }
    
    /**
     * Set item CSS class
     * 
     * @param string $class
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
	public function setClass($class)
    {
        $this->class = $class;
        
        return $this;
    }
    
    /**
     * Set item description
     * 
     * @param string $description
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
	public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    /**
     * Set item icon
     * 
     * @param string $icon
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
	public function setIcon($icon)
    {
        $this->icon = $icon;
        
        return $this;
    }
    
    /**
     * Set item link
     * 
     * @param string $link
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
	public function setLink($link)
    {
        $this->link = $link;
        
        return $this;
    }
    
    /**
     * Set item title
     * 
     * @param string $title
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
	public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * Add sub item
     * 
     * @param stdClass $child
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
    public function addChild($child)
    {
        $this->childs[] = $child;
        
        return $this;
    }
	
    /**
     * Add sseparator
     * 
     * @param string $title
     * @return \App\AdminModule\Components\AdminMenuControl\Item
     */
    public function addSeparator($title = null)
    {
        $return = new \stdClass();
        $return->badge = null;
        $return->class = 'divider';
        $return->description = null;
        $return->icon = null;
        $return->link = null;
        $return->title = $title;
        $return->childs = null;
		
		$this->childs[] = $return;

        return $this;
    }
    
    /**
     * Return item object
     * 
     * @return \stdClass
     */
    public function getItem()
    {
        $return = new \stdClass();
        $return->badge = $this->badge;
        $return->class = $this->class;
        $return->description = $this->description;
        $return->icon = $this->icon;
        $return->link = $this->link;
        $return->title = $this->title;
        $return->childs = $this->childs;
        
        return $return;
    }

}