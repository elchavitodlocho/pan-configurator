<?php
/*
 * Copyright (c) 2014-2015 Palo Alto Networks, Inc. <info@paloaltonetworks.com>
 * Author: Christophe Painchaud <cpainchaud _AT_ paloaltonetworks.com>
 *
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.

 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
*/

/**
 * Class PathableName
 * @property AppStore|AddressStore|ServiceStore|RuleStore|Rule|PanoramaConf|PANConf|DeviceGroup|VirtualSystem $owner
 * @property string $name
 */
trait PathableName
{
    /**
     *
     * @return String
     */
    public function toString()
    {
        if( isset($this->name) )
            $ret = get_class($this).':'.$this->name;
        else
            $ret = get_class($this);

        if( isset($this->owner) && $this->owner !== null )
            $ret = $this->owner->toString().' / '.$ret;

        return $ret;
    }

    public function _PANC_shortName()
    {
        $location = 'shared';

        $locationObject = PH::findLocationObjectOrDie($this);

        if( $locationObject->isVirtualSystem() || $locationObject->isDeviceGroup() )
        {
            $location = $this->owner->owner->name();
        }

        return $location.'/'.get_class($this).'/'.$this->name;
    }

}
