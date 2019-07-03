<?php

namespace TS;

use TS\Entity\Graph;
use TS\Entity\Node;
use TS\Services\Dijkstra;

/**
 * Class Travel
 * @package TS
 */
class Travel
{
    /**
     * @var array
     */
    private $Card;

    /**
     * @var
     */
    private $Departure_name;

    /**
     * @var
     */
    private $Destination_name;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * @param $Card
     */
    public function addCard($Card)
    {
        $this->Card[]=$Card;
    }

    /**
     * @param mixed $Departure_name
     */
    public function setDepartureName($Departure_name): void
    {
        $this->Departure_name=$Departure_name;
    }

    /**
     * @param mixed $Destination_name
     */
    public function setDestinationName($Destination_name): void
    {
        $this->Destination_name=$Destination_name;
    }

    /**
     * @return array
     */
    public function getCard(): array
    {
        return $this->Card;
    }

    /**
     * @return mixed
     */
    public function getDepartureName()
    {
        return $this->Departure_name;
    }

    /**
     * @return mixed
     */
    public function getDestinationName()
    {
        return $this->Destination_name;
    }


    /**
     * @return Graph
     */
    public function buildGraph()
    {
        $graph = new Graph();

        foreach ($this->getCard() as $route) {
            $from=$route['from'];
            $to=$route['to'];
            $price=$route['price'];
            $vehicle=$route['vehicle'];
            $seat=$route['seat'];
            if (!array_key_exists($from, $graph->getNodes())) {
                $from_node=new Node($from);
                $graph->add($from_node);
            } else {
                $from_node=$graph->getNode($from);
            }
            if (!array_key_exists($to, $graph->getNodes())) {
                $to_node=new Node($to);
                $graph->add($to_node);
            } else {
                $to_node=$graph->getNode($to);
            }
             $from_node->connect($to_node, $vehicle, $seat, $price);
        }

        return $graph;
    }

    /**
     * @param $graph
     * @return string
     */
    public function toHtml($graph)
    {
        $g= new Dijkstra($graph);
        $departure_node= $graph->getNode($this->getDepartureName());
        $destination_node= $graph->getNode($this->getDestinationName());
        $g->setStartingNode($departure_node);
        $g->setEndingNode($destination_node);

        $str = "Take From: " . $departure_node->getId() . "\n";
        $str .= "To: " . $destination_node->getId() . "\n";
        $str .= "Route: " . $g->getLiteralShortestPath() . "\n";
        $str .= "Total: " . $g->getDistance() . "\n";

        return $str;
    }

}