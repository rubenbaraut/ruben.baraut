<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $collaboration;

    /**
     * @ORM\ManyToMany(targetEntity="Work", mappedBy="tags", cascade={"persist"})
     */
    protected $works;

    /**
     * Tag constructor.
     * @param $name
     * @param $collaboration
     */
    public function __construct($name=null, $collaboration=null)
    {
        $this->name = $name;
        $this->collaboration = $collaboration;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCollaboration()
    {
        return $this->collaboration;
    }

    /**
     * @param mixed $collaboration
     */
    public function setCollaboration($collaboration)
    {
        $this->collaboration = $collaboration;
    }

    /**
     * Add items
     *
     * @param Work $items
     */
    public function addWork(Work $work)
    {
        $this->work[] = $work;
    }

    /**
     * Get items
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * @return string
     */
    public function __toString()
    {
      return (string) $this->name;
    }


}