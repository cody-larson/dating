<?php

class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

}