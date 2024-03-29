<?php

/**
 * Class Node
 * @package TS\Entity
 */

namespace TS\Entity;

/**
 * Class Node
 * @package TS\Entity
 */
class Node implements NodeInterface
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * @var int
     */
    private $potential;

    /**
     * @var mixed
     */
    private $vehicle;

    /**
     * @var mixed
     */
    private $seat;


    /**
     * @var array
     */
    private $potentialFrom;

    /**
     * @var array
     */
    private $connections = [];

    /**
     * @var bool
     */
    private $passed = false;


    /**
     * Instantiates a new node, requiring a ID to avoid collisions.
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Connects the node to another $node.
     *
     * @param Node $node
     * @param mixed $vehicle
     * @param mixed $seat
     * @param integer $price
     */
    public function connect(NodeInterface $node, $vehicle, $seat, int $price = 1)
    {
        $this->connections[$node->getId()]['vehicle'] = $vehicle;
        $this->connections[$node->getId()]['seat'] = $seat;
        $this->connections[$node->getId()]['price'] = $price;
    }

    /**
     * Returns the distance to the node.
     *
     * @return Array
     */
    public function getDistance(NodeInterface $node)
    {
        return $this->connections[$node->getId()];
    }

    /**
     * Returns the connections of the current node.
     *
     * @return Array
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Returns the identifier of this node.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns node's potential.
     *
     * @return integer
     */
    public function getPotential()
    {
        return $this->potential;
    }

    /**
     * Returns the node which gave to the current node its potential.
     *
     * @return Node
     */
    public function getPotentialFrom()
    {
        return $this->potentialFrom;
    }

    /**
     * Returns whether the node has passed or not.
     *
     * @return boolean
     */
    public function isPassed()
    {
        return $this->passed;
    }

    /**
     * Marks this node as passed, meaning that, in the scope of a graph, he
     * has already been processed in order to calculate its potential.
     */
    public function markPassed()
    {
        $this->passed = true;
    }

    /**
     * Sets the potential for the node, if the node has no potential or the
     * one it has is higher than the new one.
     *
     * @param integer $potential
     * @param Node $from
     * @return boolean
     */
    public function setPotential($potential, NodeInterface $from) : bool
    {
        $potential = ( int ) $potential;
        if (! $this->getPotential() || $potential < $this->getPotential()) {
            $this->potential = $potential;
            $this->potentialFrom = $from;
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param mixed $vehicle
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle=$vehicle;
    }

    /**
     * @return mixed
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param mixed $seat
     */
    public function setSeat($seat): void
    {
        $this->seat=$seat;
    }



}