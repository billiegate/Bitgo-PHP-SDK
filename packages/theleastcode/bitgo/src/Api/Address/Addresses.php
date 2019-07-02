<?php

namespace Api\Address;

use Common\BitgoResourceModel;
use Core\BitgoConstants;
use Validation\ArgumentValidator;
use Rest\ApiContext;

/**
 * Class Addresses
 *
 * Lets you create, process and manage address.
 *
 * @package Api\Address
 * 
 * 
 * @property string labelContains
 * @property int limit
 * @property boolean mine
 * @property string prevId
 * @property array chains
 * @property int sort
 * @property Api\Address\Address[] addresses
 * @property string coin
 * @property int totalAddressCount
 * @property int pendingAddressCount
 * @property string nextBatchPrevId
 * @property string error
 * @property string name
 * @property string requestId
 */

 class Addresses Extends Address {

    /**
     * Regular expression used to return addresses based on their
     * address label
     *
     * @param string $labelContains
     * 
     * @return $this
     */
    public function setLabelContains($labelContains)
    {
        $this->labelContains = $labelContains;
        return $this;
    }

    /**
     * Expression to filter addresses created.
     *
     * @return string
     */
    public function getLabelContains()
    {
        return $this->labelContains;
    }

    /**
     * Maximum number of results to return
     *
     * @param string $limit
     * 
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Maximum number of results to return created.
     *
     * @return string
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Weather to return user created addresses
     *
     * @param boolean $mine
     * 
     * @return $this
     */
    public function setMine($mine = false)
    {
        $this->mine = $mine;
        return $this;
    }

    /**
     * option to return user created addresses.
     *
     * @return string
     */
    public function getMine()
    {
        return $this->mine;
    }

    /**
     * Return the next batch of results, based on the nextBatchPrevId 
     * value from the previous batch
     *
     * @param string $prevId
     * 
     * @return $this
     */
    public function setPrevId($prevId = false)
    {
        $this->prevId = $prevId;
        return $this;
    }

    /**
     * next batch of item created.
     *
     * @return string
     */
    public function getPrevId()
    {
        return $this->prevId;
    }

    /**
     * Returns only unspents/addresses of the chains passed.
     * Valid Values: 0, 1, 10, 11, 20, 21
     *
     * @param string $chains
     * 
     * @return $this
     */
    public function setChains($chains)
    {
        $this->chains = $chains;
        return $this;
    }

    /**
     * Address chains.
     *
     * @return string
     */
    public function getChains()
    {
        return $this->chains;
    }

    /**
     * Sort order of returned addresses.
     * Valid Values: -1, 1
     *
     * @param int $sort
     * 
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Sorting order used.
     *
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * The coin to use
     *
     * @param string $coin
     * 
     * @return $this
     */
    public function setCoin($coin)
    {
        $this->coin = $coin;
        return $this;
    }

    /**
     * Coin in use.
     *
     * @return string
     */
    public function getCoin()
    {
        return $this->coin;
    }

    /**
     * The total address returned by the query
     *
     * @param int $totalAddressCount
     * 
     * @return $this
     */
    public function setTotalAddressCount($totalAddressCount)
    {
        $this->totalAddressCount = $totalAddressCount;
        return $this;
    }

    /**
     * The total address returned.
     *
     * @return int
     */
    public function getTotalAddressCount()
    {
        return $this->totalAddressCount;
    }

    /**
     * Total number of addresses pending on-chain 
     * initialization on this wallet
     *
     * @param int $pendingAddressCount
     * 
     * @return $this
     */
    public function setPendingAddressCount($pendingAddressCount)
    {
        $this->pendingAddressCount = $pendingAddressCount;
        return $this;
    }

    /**
     * The total pending address returned.
     *
     * @return int
     */
    public function getPendingAddressCount()
    {
        return $this->pendingAddressCount;
    }

    /**
     * When a result set is truncated, this field returns the id of the 
     * last object in the previous batch. To get the next batch 
     * of results, pass this value via the prevId 
     * query parameter
     *
     * @param string $nextBatchPrevId
     * 
     * @return $this
     */
    public function setNextBatchPrevId($nextBatchPrevId)
    {
        $this->nextBatchPrevId = $nextBatchPrevId;
        return $this;
    }

    /**
     * 
     *
     * @return string
     */
    public function getNextBatchPrevId()
    {
        return $this->nextBatchPrevId;
    }

    /**
     * List of address.
     *
     * @param \Api\Address\Address[] $address
     * 
     * @return $this
     */
    public function setAddresses($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * List of address returned.
     *
     * @return \Api\Address\Address[]
     */
    public function getAddresses()
    {
        return $this->address;
    }

    /**
     * Append address to the list.
     *
     * @param Api\Address\Address $address
     * @return $this
     */
    public function addAddress($address)
    {
        if (!$this->getAddress()) {
            return $this->setAddress(array($address));
        } else {
            return $this->setAddress(
                array_merge($this->getAddress(), array($address))
            );
        }
    }

    /**
     * Remove address from the list.
     *
     * @param Api\Address\Address $address
     * @return $this
     */
    public function removeAddress($address)
    {
        return $this->setaddress(
            array_diff($this->getAddress(), array($address))
        );
    }
 }