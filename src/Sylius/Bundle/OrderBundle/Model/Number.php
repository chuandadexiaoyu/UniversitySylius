<?php



namespace Sylius\Bundle\OrderBundle\Model;

class Number implements NumberInterface
{
    protected $id;
    protected $order;

    public function getId()
    {
        return $this->id;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;

        return $this;
    }
}
