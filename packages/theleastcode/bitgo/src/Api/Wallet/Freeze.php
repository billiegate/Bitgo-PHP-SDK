<?php

    namespace Api\Wallet;

    use Common\BitgoModel;

    /**
     * Class Freeze
     *
     * Parameters for the type
     *
     * @package Api\Wallet
     * 
     * @property string time
     * @property string expires
     * @property integer duration
     */

    class Freeze Extends BitgoModel
    {
        /**
         * When the freeze started.
         *
         * @param string $time
         * 
         * @return $this
         */
        public function setTime($time)
        {
            $this->time = $time;
            return $this;
        }

        /**
         *
         * @return string
         */
        public function getTime()
        {
            return $this->time;
        }

        /**
         * When the freeze will end.
         *
         * @param string $expires
         * 
         * @return $this
         */
        public function setExpires($expires)
        {
            $this->expires = $expires;
            return $this;
        }

        /**
         *
         * @return string
         */
        public function getExpires()
        {
            return $this->expires;
        }

        /**
         * time in seconds.
         *
         * @param string $duration
         * 
         * @return $this
         */
        public function setDuration($duration)
        {
            $this->duration = $duration;
            return $this;
        }

        /**
         *
         * @return string
         */
        public function getDuration()
        {
            return $this->duration;
        }

    }


?>